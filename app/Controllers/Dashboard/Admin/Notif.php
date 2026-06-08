<?php

namespace App\Controllers\Dashboard\Admin;

class Notif extends \App\Controllers\BaseController
{
  protected $notifM;
  public function __construct()
  {
    $this->notifM = new \App\Models\PemberitahuanModel();
  }

  public function index()
  {
    $data = [
      'title'      => 'Pemberitahuan',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
    ];

    $data['notif'] = $this->notifM
      ->whereIn('level_akses', ['0', '2'])
      ->where('status', '1')
      ->find();

    return view('dashboard/admin/notif', $data);
  }

  public function create()
  {
    $data = [
      'title'      => 'Pemberitahuan',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'validation' => \Config\Services::validation()
    ];

    return view('dashboard/admin/notif-create', $data);
  }

  public function edit($id)
  {
    function br2nl($input)
    {
      return preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n", "", str_replace("\r", "", htmlspecialchars_decode($input))));
    }

    $data = [
      'title'      => 'Edit Pemberitahuan',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'validation' => \Config\Services::validation()
    ];

    $data['notif'] = $this->notifM
      ->where('id', $id)
      ->first();

    $data['notif']['isi'] = br2nl($data['notif']['isi']);

    return view('dashboard/admin/notif-edit', $data);
  }

  public function save()
  {
    if (!$this->validate([
      'judul' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Judul Pemberitahuan harus diisi'
        ]
      ],
      'isi' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Isi Pemberitahuan harus diisi'
        ]
      ],
      'status' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Status Pemberitahuan harus diisi'
        ]
      ],
      'level_akses' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Level Akses Pemberitahuan harus diisi'
        ]
      ]
    ])) {
      return redirect()->back()->withInput();
    }

    $save = [
      'judul' => $this->request->getVar('judul'),
      'isi' => nl2br($this->request->getVar('isi')),
      'status' => $this->request->getVar('status'),
      'level_akses' => $this->request->getVar('level_akses')
    ];

    if ($this->request->getVar('id')) {
      $save['id'] = $this->request->getVar('id');
    }


    $this->notifM->save($save);

    session()->setFlashdata('system', 'Pemberitahuan baru ditambahkan');

    return redirect()->to('/dashboard/admin/notif');
  }
}
