<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (session()->has('id')) {
      if (session()->has("role")) {
        if (session()->get("role") == "admin") {
          return redirect()->to(base_url('dashboard/admin'));
        } elseif (session()->get("role") == "anggota") {
          return redirect()->to(base_url('dashboard/member'));
        }
      } else {
        return redirect()->to(base_url('auth/logout'));
      }
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
