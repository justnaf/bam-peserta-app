<?php

namespace App\Http\Controllers;

use App\Models\EduHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eduHist = EduHistories::where('user_id', Auth::id())->get();
        return view('profile.eduhistories.index', compact('eduHist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.eduhistories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $eduHist = new EduHistories();
        $eduHist->user_id = Auth::user()->id;
        $eduHist->stage = $request->stage;
        $eduHist->name = $request->name;
        $eduHist->graduate_year = $request->graduate_year;
        $eduHist->save();

        if ($eduHist->wasRecentlyCreated) {
            return redirect()->route('eduhistory.index')->with('success', 'Riwayat Pendidikan berhasil Ditambahkan');
        } else {
            return redirect()->route('eduhistory.index')->with('error', 'Riwayat Pendidikan Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EduHistories $eduhistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EduHistories $eduhistory)
    {
        return view('profile.eduhistories.edit', compact('eduhistory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EduHistories $eduhistory)
    {
        $eduhistory->stage = $request->stage;
        $eduhistory->name = $request->name;
        $eduhistory->graduate_year = $request->graduate_year;
        if ($eduhistory->save()) {
            return redirect()->route('eduhistory.index')->with('success', 'Riwayat Pendidikan berhasil Diperbarui');
        } else {
            return redirect()->route('eduhistory.index')->with('error', 'Riwayat Pendidikan Gagal Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EduHistories $eduhistory)
    {
        $eduhistory->delete();

        return redirect()->route('eduhistory.index')->with('success', 'Education Deleted successfully.');
    }
}
