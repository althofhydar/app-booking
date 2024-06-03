<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'ticket_type',
        'location',
        'price',
        'tanggal',
        'event_name',
        'ticket_id',
        'payment_method',
    ];
}
