<?php

namespace App\Controllers\Dashboard\Admin;

class Buku extends \App\Controllers\BaseController
{
  protected $bukuM;
  protected $kategoriM;
  protected $rakModel;
  protected $pengarangM;
  protected $penerbitM;
  public function __construct()
  {
    $this->bukuM      = new \App\Models\BukuModel();
    $this->kategoriM  = new \App\Models\KategoriModel();
    $this->rakModel   = new \App\Models\RakModel();
    $this->pengarangM = new \App\Models\PengarangModel();
    $this->penerbitM  = new \App\Models\PenerbitModel();
  }

  public function index()
  {
    $data = [
      'title'      => 'Buku',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
    ];

    $data['buku'] =
      $this->bukuM
      ->select('buku.*, pengarang.pengarang as nm_pengarang, penerbit.penerbit as nm_penerbit, kategori.kategori as nm_kategori, rak.rak as nm_rak')
      ->join('pengarang', 'pengarang.id = buku.pengarang')
      ->join('kategori', 'kategori.id = buku.kategori')
      ->join('penerbit', 'penerbit.id = buku.penerbit')
      ->join('rak', 'rak.id = buku.rak')
      ->find();

    return view('dashboard/admin/buku', $data);
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

    return view('dashboard/admin/catalog', $data);
  }

  public function edit($id = NULL)
  {
    if ($id == NULL) {
      return redirect()->to(base_url('dashboard/admin/buku'));
    }
    $data = [
      'title'      => 'Edit Buku',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'kategori'   => $this->kategoriM->find(),
      'penerbit'   => $this->penerbitM->find(),
      'pengarang'  => $this->pengarangM->find(),
      'rak'        => $this->rakModel->find(),
      'validation' => \Config\Services::validation(),
    ];

    $data['buku'] =
      $this->bukuM->find($id);

    return view('dashboard/admin/buku-edit', $data);
  }

  public function create()
  {
    $data = [
      'title'      => 'Tambah Buku',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'kategori'   => $this->kategoriM->find(),
      'penerbit'   => $this->penerbitM->find(),
      'pengarang'  => $this->pengarangM->find(),
      'rak'        => $this->rakModel->find(),
      'validation' => \Config\Services::validation(),
    ];

    return view('dashboard/admin/buku-create', $data);
  }

  public function save()
  {
    if (!$this->validate([
      'judul' => 'required',
      'isbn'  => 'required',
      'kategori' => 'required',
      'tahun' => 'required',
      'stock' => 'required',
      'pengarang' => 'required',
      'penerbit' => 'required',
      'rak'    => 'required',
      'sampul'  => 'mime_in[sampul,image/jpg,image/jpeg,image/gif,image/png]',
    ])) {
      return redirect()->back()->withInput();
    }

    $form = $this->request->getPost();

    $val = [
      'judul'        => $form['judul'],
      'isbn'         => $form['isbn'],
      'kategori'     => $form['kategori'],
      'tahun_terbit' => $form['tahun'],
      'stock'        => $form['stock'],
      'pengarang'    => $form['pengarang'],
      'penerbit'     => $form['penerbit'],
      'rak'          => $form['rak'],
    ];

    if (isset($form['id'])) {
      $val['id'] = $form['id'];
    }

    $sampul = $this->request->getFile('sampul');
    if ($sampul->getError() != 4) {
      $nameimg = $sampul->getRandomName();
      $sampul->move('img/cover', $nameimg);
      $val['sampul'] = $nameimg;
    } else {
      if (!isset($val['id']))
        $val['sampul'] = 'Default.jpg';
    }


    $this->bukuM->save($val);
    session()->setFlashdata('system', 'Data Buku Tersimpan');
    return redirect()->to('dashboard/admin/buku/');
  }

  public function delete()
  { {
      $data = $this->request->getPost();
      if (empty($data)) {
        return redirect()->to(base_url("dashboard/home"));
      }

      $this->bukuM->delete($data['id']);

      session()->setFlashdata('system', 'Buku berhasil dihapus');
      return redirect()->back();
    }
  }
}
