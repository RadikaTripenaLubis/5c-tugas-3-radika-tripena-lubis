@extends('layout.master')
@section('judul_halaman','Mahasiswa')
@section('active2','active')
@section('isi')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="text-center">Masukan Data Mahasiswa lengkap</h2>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif
        <form enctype="multipart/form-data" action="{{route("mahasiswas.update",['mahasiswa'=>$mahasiswa->id])}}" method="POST">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Lengkap" class="form-control" value="{{old('nama') ?? $mahasiswa->nama}}">
                @error('nama')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class=" mb-3">
                <label for="npm">NPM</label>
                <input type="text" name="npm" id="npm" placeholder="Masukkan NPM" class="form-control" value="{{old('npm') ?? $mahasiswa->npm}}">
                @error('npm')
                    <div class="text-danger">{{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                    <option value="Laki-laki" {{old('jenis_kelamin') ?? $mahasiswa->jenis_kelamin=="Laki-laki"? "selected" : " "}}>Laki-laki</option>
                    <option value="Perempuan" {{old('jenis_kelamin') ?? $mahasiswa->jenis_kelamin=="Perempuan"? "selected" : " "}}>Perempuan</option>
                </select>
                @error('nama')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" placeholder="Masukkan Alamat" class="form-control">{{old('alamat')?? $mahasiswa->alamat}}</textarea>
                @error('alamat')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="Masukkan Tempat Lahir" placeholder="Masukkan tempat_lahir" class="form-control" value="{{old('tempat_lahir') ?? $mahasiswa->tempat_lahir}}">
                @error('tempat_lahir')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
                <div class="form-group mb-3">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{old('tanggal_lahir')?? $mahasiswa->tanggal_lahir}}">
                @error('tanggal_lahir')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <h6>Foto Lama</h6>
                <img src="{{asset('storage/mahasiswa/'. $mahasiswa->photo)}}" alt="" style="height: 200px; width:200px;">
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Masukan Foto Baru</label>
                <input type="hidden" name="oldPhoto" value="{{'storage/mahasiswa/' . $mahasiswa->photo}}">
                <input class="form-control" type="file" id="photo" name="photo">
                @error('photo')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>

@endsection
