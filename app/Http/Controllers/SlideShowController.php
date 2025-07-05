<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlideShow;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class SlideShowController extends Controller
{
    public function index()
    {
        return view('backend.slide_show.index');
    }

    public function data()
    {
        $data = DB::table('slide_shows')->get();
        return response()->json(['data' => $data]);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|mimes:jpg,jpeg,png',
            'judul' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            //GAMBAR
            if ($request->gambar) {
                $gambar = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('slide_show'), $gambar);
            }

            $data = SlideShow::create([
                'gambar'    => $gambar, 
                'judul'     => $request->judul,
                'status'    => $request->status
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
            'gambar' => 'required|mimes:jpg,jpeg,png',
            'judul' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            //GAMBAR
            if ($request->gambar) {
                $gambar = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('slide_show'), $gambar);
            }

            $data = SlideShow::find($request->id);
            $data = $data->update([
                'gambar'    => $gambar ?? $data->gambar, 
                'judul'     => $request->judul,
                'status'    => $request->status
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

        $data = SlideShow::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
