<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $fillable = [
        'nama_matkul',
        'kode_matkul',
        'sks',
    ];
}
