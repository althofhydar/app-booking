<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_name',
        'ticket_type',
        'location',
        'price',
        'tanggal',
        'event_name',
        'ticket_id',
        'payment_method',
    ];

    // app/Models/Transaction.php

   // dalam model Transaction
public function ticket()
{
    return $this->belongsTo(Ticket::class);
}


}
