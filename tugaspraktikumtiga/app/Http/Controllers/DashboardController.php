<?php

namespace App\Http\Controllers;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_dosen = Dosen::count();
        $jumlah_mahasiswa = Mahasiswa::count();
        $jumlah_matkul = Matkul::count();
        return view('Dashboard.dashboard', compact('jumlah_dosen', 'jumlah_mahasiswa', 'jumlah_matkul'));
    }
}
