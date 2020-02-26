<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'id_review';
    protected $fillable = [
        'id_pelanggan',
        'id_produk',
        'review',
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
