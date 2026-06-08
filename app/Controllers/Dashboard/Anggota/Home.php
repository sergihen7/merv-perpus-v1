<?php

namespace App\Controllers\Dashboard\Anggota;

class Home extends \App\Controllers\BaseController
{
    protected $peminjamanM;
    protected $notifM;
    public function __construct()
    {
        $this->peminjamanM = new \App\Models\PeminjamanModel();
        $this->notifM      = new \App\Models\PemberitahuanModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Home',
            'app'        => $this->app,
            'user_login' => $this->user_login,
            'pesan_ttl'  => $this->pesan_total,
            'peminjaman_ttl' => $this->peminjamanM
                ->where('user_id', session()->get('id'))
                ->whereIn('status', ['0', '1'])
                // ->where('status', '0')
                // ->orWhere('status', '1')
                ->countAllResults(),
            'pengembalian_ttl' => $this->peminjamanM
                ->where('status', '2')
                ->where('user_id', session()->get('id'))
                ->countAllResults(),
            'notif' => $this->notifM
                ->whereIn('level_akses', ['0', '1'])
                ->where('status', '1')
                ->orderBy('updated_at', 'DESC')
                ->find(),
        ];

        return view('dashboard/anggota/home', $data);
    }
}
