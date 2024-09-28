<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'user_id',
        'store_id',
        'name',
        'email',
        'phone',
        'address',
        'd_charges',
        'discount',
        'total',
        'status',
        'self_invoice_url',
        'notes',
        'payment_method',
        'payment_id'
    ];

    protected $casts = [
        'created_at'  => 'datetime:d-m-Y',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getAll()
    {
        return Order::latest()->get();
    }
}