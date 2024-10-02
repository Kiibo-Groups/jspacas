<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Validator;

class Entradas extends Model
{
    use HasFactory;

    protected $table = 'entradas';

    protected $fillable = [
       'products_id',
       'barcode',
       'qty',
       'user_id'
    ];
}