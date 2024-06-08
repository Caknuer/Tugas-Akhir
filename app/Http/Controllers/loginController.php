<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    
     function index()
    {
        return view('sesi/index');
    }
     function login(Request $request)
    { 
        Session::flash('email', $request->email);  
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email belum diisi',
            'password.required' => 'Password juga diisi',
        ]);

        $PSG =[
            'email'=>$request->email,
            'password'=>$request->password
        ];
        
        if (Auth::attempt( $PSG )) {
            return redirect('mahasiswa')->with('success', 'Berhasil Login');
        } else{
            return redirect('sesi')->withErrors('Username dan Password yang dimasukkan tidak valid');
        };
    }
     function logout(Request $request)
    {
        Auth::logout();
        return redirect('/sesi')->with('succes', 'Berhasil Logout');
    }
     function register()
     {
        return view('sesi/register');
     }
     function create(Request $request)
     {
        Session::flash('name', $request->name);  
        Session::flash('email', $request->email);  
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:6',
        ],[
            'name.required'=>'Nama belum diisi',
            'email.required'=>'Email belum diisi',
            'email.email'=>'Silahkan masukkan email yang valid',
            'email.unique'=>'Email sudah tertera, silakan masukkan yang lain',
            'password.required'=>'Password juga diisi',
            'password.min'=>'Minimal password yang diizinkan adalah 6 karakter ',
        ]);

        $NOTE =[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ];

        User::create($NOTE);
        
        $PSG =[
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if (Auth::attempt( $PSG )) {
            return redirect('sesi')->with('success', Auth::User()->name,'Berhasil Login');
        } else{
            return redirect('sesi')->withErrors('Username dan Password yang dimasukkan tidak valid');
        };
     }
}
