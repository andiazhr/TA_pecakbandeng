<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendpPerBulan extends Model
{
    protected $table = 'pendpperbulan';
    protected $primaryKey = 'id_pendpperbulan';
    protected $fillable = [
        'bulan',
        'total_pendpperbulan'
      ];
}
