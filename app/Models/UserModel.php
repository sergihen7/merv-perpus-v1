<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table      = 'user';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['username', 'nis', 'password', 'foto', 'email', 'fullname', 'alamat', 'verif', 'role'];
  protected $useTimestamps = true;
}
