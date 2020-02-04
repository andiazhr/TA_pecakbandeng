<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendpPerTahun extends Model
{
    protected $table = 'pendppertahun';
    protected $primaryKey = 'id_pendppertahun';
    protected $fillable = [
        'tahun',
        'total_pendppertahun'
      ];
}
