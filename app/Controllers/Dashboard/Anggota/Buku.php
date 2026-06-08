<?php

namespace App\Controllers\Dashboard\Anggota;

class Buku extends \App\Controllers\BaseController
{
  protected $bukuM;
  protected $kategoriM;
  protected $peminjamanM;
  public function __construct()
  {
    $this->bukuM       = new \App\Models\BukuModel();
    $this->kategoriM   = new \App\Models\KategoriModel();
    $this->peminjamanM = new \App\Models\PeminjamanModel();
  }

  public function index()
  {
    return redirect()->to(base_url('dashboard/anggota/buku/k'));
  }

  public function katalog($c = NULL)
  {
    $data = [
      'title'      => 'Katalog Buku',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'kategori'   => $this->kategoriM->find(),
    ];

    if ($c == NULL) {
      $data['buku'] = $this->bukuM
        ->select('buku.*, pengarang.pengarang, kategori.kategori, rak.rak, penerbit.penerbit')
        ->join('pengarang', 'pengarang.id = buku.pengarang')
        ->join('kategori', 'kategori.id = buku.kategori')
        ->join('rak', 'rak.id = buku.rak')
        ->join('penerbit', 'penerbit.id = buku.penerbit')
        ->find();
    } else {
      $kategori = $this->kategoriM->where('kategori', $c)->first();
      $data['buku'] = $this->bukuM
        ->select('buku.*, pengarang.pengarang, kategori.kategori, rak.rak, penerbit.penerbit')
        ->join('pengarang', 'pengarang.id = buku.pengarang')
        ->join('kategori', 'kategori.id = buku.kategori')
        ->join('rak', 'rak.id = buku.rak')
        ->join('penerbit', 'penerbit.id = buku.penerbit')
        ->where('buku.kategori', $kategori['id'])
        ->find();
    }

    return view('dashboard/anggota/catalog', $data);
  }

  public function req()
  {
    $form = $this->request->getPost();

    // dd($form); 
    $this->peminjamanM->save([
      'user_id' => session()->get('id'),
      'buku_id' => $form['buku_id'],
      'durasi'  => $form['durasi']
    ]);

    session()->setFlashdata('success', 'Kirim permintaan pinjaman berhasil');
    return redirect()->to(base_url('dashboard/anggota/buku/pinjaman'));
  }

  public function pinjaman()
  {
    $form = $this->request->getPost();

    $data = [
      'title'      => 'Pinjaman',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'pinjaman'   => $this->peminjamanM
        ->select('peminjaman.*, pengarang.pengarang as nm_pengarang, penerbit.penerbit as nm_penerbit, buku.pengarang, buku.penerbit, buku.judul')
        ->join('buku', 'buku.id = peminjaman.buku_id')
        ->join('pengarang', 'pengarang.id = buku.pengarang')
        ->join('penerbit', 'penerbit.id = buku.penerbit')
        ->where('user_id', session()->get('id'))
        ->whereIn('status', ['1', '0'])
        ->find()
    ];

    if (empty($form)) {
      return view('dashboard/anggota/pinjaman', $data);
    }

    $this->peminjamanM->delete($form['id']);
    session()->setFlashData('success', 'Permintaam pinjaman dibatalkan');
    return redirect()->to(base_url('dashboard/anggota/buku/pinjaman'));
  }

  public function histori()
  {

    $data = [
      'title'      => 'Histori',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'pinjaman'   => $this->peminjamanM
        ->select('peminjaman.*, pengarang.pengarang as nm_pengarang, penerbit.penerbit as nm_penerbit, buku.pengarang, buku.penerbit, buku.judul')
        ->join('buku', 'buku.id = peminjaman.buku_id')
        ->join('pengarang', 'pengarang.id = buku.pengarang')
        ->join('penerbit', 'penerbit.id = buku.penerbit')
        ->where('user_id', session()->get('id'))
        ->where('status', '2')
        ->find()
    ];

    return view('dashboard/anggota/pinjaman', $data);
  }
}
