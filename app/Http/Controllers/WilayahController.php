<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WilayahController extends Controller
{
    public function index()
    {
        return view('backend.wilayah.index');
    }

    public function data()
    {
        $data = DB::table('wilayahs')
            ->get();


        return response()->json(['data' => $data]);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kode' => 'required|unique:wilayahs',
            'jenis' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = Wilayah::create([
                'nama' => $request->nama,
                'kode' => $request->kode,
                'jenis' => $request->jenis,
                'induk' => $request->induk,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
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
            'nama' => 'required',
            'jenis' => 'required',
            'kode' => 'required|unique:wilayahs,kode,' . $request->id,
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $user = Wilayah::find($request->id);
            $data = $user->update([
                'nama' => $request->nama,
                'kode' => $request->kode,
                'jenis' => $request->jenis,
                'induk' => $request->induk,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
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

        $data = Wilayah::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }

    public function searchWilayah(Request $request)
    {

        $search = $request->input('q');

        $results = DB::table('wilayahs')->where('jenis', 'Kelurahan/Desa')->get();

        return response()->json($results);
    }
}
