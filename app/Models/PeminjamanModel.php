<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
  protected $table      = 'peminjaman';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['buku_id', 'user_id', 'kondisi_sebelum', 'kondisi_sesudah', 'status', 'durasi', 'batas_pinjam', 'tanggal_kembali', 'denda', 'denda_status'];
  protected $useTimestamps = true;
}
