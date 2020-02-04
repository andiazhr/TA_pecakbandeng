<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukKegiatan extends Model
{
    protected $table = 'produk_kegiatan';
    protected $primaryKey = 'id_produk_kegiatan';
    protected $fillable = [
        'id_kegiatan',
        'id_produk',
        'discount'
      ];

    public function Kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }

    public function Produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
