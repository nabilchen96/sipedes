<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function detail($id)
    {
        if(Auth::user()->role == 'Umum'){
            $id = Auth::id();
        }

        $profil = DB::table('profils')
            ->leftjoin('users', 'users.id', '=', 'profils.id_user')
            ->leftjoin('jabatans', 'jabatans.id', '=', 'profils.id_jabatan')
            ->leftjoin('pegawais', 'pegawais.id_user', '=', 'users.id')
            ->select(
                'jabatans.jabatan',
                'jabatans.sebagai',
                'pegawais.*'
            )
            ->where('profils.id_user', $id)
            ->first();

        return view('backend.pegawai.index', [
            'id' => $id,
            'profil' => $profil
        ]);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
        ]);

        // dd($request);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $pegawai = Pegawai::updateOrCreate(
                [
                    'id_user' => $request->id_user
                ],
                [
                    'id_bank' => $request->id_bank,
                    'no_rekening' => $request->no_rekening,
                    'nama_rekening' => $request->nama_rekening,
                    'no_sk' => $request->no_sk,
                    'siltap' => $request->siltap,
                    'potongan_bpjs' => $request->potongan_bpjs,
                    'tunjangan' => $request->tunjangan,
                    'tmt_mulai_bertugas' => $request->tmt_mulai_bertugas,
                    'tmt_berhenti_bertugas' => $request->tmt_berhenti_bertugas
                ]
            );

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }
}
