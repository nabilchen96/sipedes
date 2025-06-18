<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Umum') {
            return redirect('/profil');
        }

        $user = DB::table('users')->count();
        $desa = DB::table('wilayahs')->where('jenis', 'Kelurahan/Desa')->count();
        $kades = DB::table('profils')
            ->join('jabatans', 'jabatans.id', '=', 'profils.id_jabatan')
            ->where(function ($query) {
                $query->whereRaw('LOWER(jabatan) LIKE ?', ['%kepala desa%'])
                    ->orWhereRaw('LOWER(jabatan) LIKE ?', ['%kades%']);
            })
            ->count();
        $perangkat = DB::table('profils')
            ->join('jabatans', 'jabatans.id', '=', 'profils.id_jabatan')
            ->where(function ($query) {
                $query->whereRaw('LOWER(jabatan) LIKE ?', ['%perangkat desa%'])
                    ->orWhereRaw('LOWER(jabatan) LIKE ?', ['%perangkat%']);
            })
            ->count();

        return view('backend.dashboard', [
            'perangkat' => $perangkat,
            'desa' => $desa,
            'user' => $user,
            'kades' => $kades,
            'perangkat' => $perangkat
        ]);
    }

    public function dataPeta()
    {

        $data = DB::table('users')
            ->leftjoin('profils', 'profils.id_user', '=', 'users.id')
            ->leftjoin('jabatans', 'jabatans.id', '=', 'profils.id_jabatan')
            ->leftjoin('wilayahs', 'wilayahs.id', '=', 'profils.id_wilayah')
            ->select(
                'jabatans.jabatan',
                'jabatans.sebagai',
                'wilayahs.nama as nama_wilayah',
                'wilayahs.kode',
                'wilayahs.jenis',
                'wilayahs.latitude as latitude_wilayah',
                'wilayahs.longitude as longitude_wilayah',
                'profils.latitude',
                'profils.longitude',
                'users.name'
            )
            ->whereNotNull('profils.latitude')
            ->get();

        return response()->json($data);

    }
}