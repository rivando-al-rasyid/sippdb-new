<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'external_id',
        'payer_email',
        'description',
        'amount',
        'status',
        'checkout_link',
    ];

}
