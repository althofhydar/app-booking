<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;

class HomeController extends Controller

{
 public function index()
 {
     $events = Event::all();
     $tickets = Ticket::all();
   

     return view('events', compact('events', 'tickets'));
 }
 

 public function detail()
 {
     return view('detail');
 }

}
