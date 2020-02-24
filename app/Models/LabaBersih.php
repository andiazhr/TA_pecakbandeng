<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LabaBersih extends Model
{
    protected $table = 'laba_bersih';
    protected $primaryKey = 'id_laba';
    protected $fillable = [
        'tanggal',
        'total'
      ];
}
