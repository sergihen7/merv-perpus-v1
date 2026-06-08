<?php

namespace App\Controllers\Dashboard\Admin;

class MasterData extends \App\Controllers\BaseController
{
  protected $bukuM;
  protected $rakM;
  protected $kategoriM;
  protected $pengarangM;
  protected $penerbitM;

  public function __construct()
  {
    $this->bukuM  = new \App\Models\BukuModel();
    $this->kategoriM = new \App\Models\KategoriModel();
    $this->rakM = new \App\Models\RakModel();
    $this->pengarangM = new \App\Models\PengarangModel();
    $this->penerbitM = new \App\Models\PenerbitModel();
  }

  public function index()
  {
    $data = [
      'title'      => 'Home',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
    ];
    return redirect()->to(base_url('dashboard/admin'));
  }


  public function kategori($index = NULL, $id = NULL)
  {

    $data = [
      'title'      => 'Kategori',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'kategori'   => $this->kategoriM->find(),
      'validation' => \Config\Services::validation(),
    ];

    if ($index !== NULL) {
      switch ($index) {
        case 'create':
          return view('dashboard/admin/kategori-create', $data);
          break;
        case 'edit':
          $data['kategori'] = $this->kategoriM->find($id);
          return view('dashboard/admin/kategori-edit', $data);
          break;
        case 'delete':
          $form = $this->request->getPost();
          if (!empty($form)) {
            $this->kategoriM->delete($form['id']);
          }
          return redirect()->to('dashboard/admin/masterdata/kategori');
          break;
      }
    }

    $form = $this->request->getPost();

    if (empty($form)) {
      return view('dashboard/admin/kategori', $data);
    }

    if (!$this->validate(['category' => 'required'])) return redirect()->back()->withInput();

    $val = [
      'kategori' => $form['category'],
    ];

    if (isset($form['id'])) {
      $val['id'] = $form['id'];
    }

    $this->kategoriM->save($val);
    session()->setFlashdata('system', 'Kategori Tersimpan');
    return redirect()->to('dashboard/admin/masterdata/kategori');
  }

  public function rak_buku($index = NULL, $id = NULL)
  {
    $data = [
      'title'      => 'Rak Buku',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'rak'   => $this->rakM->find(),
      'validation' => \Config\Services::validation(),
    ];

    if ($index !== NULL) {
      switch ($index) {
        case 'create':
          return view('dashboard/admin/rak-create', $data);
          break;
        case 'edit':
          $data['rak'] = $this->rakM->find($id);
          return view('dashboard/admin/rak-edit', $data);
          break;
        case 'delete':
          $form = $this->request->getPost();
          if (!empty($form)) {
            $this->rakM->delete($form['id']);
          }
          return redirect()->to('dashboard/admin/masterdata/rak_buku');
          break;
      }
    }

    $form = $this->request->getPost();

    if (empty($form)) {
      return view('dashboard/admin/rak', $data);
    }

    if (!$this->validate(['rak' => 'required'])) return redirect()->back()->withInput();

    $val = [
      'rak' => $form['rak'],
    ];

    if (isset($form['id'])) {
      $val['id'] = $form['id'];
    }

    $this->rakM->save($val);
    session()->setFlashdata('system', 'Rak Buku Tersimpan');
    return redirect()->to('dashboard/admin/masterdata/rak_buku');
  }

  public function pengarang($index = NULL, $id = NULL)
  {
    $data = [
      'title'      => 'Pengarang',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'pengarang'   => $this->pengarangM->find(),
      'validation' => \Config\Services::validation(),
    ];

    if ($index !== NULL) {
      switch ($index) {
        case 'create':
          return view('dashboard/admin/pengarang-create', $data);
          break;
        case 'edit':
          $data['pengarang'] = $this->pengarangM->find($id);
          return view('dashboard/admin/pengarang-edit', $data);
          break;
        case 'delete':
          $form = $this->request->getPost();
          if (!empty($form)) {
            $this->pengarangM->delete($form['id']);
          }
          return redirect()->to('dashboard/admin/masterdata/pengarang');
          break;
      }
    }

    $form = $this->request->getPost();

    if (empty($form)) {
      return view('dashboard/admin/pengarang', $data);
    }

    if (!$this->validate(['pengarang' => 'required'])) return redirect()->back()->withInput();

    $val = [
      'pengarang' => $form['pengarang'],
    ];

    if (isset($form['id'])) {
      $val['id'] = $form['id'];
    }

    $this->pengarangM->save($val);
    session()->setFlashdata('system', 'Pengarang Tersimpan');
    return redirect()->to('dashboard/admin/masterdata/pengarang');
  }
  public function penerbit($index = NULL, $id = NULL)
  {
    $data = [
      'title'      => 'Penerbit',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'penerbit'   => $this->penerbitM->find(),
      'validation' => \Config\Services::validation(),
    ];

    if ($index !== NULL) {
      switch ($index) {
        case 'create':
          return view('dashboard/admin/penerbit-create', $data);
          break;
        case 'edit':
          $data['penerbit'] = $this->penerbitM->find($id);
          return view('dashboard/admin/penerbit-edit', $data);
          break;
        case 'delete':
          $form = $this->request->getPost();
          if (!empty($form)) {
            $this->penerbitM->delete($form['id']);
          }
          return redirect()->to('dashboard/admin/masterdata/penerbit');
          break;
      }
    }

    $form = $this->request->getPost();

    if (empty($form)) {
      return view('dashboard/admin/penerbit', $data);
    }

    if (!$this->validate(['penerbit' => 'required', 'kode_penerbit' => 'required'])) return redirect()->back()->withInput();

    $val = [
      'penerbit' => $form['penerbit'],
      'kode_penerbit' => $form['kode_penerbit'],
    ];

    if (isset($form['id'])) {
      $val['id'] = $form['id'];
    }

    $this->penerbitM->save($val);
    session()->setFlashdata('system', 'Penerbit Tersimpan');
    return redirect()->to('dashboard/admin/masterdata/penerbit');
  }
}
