<?php

namespace App\Http\Controllers;

use App\Models\OrgHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OrgHistories::where('user_id', Auth::id())->get();
        return view('profile.orghistories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.orghistories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new OrgHistories();
        $data->user_id = Auth::id();
        $data->name = $request->name;
        $data->position = $request->position;
        $data->period = $request->period;
        $data->save();
        if ($data->wasRecentlyCreated) {
            return redirect()->route('orgHistories.index')->with('success', 'Riwayat Organisasi berhasil Ditambahkan');
        } else {
            return redirect()->route('orgHistories.index')->with('error', 'Riwayat Organisasi Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrgHistories $orgHistories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrgHistories $orgHistory)
    {
        return view('profile.orghistories.edit', compact('orgHistory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrgHistories $orgHistory)
    {
        $orgHistory->position = $request->position;
        $orgHistory->name = $request->name;
        $orgHistory->period = $request->period;
        if ($orgHistory->save()) {
            return redirect()->route('orgHistories.index')->with('success', 'Riwayat Organisasi berhasil Diperbarui');
        } else {
            return redirect()->route('orgHistories.index')->with('error', 'Riwayat Organisasi Gagal Diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrgHistories $orgHistory)
    {
        $orgHistory->delete();

        return redirect()->route('orgHistories.index')->with('success', 'Riwayat Organisasi Deleted successfully.');
    }
}
