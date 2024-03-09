<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    use HasFactory;

    protected $table = 'achievements'; // Nama tabel

    protected $fillable = [
        'nama',
        'deskripsi',
        'syarat',
        'icon',
        'points',
    ];

    protected $casts = [
        'syarat' => 'json', // Kolom "syarat" di-cast ke dalam format JSON
    ];
}
