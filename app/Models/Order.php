<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_pelanggan',
        'kode_order',
        'total_order',
        'status'
      ];

    public function Pelanggan()
    {
        return $this->belongsTo(UsersPelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
