<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;

class HistoryController extends Controller
{
    public function index()
    {
        
        return view('history');
    }
}
