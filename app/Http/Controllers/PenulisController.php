<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penulis = Penulis::with('blog')->get();
         return response()->json($penulis, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'nama' => 'required|unique:penulis',
                'email' => 'required',
            ]
        );

        $penulis = Penulis::create($validate);    //Simpan data
        if($penulis){
            $data['success'] = true;
            $data['message'] = "Data penulis berhasil disimpan";
            $data['data'] = $penulis;
            return response()->json($data,201);
        }                      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penulis = Penulis::with('blog')->find($id);

        if ($penulis) {
            $data['success'] = true;
            $data['message'] = 'Data ditemukan';
            $data['data'] = $penulis;
            return response()->json($data, 200);
        } else {
            $data['success'] = false;
            $data['message'] = 'Data tidak ditemukan';
            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penulis = Penulis::find($id);
        if ($penulis) {
            $validate = $request->validate(
                [
                    'nama' => 'required',
                    'email' => 'required',
                ]
            );
        }
        Penulis::where('id', $id)->update($validate);
      $penulis= Penulis::find($id);
        if($penulis){
              $data['success'] = true;
              $data['message'] = "Data penulis berhasil diperbarui";
              $data['data'] = $penulis;
               return response()->json($data,200);
        }else{
             $data['success'] = false;
              $data['message'] = "Data penulis tidak ditemukan";
               return response()->json($data,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $penulis= Penulis::where('id',$id);
        if($penulis){
            $penulis->delete(); 
              $data['success'] = true;
              $data['message'] = "Data penulis berhasil dihapus";
               return response()->json($data,200);
        } else {
             $data['success'] = false;
             $data['message'] = "Data penulis tidak ditemukan";
            return response()->json($data,404);
        }
    }
}
