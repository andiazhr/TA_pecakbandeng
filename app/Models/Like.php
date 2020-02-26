<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'like';
    protected $primaryKey = 'id_like';
    protected $fillable = [
        'id_pelanggan',
        'id_produk',
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
