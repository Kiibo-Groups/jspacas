<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Validator;

class PrintLabels extends Model
{
    use HasFactory;

    protected $table = 'print_labels';

    protected $fillable = [
        'crypt',
        'payload'
    ];


}