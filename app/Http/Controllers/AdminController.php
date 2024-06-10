<?php

namespace App\Http\Controllers;

use App\Models\Cek;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function cek()
    {
        $table['cek'] = Cek::all();
        return view('admin.cek', $table);
    }//
}
