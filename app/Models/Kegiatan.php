<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'periode_awal',
        'periode_akhir'
      ];

    public function ProdukKegiatan()
    {
        return $this->hasMany(ProdukKegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }
}
