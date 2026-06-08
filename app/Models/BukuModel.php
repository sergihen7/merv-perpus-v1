<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
  protected $table      = 'buku';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['judul', 'sampul', 'kategori', 'penerbit', 'pengarang', 'rak', 'tahun_terbit', 'isbn', 'stock'];
  protected $useTimestamps = true;
}
