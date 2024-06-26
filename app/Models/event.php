<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = ['event_name','event_date','location','image','start_time','end_time'];

    // Event.php (Model)
public function tickets() {
    return $this->hasMany(Ticket::class);
    
}


   
}
