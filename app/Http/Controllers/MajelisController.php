<?php

namespace App\Http\Controllers;

use App\Models\Majelis;
use App\Models\PresenceMajelis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class MajelisController extends Controller
{
    public function index()
    {
        $kajian = Majelis::whereNotIn('status', ['done', 'draft'])->get();
        return view('majelis.index', compact('kajian'));
    }

    public function listView()
    {
        $cek = PresenceMajelis::where('user_id_presenced', Auth::id())->where('majelis_id', null)->count();
        $data = PresenceMajelis::where('user_id_presenced', Auth::id())->with(['majelis'])->get();
        return view('majelis.list', compact(['data', 'cek']));
    }

    public function edit($kajianId)
    {
        $data = PresenceMajelis::find($kajianId);
        return view('majelis.edit', compact('data'));
    }

    public function update(PresenceMajelis $kajianId, Request $request)
    {
        $kajianId->resume = $request->resume;
        if ($kajianId->save()) {
            return redirect()->route('kajian.list')->with('success', 'Sukses Menambahkan Resume');
        }
        return redirect()->route('kajian.list')->with('error', 'Gagal Menambahkan Resume');
    }

    public function create()
    {
        return view('majelis.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'desc' => 'required',
            'resume' => 'required',
            'proof_pic' => [
                'required',
                'file',
                'image',
                'mimes:jpg,jpeg,png',
            ]
        ], [
            'desc.required' => 'Nama Kegiatan Wajib Di Isi',
            'resume.required' => 'Resume Wajib Di Isi',
            'proof_pic.required' => 'Foto Wajib Di Upload',
        ]);

        $data = new PresenceMajelis();
        $data->user_id_presenced = Auth::id();
        $data->desc = $request->desc;
        $data->resume = $request->resume;
        $data->status = 'Hadir';
        $image = Image::read($request->file('proof_pic'));
        $image->coverDown(354, 472);
        $encoded = $image->toPng();
        $namePath = uniqid();
        Storage::disk('public')->put('proof_pic/' . $namePath . '.png', $encoded);
        $data->proof_pic = 'proof_pic/' . $namePath . '.png';
        $data->save();
        if ($data->wasRecentlyCreated) {
            return redirect()->route('kajian.list')->with('success', 'Sukses Menambahkan Kajian Eksternal');
        }
        return redirect()->route('kajian.list')->with('error', 'Gagal Menambahkan Kajian Eksternal');
    }
}
