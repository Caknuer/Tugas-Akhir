<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 3;
           
        if(strlen($katakunci)){
            $data = mahasiswa::where('nim','like',"%$katakunci%")
            ->orWhere('nama','like',"%$katakunci%")
            ->orWhere('jurusan','like',"%$katakunci%")
            ->paginate($jumlahbaris);
        } else {
            $data = mahasiswa::orderBy('nim','desc')->paginate($jumlahbaris);
        }
        return view('mhs.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mhs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nim', $request->nim);
        Session::flash('nama', $request->nama);
        Session::flash('jurusan', $request->jurusan);

        $request->validate ([
            'nim'=>'required|numeric|unique:mahasiswa,nim',
            'nama'=>'required',
            'jurusan'=>'required',
        ],[
            'nim.required'=>'NIM wajib diisi',
            'nim.numeric'=>'NIM wajib dalam angka',
            'nim.unique'=>'NIM yang diisikan sudah dalam database',
            'nama.required'=>'NAMA wajib diisi',
            'jurusan.required'=>'JURUSAN wajib diisi',
        ]);
        $PDD = [
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,
        ];
        mahasiswa::create($PDD);

        return redirect()->to('mahasiswa')->with('Masok pak eko','Data anda sudah diterima');
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
        $data = mahasiswa::where('nim', $id)->first();
        return view('mhs.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate ([
            'nama'=>'required',
            'jurusan'=>'required',
        ],[
            'nama.required'=>'NAMA wajib diisi',
            'jurusan.required'=>'JURUSAN wajib diisi',
        ]);
        $PDD = [
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,
        ];
        mahasiswa::where('nim',$id)->update($PDD);
        return redirect()->to('mahasiswa')->with('Masok pak eko','Data anda sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('Masok pak eko','Data terhapus');
    }
}
