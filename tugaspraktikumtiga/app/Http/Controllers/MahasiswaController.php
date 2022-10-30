<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswas= Mahasiswa::all();
        return view('mahasiswa.index',[
            'mahasiswas' => $mahasiswas
        ]);
    }
    public function create()
    {
        return view('mahasiswa.create');
    }


    public function store(Request $request, Mahasiswa $mahasiswa)
    {
        $validate= $request->validate(
           [
            'nama' => 'required|max:30',
            'npm' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'photo' => 'required|file|image|max:2048'
           ]
        );

        if ($request->hasfile('photo')) {
            $validate['photo'] = $request->file('photo');
            $extension = $validate['photo']->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            request()->photo->move(public_path('storage/mahasiswa/'), $filename);
            $validate['photo'] = $filename;
        }
        Mahasiswa::create($validate);

        return redirect()->route('mahasiswas.index')->with('message',"Data {$validate['nama']} berhasil ditambahkan");
    }

    public function edit(Mahasiswa $mahasiswa){
        return view('mahasiswa.edit',[
            'mahasiswa' => $mahasiswa
        ]);
    }


    public function update(Request $request, Mahasiswa $mahasiswa){
        $validate= $request->validate(
            [
             'nama' => 'required|max:30',
             'npm' => 'required',
             'jenis_kelamin' => 'required',
             'alamat' => 'required',
             'tempat_lahir' => 'required',
             'tanggal_lahir' => 'required',
            ]
         );

         if ($request->hasfile('photo')) {
            if ($request->oldPhoto){
                unlink($request->oldPhoto);
            }
            $validate['photo'] = $request->file('photo');
            $extension = $validate['photo']->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            request()->photo->move(public_path('storage/mahasiswa/'), $filename);
            $validate['photo'] = $filename;
        }

         Mahasiswa::where('id', $mahasiswa->id)->update($validate);
         return redirect()->route('mahasiswas.index')->with('message',"Data {$validate['nama']} berhasil diedit");
    }

    public function destroy(Mahasiswa $mahasiswa){
        $image_path ='storage/mahasiswa/'.$mahasiswa->photo;
        if (File::exists(public_path( $image_path ))){
            unlink($image_path);
         }
        Mahasiswa::destroy($mahasiswa->id);
        return redirect()->route('mahasiswas.index')->with('message',"Data $mahasiswa->nama berhasil dihapus");

    }


}
