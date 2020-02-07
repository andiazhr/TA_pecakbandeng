<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stok';
    protected $primaryKey = 'id_stok';
    protected $fillable = [
        'nama_barang',
        'stok',
        'status'
      ];
      
    public function Produk()
    {
        return $this->hasMany(Produk::class, 'id_produk', 'id_produk');
    }
}
