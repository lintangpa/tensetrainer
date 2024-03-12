<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievement'; 

    protected $fillable = [
        'nama',
        'deskripsi',
        'requirement',
        'icon',
    ];

    protected $casts = [
        'requirement' => 'json', 
    ];
}
