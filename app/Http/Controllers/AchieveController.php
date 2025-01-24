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
        //
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
    public function edit(OwnAchievement $ownAchievement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OwnAchievement $ownAchievement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OwnAchievement $ownAchievement)
    {
        //
    }
}
