<?php

namespace App\Models;

use CodeIgniter\Model;

class PemberitahuanModel extends Model
{
  protected $table      = 'pemberitahuan';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ["judul", "isi", "level_akses", "status"];
  protected $useTimestamps = true;
}
