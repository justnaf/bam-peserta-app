<?php

namespace App\Http\Controllers;

use App\Models\OwnPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OwnPaper::where('user_id', Auth::id())->get();
        return view('profile.paper.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.paper.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new OwnPaper();
        $data->user_id = Auth::id();
        $data->name = $request->name;
        $data->publish_year = $request->publish_year;
        $data->save();
        if ($data->wasRecentlyCreated) {
            return redirect()->route('ownpaper.index')->with('success', 'Data Karya Tulis berhasil Ditambahkan');
        } else {
            return redirect()->route('ownpaper.index')->with('error', 'Data Karya Tulis Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OwnPaper $ownPaper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OwnPaper $ownpaper)
    {
        return view('profile.paper.edit', compact('ownpaper'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OwnPaper $ownpaper)
    {
        $ownpaper->name = $request->name;
        $ownpaper->publish_year = $request->publish_year;
        if ($ownpaper->save()) {
            return redirect()->route('ownpaper.index')->with('success', 'Data Karya Tulis berhasil Diperbarui');
        } else {
            return redirect()->route('ownpaper.index')->with('error', 'Data Karya Tulis Gagal Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OwnPaper $ownpaper)
    {
        $ownpaper->delete();

        return redirect()->route('ownpaper.index')->with('success', 'Karya Tulis Berhasil DIhapus.');
    }
}
