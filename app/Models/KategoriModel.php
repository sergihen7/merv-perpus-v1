<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
  protected $table      = 'kategori';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['kategori'];
  protected $useTimestamps = true;
}
