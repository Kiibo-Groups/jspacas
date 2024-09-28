<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'img',
        'status',
        'position',
        'title',
        'subtitle',
        'descript'
    ];

   
}
