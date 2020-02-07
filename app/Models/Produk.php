<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = [
        'id_kategori',
        'id_stok',
        'nama_produk',
        'deskripsi_produk',
        'gambar_produk',
        'harga_produk',
        'status'
      ];

    public function KategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class, 'id_kategori', 'id_kategori');
    }

    public function Stok()
    {
        return $this->belongsTo(Stok::class, 'id_stok', 'id_stok');
    }

    public function JenisAlatDapur()
    {
      return $this->belongsTo(JenisAlatDapur::class, 'id_jenis_alat_dapur', 'id_jenis_alat_dapur');
    }
    
    public function OrderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'id_produk', 'id_produk');
    }

    // jika ada error 
    // public function Produk()
    // {
    //     return $this->hasMany(Order::class, 'id_order', 'id_order');
    // }

    public function ProdukKegiatan()
    {
        return $this->hasMany(ProdukKegiatan::class, 'id_produk', 'id_produk');
    }

    public function Like()
    {
        return $this->hasMany(Like::class, 'id_produk', 'id_produk');
    }

    public function Review()
    {
        return $this->hasMany(Review::class, 'id_produk', 'id_produk');
    }
}
