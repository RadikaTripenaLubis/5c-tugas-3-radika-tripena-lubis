<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class DosenController extends Controller
{
    public function index(){
        $dosens= Dosen::all();
        return view('dosen.index',[
            'dosens' => $dosens
        ]);
    }
    public function create()
    {
        return view('dosen.create');
    }


    public function store(Request $request, Dosen $dosen)
    {
        $validate= $request->validate(
           [
            'nama' => 'required|max:30',
            'nidn' => 'required',
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
            request()->photo->move(public_path('storage/dosen/'), $filename);
            $validate['photo'] = $filename;
        }
        Dosen::create($validate);

        return redirect()->route('dosens.index')->with('message',"Data {$validate['nama']} berhasil ditambahkan");
    }

    public function edit(Dosen $dosen){
        return view('dosen.edit',[
            'dosen' => $dosen
        ]);
    }


    public function update(Request $request, Dosen $dosen){
        $validate= $request->validate(
            [
             'nama' => 'required|max:30',
             'nidn' => 'required',
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
            request()->photo->move(public_path('storage/dosen/'), $filename);
            $validate['photo'] = $filename;
        }

         Dosen::where('id', $dosen->id)->update($validate);
         return redirect()->route('dosens.index')->with('message',"Data {$validate['nama']} berhasil diedit");
    }

    public function destroy(Dosen $dosen){
        $image_path ='storage/dosen/'.$dosen->photo;
        if (File::exists(public_path( $image_path ))){
           unlink($image_path);
        }

        Dosen::destroy($dosen->id);
        return redirect()->route('dosens.index')->with('message',"Data $dosen->nama berhasil dihapus");

    }


}
