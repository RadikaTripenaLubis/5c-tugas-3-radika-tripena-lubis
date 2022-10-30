<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;



class MatkulController extends Controller
{
    public function index(){
        $matkuls= Matkul::all();
        return view('matkul.index',[
            'matkuls' => $matkuls
        ]);
    }
    public function create()
    {
        return view('matkul.create');
    }


    public function store(Request $request, Matkul $matkul)
    {
        $validate= $request->validate(
           [
            'kode_mk' => 'required',
            'nama_mk' => 'required|max:30',
           ]
        );

        Matkul::create($validate);

        return redirect()->route('matkuls.index')->with('message',"Data {$validate['nama_mk']} berhasil ditambahkan");
    }

    public function edit(Matkul $matkul){
        return view('matkul.edit',[
            'matkul' => $matkul
        ]);
    }


    public function update(Request $request, Matkul $matkul){
        $validate= $request->validate(
            [
             'kode_mk' => 'required',
             'nama_mk' => 'required|max:30',
            ]
         );

         Matkul::where('id', $matkul->id)->update($validate);
         return redirect()->route('matkuls.index')->with('message',"Data {$validate['nama_mk']} berhasil diedit");
    }

    public function destroy(Matkul $matkul){
        Matkul::destroy($matkul->id);
        return redirect()->route('matkuls.index')->with('message',"Data $matkul->nama_mk berhasil dihapus");

    }


}
