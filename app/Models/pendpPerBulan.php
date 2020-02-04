<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendpPerBulan extends Model
{
    protected $table = 'pendpperbulan';
    protected $primaryKey = 'id_pendpPerBulan';
    protected $fillable = [
        'bulan',
        'total_pendpperbulan'
      ];
}
