<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


    class History extends Model
    {
        protected $fillable = ['event_name', 'ticket_type', 'location', 'price', 'tanggal', 'start', 'end', 'payment_method','status','user_id'];
   
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
    }


   
