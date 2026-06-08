<?php

namespace App\Controllers\Dashboard;

class Profile extends \App\Controllers\BaseController
{
  protected $userM;
  public function __construct()
  {
    $this->userM = new \App\Models\UserModel();
  }

  public function index()
  {
    $form = $this->request->getPost();
    $data = [
      'title'      => 'Profile',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'validation' => \Config\Services::validation(),
    ];

    if (empty($form)) {
      return view('dashboard/profile', $data);
    }

    $rule = [
      'username' => 'required|is_unique[user.username]',
      'email'    => 'required|is_unique[user.email]',
      'fullname' => 'required',
      'img'  => 'mime_in[img,image/jpg,image/jpeg,image/gif,image/png]',
    ];

    $user_data = $this->userM->find(session()->get('id'));

    if ($form['username'] == $user_data['username']) {
      $rule['username'] = 'required';
    }
    if ($form['email'] == $user_data['email']) {
      $rule['email'] = 'required';
    }

    if (!$this->validate($rule)) {
      return redirect()->to(base_url('dashboard/profile'))->withInput();
    }

    $img = $this->request->getFile('img');
    // dd($form, $img);

    $save = [
      'id'       => session()->get('id'),
      'username' => $form['username'],
      'email'    => $form['email'],
      'fullname' => $form['fullname'],
      'alamat'   => $form['alamat'],
    ];

    if (!empty($form['password'])) {
      $save['password'] = password_hash($form['password'], PASSWORD_DEFAULT);
    }

    if ($img->getError() !== 4) {
      $nameimg = $img->getRandomName();
      $img->move('img/profile', $nameimg);
      $save['foto'] = $nameimg;
    }

    $this->userM->save($save);

    session()->setFlashdata('success', 'Profile saved');
    return redirect()->to(base_url('dashboard/profile'));
  }
}
