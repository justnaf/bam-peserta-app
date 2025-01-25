<?php

namespace App\Http\Controllers;

use App\Models\OwnAchievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchieveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OwnAchievement::where('user_id', Auth::id())->get();
        return view('profile.achievement.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.achievement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new OwnAchievement();
        $data->user_id = Auth::id();
        $data->name = $request->name;
        $data->achieve_year = $request->achieve_year;
        $data->save();
        if ($data->wasRecentlyCreated) {
            return redirect()->route('achievement.index')->with('success', 'Data Perstasi berhasil Ditambahkan');
        } else {
            return redirect()->route('achievement.index')->with('error', 'Data Perstasi Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OwnAchievement $ownAchievement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OwnAchievement $achievement)
    {
        return view('profile.achievement.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OwnAchievement $achievement)
    {
        $achievement->name = $request->name;
        $achievement->achieve_year = $request->achieve_year;
        if ($achievement->save()) {
            return redirect()->route('achievement.index')->with('success', 'Data Perstasi berhasil Diperbarui');
        } else {
            return redirect()->route('achievement.index')->with('error', 'Data Perstasi Gagal Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OwnAchievement $achievement)
    {
        $achievement->delete();

        return redirect()->route('achievement.index')->with('success', 'Prestasi Deleted successfully.');
    }
}
