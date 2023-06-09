<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = DB::table('pasiens')->paginate(10);
        return view('admin.data-pasien', compact('pasien'));
    }

    public function create()
    {
        return view('admin.tambah-pasien');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_pasien' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'umur' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        // insert pasien
        DB::table('pasiens')
            ->insert([
                'nama_pasien' => $request->nama_pasien,
                'tanggal_lahir' => $request->tanggal_lahir,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
            ]);


        return redirect()->route('pasien.index')
            ->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function show(Request $request)
    {
        $pasien = DB::table('pasiens')
            ->where('id', $request->id)
            ->first();

        // return component
        return view('admin.detail-pasien', compact('pasien'));
    }

    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        $pasien->delete();

        return redirect()->route('pasien.index')
            ->with(['success' => 'Pasien berhasil dihapus.']);
    }

    public function edit($id)
    {
        $pasien = Pasien::find($id);
        return view('admin.edit-pasien', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'umur' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
        ]);

        $pasien = Pasien::find($id);
        $pasien->update($request->all());

        return redirect()->route('pasien.index')
            ->with('success', 'Pasien berhasil diupdate.');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $pasien = Pasien::where('nama_pasien', 'like', "%" . $search . "%")->paginate(10);

        return view('admin.data-pasien', compact('pasien'));
    }
}
