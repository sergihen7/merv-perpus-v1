<?php

namespace App\Controllers\Dashboard\Admin;

class Home extends \App\Controllers\BaseController
{
    protected $peminjamanM;
    protected $userM;
    protected $bukuM;
    protected $notifM;
    public function __construct()
    {
        $this->peminjamanM = new \App\Models\PeminjamanModel();
        $this->userM       = new \App\Models\UserModel();
        $this->bukuM       = new \App\Models\BukuModel();
        $this->notifM      = new \App\Models\PemberitahuanModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Home',
            'app'        => $this->app,
            'user_login' => $this->user_login,
            'pesan_ttl'  => $this->pesan_total,
            'notif' => $this->notifM
                ->whereIn('level_akses', ['0', '2'])
                ->where('status', '1')
                ->orderBy('updated_at', 'DESC')
                ->find(),
        ];

        $data['user'] = $this->userM
            ->where('role', 'anggota')
            ->countAllResults();
        $data['buku'] = $this->bukuM
            ->countAllResults();
        $data['pinjaman'] = $this->peminjamanM
            ->whereIn('status', ['1', '0'])
            ->countAllResults();
        $data['pengembalian'] = $this->peminjamanM
            ->where('status', '2')
            ->countAllResults();

        return view('dashboard/admin/home', $data);
    }
}
