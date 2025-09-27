<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    // nama tabel (opsional, kalau sesuai konvensi "ruangans" tidak perlu)
    protected $table = 'ruangans';

    // field yang boleh diisi mass assignment (create/update)
    protected $fillable = [
        'nama',
        'lokasi',
        'kapasitas',
    ];
}
