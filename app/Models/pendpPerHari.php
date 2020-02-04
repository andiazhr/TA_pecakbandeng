<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendpPerHari extends Model
{
    protected $table = 'pendpperhari';
    protected $primaryKey = 'id_pendpperhari';
    protected $fillable = [
        'kode_pendpperhari',
        'total_pendpperhari'
      ];
}
