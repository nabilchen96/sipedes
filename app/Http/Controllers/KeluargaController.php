<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KeluargaController extends Controller
{
    public function detail($id)
    {
        return view('backend.keluarga.index', [
            'id' => $id,
        ]);
    }

    public function data($id)
    {
        if(Auth::user()->role == 'Umum'){
            $id = Auth::id();
        }

        $data = DB::table('keluargas')
            ->where('id_user', $id)
            ->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_keluarga' => 'required',
            'nik' => 'required',
            'sebagai' => 'required',
            'urutan' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = Keluarga::create([
                'nama_keluarga' => $request->nama_keluarga,
                'nik' => $request->nik,
                'sebagai' => $request->sebagai,
                'urutan' => $request->urutan,
                'id_user' => $request->id_user
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'id_user' => 'required',
            'nik' => 'required',
            'sebagai' => 'required',
            'urutan' => 'required',
            'nama_keluarga' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $user = Keluarga::find($request->id);
            $data = $user->update([
                'id_user' => $request->id_user, 
                'nik' => $request->nik,
                'nama_keluarga' => $request->nama_keluarga,
                'sebagai' => $request->sebagai,
                'urutan' => $request->urutan,
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = Keluarga::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
