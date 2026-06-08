<?php

namespace App\Controllers;

class Auth extends BaseController
{
  protected $userM;
  public function __construct()
  {
    $this->userM = new \App\Models\UserModel();
  }

  public function login()
  {
    $form = $this->request->getPost();
    $data = [
      'title' => 'Sign-in',
      'app'  => $this->app,
    ];
    if (empty($form)) {
      return view('page/login', $data);
    }

    $user_data = $this->userM->where('username', $form['username'])->orWhere('email', $form['username'])->first();

    if (!empty($user_data)) {
      if (password_verify($form['password'], $user_data['password'])) {
        if ($user_data['verif'] == '0') {
          session()->setFlashdata("error", "Akun kamu belum diverifikasi oleh admin. Silahkan tunggu sampai admin memverifikasi akun kamu, terimakasih.");
          return redirect()->back();
        }

        session()->set('id', $user_data['id']);
        session()->set('role', $user_data['role']);

        session()->setFlashdata('success', "Login berhasil, Selamat datang kembali $user_data[fullname], semoga hari-harimu bermanfaat. Jangan lupa membaca buku!");
        if ($user_data['role'] == 'admin') {
          return redirect()->to(base_url('dashboard/admin'));
        } elseif ($user_data['role'] == 'anggota') {
          return redirect()->to(base_url('dashboard/anggota'));
        }
      } else {
        session()->setFlashdata('error', 'Username atau Password Salah');
        return redirect()->to(base_url('sign-in'));
      }
    } else {
      session()->setFlashdata('error', 'Username atau Password Salah');
      return redirect()->to(base_url('sign-in'));
    }
  }

  public function register()
  {
    $form = $this->request->getPost();
    $data = [
      'title' => 'Sign-in',
      'app'  => $this->app,
      'validation' => \Config\Services::validation(),
    ];
    if (empty($form)) {
      return view('page/register', $data);
    }

    // dd($form);

    if (!$this->validate([
      'username'  => 'required|is_unique[user.username]',
      'fullname'  => 'required',
      'email'     => 'required|is_unique[user.email]|valid_email',
      'password'  => 'required|matches[password2]',
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to(base_url('sign-up'))->withInput()->with('validation', $validation);
    }

    $this->userM->save([
      'username' => $form['username'],
      'email'    => $form['email'],
      'password' => password_hash($form['password'], PASSWORD_DEFAULT),
      'fullname' => $form['fullname'],
      'foto'     => 'Default.jpg',
    ]);

    session()->setFlashdata('success', 'Register berhasil, sekarang konfirmasi pendaftaran di bagian administrator');
    return redirect()->to(base_url('sign-in'));
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to(base_url('sign-in'));
  }
}
