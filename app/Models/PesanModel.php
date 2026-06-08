<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanModel extends Model
{
  protected $table      = 'pesan';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['dari_user_id', 'untuk_user_id', 'judul', 'isi', 'status'];
  protected $useTimestamps = true;
}
