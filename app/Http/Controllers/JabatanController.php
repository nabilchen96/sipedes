<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    public function index()
    {
        return view('backend.jabatan.index');
    }

    public function data()
    {
        $data = DB::table('jabatans')->get();
        return response()->json(['data' => $data]);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required',
            'sebagai' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = Jabatan::create([
                'jabatan' => $request->jabatan,
                'sebagai' => $request->sebagai,
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
            'jabatan' => 'required',
            'sebagai' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $user = Jabatan::find($request->id);
            $data = $user->update([
                'jabatan' => $request->jabatan,
                'sebagai' => $request->sebagai,
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

        $data = Jabatan::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
