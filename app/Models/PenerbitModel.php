<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerbitModel extends Model
{
  protected $table      = 'penerbit';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['penerbit', 'kode_penerbit'];
  protected $useTimestamps = true;
}
