<?php

namespace App\Models;

use CodeIgniter\Model;

class AplikasiModel extends Model
{
  protected $table      = 'aplikasi';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ["nama_app", "foto", "logo", "alamat_app", "email_app", "nomor_hp", "copyright"];
  protected $useTimestamps = true;
}
