<?php

namespace App\Models;

use CodeIgniter\Model;

class RakModel extends Model
{
  protected $table      = 'rak';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['rak'];
  protected $useTimestamps = true;
}
