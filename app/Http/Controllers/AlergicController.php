<?php

namespace App\Http\Controllers;

use App\Models\Alergic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlergicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Alergic::where('user_id', Auth::id())->get();
        return view('profile.kesehatan.alergics.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.kesehatan.alergics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Alergic();
        $data->user_id = Auth::id();
        $data->type = $request->type;
        $data->desc = $request->desc;
        $data->save();
        if ($data->wasRecentlyCreated) {
            return redirect()->route('alergics.index')->with('success', 'Riwayat Alergi berhasil Ditambahkan');
        } else {
            return redirect()->route('alergics.index')->with('error', 'Riwayat Alergi Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Alergic $alergic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alergic $alergic)
    {
        return view('profile.kesehatan.alergics.edit', compact('alergic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alergic $alergic)
    {
        $alergic->type = $request->type;
        $alergic->desc = $request->desc;
        if ($alergic->save()) {
            return redirect()->route('alergics.index')->with('success', 'Update Riwayat Alergi berhasil ');
        } else {
            return redirect()->route('alergics.index')->with('error', 'Update Riwayat Alergi Gagal ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alergic $alergic)
    {
        $alergic->delete();

        return redirect()->route('alergics.index')->with('success', 'Riwayat Alergi Berhasil Dihapus.');
    }
}
