<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $validate = $request->validate([
            'name' =>'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation'=> 'required|same:password'
        ]);

        $validate ['password'] = bcrypt($request['password']);

        $user = User::create($validate);
        if($user){
            $data['success'] = true;
            $data['message'] = 'User berhasil disimpan';
            $data['data'] = $user->name;   
            $data['token'] = $user->createToken('MDPApp')->plainTextToken;
            return response()->json($data,Response::HTTP_CREATED); //201
        } else {
            $data['success'] = false;
            $data['message'] = 'User gagal disimpan';
            return response()->json($data,Response::HTTP_BAD_REQUEST); //404
        }
    }
    public function login(Request $request){
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            //Ambil data user
            $user = Auth::user();
            $data['success'] = true;
            $data['message'] = 'Login berhasil';
            $data['token'] = $user->createToken('MDPApp')->plainTextToken;
            $data['data'] = $user;
            return response() -> json($data,Response::HTTP_OK); //200
        } else {
            $data['success'] = false;
            $data['message'] = 'Email atau Password salah!';
            return response() -> json($data,Response::HTTP_UNAUTHORIZED);   //401
        }
    }
}
