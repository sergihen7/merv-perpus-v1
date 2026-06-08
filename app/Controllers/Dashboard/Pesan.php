<?php

namespace App\Controllers\Dashboard;

class Pesan extends \App\Controllers\BaseController
{
  protected $pesanK;
  protected $userM;
  public function __construct()
  {
    $this->userM    = new \App\Models\UserModel();
    $this->pesanK = new \App\Models\PesanModel();
  }

  public function index()
  {
    $data = [
      'title'      => 'Pesan',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'pesan'      => $this->pesan
    ];

    return view('dashboard/pesan', $data);
  }

  public function baca($id = NULL)
  {
    if ($id == NULL) {
      return redirect()->to(base_url('dashboard/pesan'));
    }

    $data = [
      'title'      => 'Pesan',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,

    ];

    $data['pesan'] =  $this->pesanK
      ->select('pesan.*, user.username, user.id as user_id, user.foto')
      ->join('user', 'user.id = pesan.dari_user_id')
      ->where('untuk_user_id', session()->get('id'))
      ->find($id);

    if ($data['pesan']['status'] == 0) {
      $this->pesanK->save([
        'id'     => $data['pesan']['id'],
        'status' => '1',
      ]);
      return redirect()->to(base_url('dashboard/pesan/baca/' . $id));
    }

    return view('dashboard/pesan', $data);
  }

  public function terkirim()
  {
    $data = [
      'title'      => 'Pesan Terkirim',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'pesan'      =>
      $this->pesanK
        ->select('pesan.*, user.username, user.id as user_id, user.foto')
        ->join('user', 'user.id = pesan.untuk_user_id')
        ->where('dari_user_id', session()->get('id'))
        ->find()
    ];

    return view('dashboard/pesan-terkirim', $data);
  }
  public function baca_terkirim($id = NULL)
  {
    if ($id == NULL) {
      return redirect()->to(base_url('dashboard/message'));
    }

    $data = [
      'title'      => 'Pesan Terkirim',
      'app'        => $this->app,
      'user_login' => $this->user_login,
      'pesan_ttl'  => $this->pesan_total,
      'pesan'      =>
      $this->pesanK
        ->select('pesan.*, user.username, user.id as user_id, user.foto')
        ->join('user', 'user.id = pesan.untuk_user_id')
        ->where('dari_user_id', session()->get('id'))
        ->find($id)
    ];

    return view('dashboard/pesan-terkirim', $data);
  }


  public function send()
  {
    $form = $this->request->getPost();

    $user_data = $this->userM->where('username', $form['username'])->first();
    if (empty($user_data)) {
      session()->setFlashdata('msg-failed', "");
      return redirect()->to($_SERVER['HTTP_REFERER'])->withInput();
    }

    $this->pesanK->save([
      'dari_user_id'  => session()->get('id'),
      'untuk_user_id' => $user_data['id'],
      'judul'         => $form['title'],
      'isi'           => $form['content'],
      'status'        => '0',
    ]);
    session()->setFlashdata('msg-success', "");
    return redirect()->to($_SERVER['HTTP_REFERER']);
  }
}
