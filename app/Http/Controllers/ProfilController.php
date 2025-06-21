<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function index()
    {
        return view('backend.profil.index');
    }

    public function data(){

        $data = DB::table('profils')
                ->join('users', 'users.id', '=', 'profils.id_user')
                ->leftjoin('jabatans', 'jabatans.id', '=', 'profils.id_jabatan')
                ->leftjoin('wilayahs', 'wilayahs.id', '=', 'profils.id_wilayah')
                ->select(
                    'users.name',
                    'users.email',
                    'users.no_wa',
                    'profils.*',
                    'wilayahs.kode', 
                    'wilayahs.nama as wilayah',
                    'jabatans.jabatan', 
                    'jabatans.sebagai'
                );

        if(Auth::user()->role == 'Admin'){
            $data = $data->get();
        }else{
            $data = $data->where('users.id', Auth::id())->get();
        }

        return response()->json(['data' => $data]);
        // return response()->json(['data' => $user]);
    }

    public function detail($id)
    {

        if(Auth::user()->role == 'Umum'){
            $id = Auth::id();
        }

       $profil = DB::table('profils')
                ->leftjoin('users', 'users.id', '=', 'profils.id_user')
                ->leftjoin('jabatans', 'jabatans.id', '=', 'profils.id_jabatan')
                ->leftjoin('wilayahs', 'wilayahs.id', '=', 'profils.id_wilayah')
                ->select(
                    'users.name',
                    'users.email',
                    'users.no_wa',
                    'profils.*',
                )
                ->where('profils.id_user', $id)
                ->first();

        return view('backend.profil.detail', [
            'profil' => $profil, 
            'id'    => $id
        ]);
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id_user,
            'no_wa' => 'required|unique:users,no_wa,' . $request->id_user, // Tambahkan pengecualian ID
            'nik' => 'required|unique:profils,nik, '. $request->id,
        ]);

        // dd($request);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $user = User::find($request->id_user);
            $data = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'no_wa' => $request->no_wa,
                'password' => $request->password ? Hash::make($request->password) : $user->password
            ]);

            $profil = Profil::find($request->id);
            $profil = $profil->update([
                'nik' => $request->nik, 
                'tanggal_lahir' => $request->tanggal_lahir, 
                'tempat_lahir' => $request->tempat_lahir, 
                'jenis_kelamin' => $request->jenis_kelamin, 
                'id_wilayah' => $request->id_wilayah, 
                'id_jabatan' => $request->id_jabatan, 
                'tanggal_mulai_kerja' => $request->tanggal_mulai_kerja, 
                'pendidikan_terakhir' => $request->pendidikan_terakhir
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }
}
