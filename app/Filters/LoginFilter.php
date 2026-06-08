<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (!session()->has('id')) {
      return redirect()->to(base_url('sign-in'));
    }
    $user_cek = new \App\Models\UserModel();
    $user_cek = $user_cek->find(session()->get('id'));

    if ($user_cek['verif'] == '0') {
      return redirect()->to(base_url('auth/logout'));
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
