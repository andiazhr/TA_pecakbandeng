<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';
    protected $primaryKey = 'id_rating';
    protected $fillable = [
        'id_pelanggan',
        'id_produk',
        'nilai',
        'status'
      ];

    public function Pelanggan()
    {
        return $this->belongsTo(UsersPelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
          
    public function Produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
