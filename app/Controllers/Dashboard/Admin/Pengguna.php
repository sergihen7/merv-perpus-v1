<?php

namespace App\Controllers\Dashboard\Admin;

class Pengguna extends \App\Controllers\BaseController
{
  protected $userM;
  public function __construct()
  {
    $this->userM = new \App\Models\UserModel();
  }

  public function index()
  {
    return redirect()->to(base_url('dashboard/admin'));
  }

  public function anggota()
  {
    $data = [
      'title'      => 'Anggota',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
    ];

    $data['anggota'] = $this->userM
      ->select('user.*')
      ->where('role', 'anggota')
      ->find();

    return view('dashboard/admin/pengguna', $data);
  }

  public function admin()
  {
    $data = [
      'title'      => 'Admin',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
    ];

    $data['admin'] = $this->userM
      ->where('role', 'admin')
      ->find();

    return view('dashboard/admin/pengguna', $data);
  }

  public function create()
  {
    $data = [
      'title'   => 'Tambah Pengguna',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'validation' => \Config\Services::validation()
    ];
    return view("dashboard/admin/pengguna-create", $data);
  }

  public function edit($id = NULL)
  {
    if ($id == NULL) {
      return redirect()->to(base_url('dashboard/admin/pengguna/create'));
    }

    $userEdit = $this->userM->find($id);

    $data = [
      'title'   => 'Edit Pengguna',
      'app'        => $this->app,
      'user_edit' => $userEdit,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'validation' => \Config\Services::validation()
    ];
    return view("dashboard/admin/pengguna-edit", $data);
  }

  public function save()
  {

    $data = $this->request->getVar();

    if (isset($data['id'])) {
      $user = $this->userM->where(['id' => $data['id']])->first();

      $valid = [
        'email'    => 'required',
        'role'     => 'required',
        'fullname' => 'required',
      ];
      if (strtolower($user['username']) == strtolower($data['username'])) {
        $valid['username'] = 'required';
      } else {
        $valid['username'] = 'required|is_unique[user.username]';
      }

      if (strtolower($user['email']) == strtolower($data['email'])) {
        $valid['email'] = 'required';
      } else {
        $valid['email'] = 'required|is_unique[user.email]';
      }

      $save = [
        'id'       => $data['id'],
        'username' => $data['username'],
        'fullname' => $data['fullname'],
        'email'    => $data['email'],
        'role'     => $data['role'] ?? "1",
        'verif'    => $data['verif'] ?? '0',
      ];

      if (!empty($data['password'])) {
        $save['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
      }

      $redirect = "dashboard/admin/pengguna/edit/$data[id]";
    } else {
      $valid = [
        'username' => 'required|is_unique[user.username]',
        'email'    => 'required|is_unique[user.email]',
        'role'     => 'required',
        'fullname' => 'required',
        'password' => 'required'
      ];

      $save = [
        'username' => $data['username'],
        'fullname' => $data['fullname'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        'email'    => $data['email'],
        'role'     => $data['role'] ?? "1",
        'verif'    => $data['verif'] ?? '0',
        'foto'     => 'Default.jpg'
      ];

      $redirect = "dashboard/admin/pengguna/create";
    }

    if (!$this->validate($valid)) {
      $validation = \Config\Services::validation();
      return redirect()->to(base_url($redirect))->withInput()->with('validation', $validation);
    }

    $this->userM->save($save);

    session()->setFlashdata('system', 'User Successfully Saved');
    return redirect()->to(base_url($redirect));
    // dd($data);
  }

  public function delete()
  {
    $data = $this->request->getPost();
    if (empty($data)) {
      return redirect()->to(base_url("dashboard/home"));
    }
    $userdeleted = $this->userM->find($data['id']);

    if ($userdeleted["id"] == session()->get("id")) {
      session()->setFlashdata('error', '<h2>Apa kamu ingin bunuh diri? <img src="' . base_url("img/secret/seems-alr.jfif") .  '" width="80px" /> </h2>');
      return redirect()->back();
    }


    $this->userM->delete($data['id']);

    session()->setFlashdata('success', 'Pengguna berhasil dihapus');
    return redirect()->back();
  }
}
