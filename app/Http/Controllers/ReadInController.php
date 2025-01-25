<?php

namespace App\Http\Controllers;

use App\Models\ReadInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReadInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ReadInterest::where('user_id', Auth::id())->get();
        return view('profile.readinterest.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.readinterest.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new ReadInterest();
        $data->user_id = Auth::id();
        $data->type = $request->type;
        $data->name = $request->name;
        $data->authors = $request->authors;
        $data->save();
        if ($data->wasRecentlyCreated) {
            return redirect()->route('readInterest.index')->with('success', 'Data Minat Baca berhasil Ditambahkan');
        } else {
            return redirect()->route('readInterest.index')->with('error', 'Data Minat Bacas Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ReadInterest $readInterest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReadInterest $readInterest)
    {
        return view('profile.readinterest.edit', compact('readInterest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReadInterest $readInterest)
    {
        $readInterest->type = $request->type;
        $readInterest->name = $request->name;
        $readInterest->authors = $request->authors;
        if ($readInterest->save()) {
            return redirect()->route('readInterest.index')->with('success', 'Data Minat Baca berhasil Diperbarui');
        } else {
            return redirect()->route('readInterest.index')->with('error', 'Data Minat Bacas Gagal Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReadInterest $readInterest)
    {
        $readInterest->delete();

        return redirect()->route('readInterest.index')->with('success', 'Minat Baca Berhasil Dihapus.');
    }
}
