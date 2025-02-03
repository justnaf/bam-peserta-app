<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Disease::where('user_id', Auth::id())->get();
        return view('profile.kesehatan.diseases.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.kesehatan.diseases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Disease();
        $data->user_id = Auth::id();
        $data->common = $request->common;
        $data->etc = $request->etc;
        $data->save();
        if ($data->wasRecentlyCreated) {
            return redirect()->route('diseases.index')->with('success', 'Riwayat Penyakit berhasil Ditambahkan');
        } else {
            return redirect()->route('diseases.index')->with('error', 'Riwayat Penyakit Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Disease $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disease $disease)
    {
        return view('profile.kesehatan.diseases.edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disease $disease)
    {
        $disease->common = $request->common;
        $disease->etc = $request->etc;
        if ($disease->save()) {
            return redirect()->route('diseases.index')->with('success', 'Update Riwayat Penyakit berhasil');
        } else {
            return redirect()->route('diseases.index')->with('error', 'Update Riwayat Penyakit Gagal');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disease $disease)
    {
        $disease->delete();

        return redirect()->route('diseases.index')->with('success', 'Riwayat Penyakit Berhasil Dihapus.');
    }
}
