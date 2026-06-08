<?php

namespace App\Controllers\Dashboard\Admin;

class Laporan extends \App\Controllers\BaseController
{
  protected $peminjamanM;
  protected $userM;
  protected $bukuM;
  public function __construct()
  {
    $this->peminjamanM = new \App\Models\PeminjamanModel();
    $this->userM       = new \App\Models\UserModel();
    $this->bukuM       = new \App\Models\BukuModel();
  }

  public function index()
  {
    return redirect()->to(base_url('dashboard/admin'));
  }

  public function pinjaman()
  {
    $form = $this->request->getPost();

    $data = [
      'title'      => 'Peminjaman',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
    ];

    $data['pinjaman'] = $this->peminjamanM
      ->select('peminjaman.*, user.fullname, user.username, buku.judul')
      ->join('buku', 'buku.id = peminjaman.buku_id')
      ->join('user', 'user.id = peminjaman.user_id')
      ->whereIn('status', ['1'])
      ->find();

    if (empty($form))
      return view('dashboard/admin/pinjaman', $data);

    $this->peminjamanM->delete($form['id']);
    session()->setFlashData('success', 'Laporan dihapus');
    return redirect()->back();
  }

  public function pengembalian()
  {
    $data = [
      'title'      => 'Pengembalian',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
    ];

    $data['pengembalian'] = $this->peminjamanM
      ->select('peminjaman.*, user.fullname, user.username, buku.judul')
      ->join('buku', 'buku.id = peminjaman.buku_id')
      ->join('user', 'user.id = peminjaman.user_id')
      ->whereIn('status', ['2'])
      ->find();

    return view('dashboard/admin/pinjaman', $data);
  }

  public function create()
  {
    $data = [
      'title'      => 'Peminjaman',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'validation' => \Config\Services::validation()
    ];

    $data['user'] = $this->userM
      ->where('role', 'anggota')
      ->find();
    $data['buku'] = $this->bukuM
      ->find();
    $data['pinjaman'] = $this->peminjamanM
      ->whereIn('status', ['1', '0'])
      ->find();
    $data['pengembalian'] = $this->peminjamanM
      ->where('status', '2')
      ->find();

    return view('dashboard/admin/pinjaman-create', $data);
  }

  public function izin()
  {
    $data = [
      'title'      => 'Permintaan Pinjaman',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
    ];

    $data['permintaan'] = $this->peminjamanM
      ->select('peminjaman.*, user.fullname, user.username, buku.judul')
      ->join('buku', 'buku.id = peminjaman.buku_id')
      ->join('user', 'user.id = peminjaman.user_id')
      // ->join()
      ->whereIn('status', ['0'])
      ->find();

    return view('dashboard/admin/pinjaman', $data);
  }


  public function save()
  {
    if (!$this->validate([
      'kondisi' => 'required',
      'id_user' => 'required',
      'id_buku' => 'required',
    ])) return redirect()->back()->withInput();

    $form = $this->request->getPost();

    $duration = $form['durasi'] * (7 * 24 * 60 * 60);

    $timeNow = strtotime(date("Y-m-d H:i:s"));
    $duration = $duration + $timeNow;
    $duration = date('Y-m-d H:i:s', $duration);

    $val = [
      'user_id'  => $form['id_user'],
      'buku_id'  => $form['id_buku'],
      'kondisi_sebelum' => $form['kondisi'],
      'status'   => '1',
      'durasi' => $form['durasi'],
      'batas_pinjam' => $duration
    ];

    if (isset($form['id'])) {
      $val['id'] = $form['id'];
    }

    $this->peminjamanM->save($val);

    $thisBook = $this->bukuM->find($form['id_buku']);
    $total_book = $thisBook['stock'] - 1;
    $this->bukuM->save([
      'id'    => $form['id_buku'],
      'stock' => $total_book,
    ]);

    session()->setFlashdata('success', 'Laporan Peminjaman Berhasil Dipinjam');
    return redirect()->to(base_url('dashboard/admin/laporan/pinjaman'));
  }

  public function returnSection()
  {
    if (!$this->validate([
      'kondisi' => 'required'
    ])) return redirect()->back();

    $form = $this->request->getPost();
    $p    = $this->peminjamanM->find($form['id']);
    $buku = $this->bukuM->find($p['buku_id']);

    $time = date('Y-m-d H:i:s');

    $val = [
      'id'              => $form['id'],
      'kondisi_sesudah' => $form['kondisi'],
      'status'          => '2',
      'tanggal_kembali' => $time,
    ];

    $denda = NULL;
    $stock = $buku['stock'] + 1;


    if ($p['kondisi_sebelum'] !== '0') {
      if ($form['kondisi'] == '0') {
        $denda = 20000;
        $val['denda_status'] = '0';
      } else if ($form['kondisi'] == '2') {
        $denda = 50000;
        $stock = $stock - 1;
        $val['denda_status'] = '0';
      }
    }
    if ($time > $p['batas_pinjam']) {
      $denda = $denda + 8000;
    }

    $val['denda'] = $denda;

    $this->peminjamanM->save($val);
    $this->bukuM->save([
      'id'    => $buku['id'],
      'stock' => $stock,
    ]);
    return redirect()->to(base_url('dashboard/admin/laporan/pinjaman'));
  }

  public function denda()
  {
    $form = $this->request->getPost();

    if (!$this->validate([
      'id' => 'required',
      'denda_status' => 'required'
    ])) return redirect()->back();

    $this->peminjamanM->save($form);
    session()->setFlashdata("system", "Denda Diperbarui");
    return redirect()->back();
  }
}
