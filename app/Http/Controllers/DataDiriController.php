<?php

namespace App\Http\Controllers;

use App\Models\DataDiri;
use Illuminate\Http\Request;

class DataDiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.datadiri.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DataDiri $dataDiri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataDiri $dataDiri)
    {
        return view('profile.datadiri.edit', compact('dataDiri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataDiri $dataDiri)
    {
        $dataDiri->name = $request->name;
        $dataDiri->address = $request->address;
        $dataDiri->gender = $request->gender;
        $dataDiri->birth_date = $request->birth_date;
        $dataDiri->birth_place = $request->birth_place;
        $dataDiri->phone_number = $request->phone_number;
        if ($dataDiri->save()) {
            return redirect()->route('dataDiri.index')->with('success', 'Data Diri berhasil Diperbarui');
        } else {
            return redirect()->route('dataDiri.index')->with('error', 'Data Diri Gagal Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataDiri $dataDiri)
    {
        //
    }
}
