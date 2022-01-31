<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'users_id', 'code', 'notes', 
        'subtotal', 'shipping_price', 'total', 
        'transaction_status', 'shipping_status', 'resi'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}