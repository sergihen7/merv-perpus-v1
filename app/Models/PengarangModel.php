<?php

namespace App\Models;

use CodeIgniter\Model;

class PengarangModel extends Model
{
  protected $table      = 'pengarang';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['pengarang'];
  protected $useTimestamps = true;
}
