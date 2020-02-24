<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    protected $fillable = [
        'nama_barang',
        'tanggal',
        'total'
      ];
}
