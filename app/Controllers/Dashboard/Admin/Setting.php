<?php

namespace App\Controllers\Dashboard\Admin;

class Setting extends \App\Controllers\BaseController
{
  protected $appM;

  public function __construct()
  {
    $this->appM = new \App\Models\AplikasiModel();
  }

  public function index()
  {
    $data = [
      'title'   => 'Setelan Aplikasi',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'validation' => \Config\Services::validation()
    ];

    return view('dashboard/admin/setting', $data);
  }

  public function save()
  {
    $data = $this->request->getVar();

    if (!$this->validate([
      'nama_app' => 'required',
      'alamat_app' => 'required',
      'email_app' => 'required',
      'nomor_hp' => 'required',
      'foto_app' => 'mime_in[foto_app,image/jpg,image/jpeg,image/gif,image/png]',
      'logo_app' => 'mime_in[logo_app,image/jpg,image/jpeg,image/gif,image/png]'
    ])) return redirect()->back()->withInput()->with('error', "Pengaturan gagal disimpan");

    $save = [
      'id' => 1,
      'nama_app' => $data['nama_app'],
      'alamat_app' => $data['alamat_app'],
      'email_app' => $data['email_app'],
      'nomor_hp' => $data['nomor_hp'],
    ];

    $fotoApp = $this->request->getFile('foto_app');
    $logoApp = $this->request->getFile('logo_app');

    if ($fotoApp->getError() != 4) {
      $nameimg = $fotoApp->getRandomName();
      $fotoApp->move('img/web', $nameimg);
      $save['foto'] = $nameimg;
    }

    if ($logoApp->getError() != 4) {
      $nameimg = $logoApp->getRandomName();
      $logoApp->move('img/web', $nameimg);
      $save['logo'] = $nameimg;
    }

    $this->appM->save($save);

    session()->setFlashdata('success', 'Pengaturan aplikasi disimpan');
    return redirect()->back();
  }
}
