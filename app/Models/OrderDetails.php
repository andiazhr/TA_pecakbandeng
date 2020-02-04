<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id_order_details';
    protected $fillable = [
        'id_order',
        'id_produk',
        'catatan',
        'status',
        'ongkir',
        'jumbel_produk',
        'harga_produk',
        'bobot_produk'
      ];

    public function Order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }
    
    public function Produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
