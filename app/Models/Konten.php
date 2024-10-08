<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;

    protected $table = 'konten';

    protected $fillable = [
        'nama',
        'content',
    ];

    protected $casts = [
        'nama' => 'string',
        'content' => 'json'
    ];
}
