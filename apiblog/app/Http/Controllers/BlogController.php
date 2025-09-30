<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::with('penulis')->get();
        return response()->json($blog, 200);
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
                'judul' => 'required',
                'isi' => 'required',
                'tanggal_penulisan' => 'required',
                'penulis_id' => 'required|exists:penulis,id'
            ]
        );

        $blog = Blog::create($validate);  
        if($blog){
            $data['success'] = true;
            $data['message'] = "Data blog berhasil disimpan";
            $data['data'] = $blog;
            return response()->json($data,201);
        }                       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $blog = Blog::find($id);
        if ($blog) {
            $validate = $request->validate(
                [
                'judul' => 'required',
                'isi' => 'required',
                'tanggal_penulisan' => 'required',
                'penulis_id' => 'required|exists:penulis,id'
                ]
            );
        }
        
      Blog::where('id', $id)->update($validate);
      $blog = Blog::find($id);
        if($blog){
              $data['success'] = true;
              $data['message'] = "Data blog berhasil diperbarui";
              $data['data'] = $blog;
               return response()->json($data,200);
        }else{
             $data['success'] = false;
             $data['message'] = "Data blog tidak ditemukan";
             return response()->json($data,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $blog = Blog::where('id',$id);
        if($blog){
            $blog->delete(); 
              $data['success'] = true;
              $data['message'] = "Data blog berhasil dihapus";
               return response()->json($data,200);
        } else {
             $data['success'] = false;
             $data['message'] = "Data blog tidak ditemukan";
            return response()->json($data,404);
        }
    }
}
