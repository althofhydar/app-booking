<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index() 
    {
        $kategori = kategori::get();

        return view('kategori/index', ['kategori' => $kategori]);
    }

    public function tambah()
    {
        return view('kategori.form');
    }

    public function simpan(Request $request)
    {
        kategori::create(['nama'=>$request->nama]);

        return redirect()->route('kategori');
    }

    public function edit($id)
    {
        $kategori = kategori::find($id);

        return view('kategori.form', ['kategori' => $kategori]);
    }

    public function update($id, Request $request)
    {
        kategori::find($id)->update(['nama'=>$request->nama]);

        return redirect()->route('kategori');
    }

    public function hapus($id)
    {
        kategori::find($id)->delete();

        return redirect()->route('kategori');
    }

}
