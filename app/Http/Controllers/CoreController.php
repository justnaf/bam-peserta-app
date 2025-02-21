<?php

namespace App\Http\Controllers;

use App\Models\DataDiri;
use App\Models\Event;
use App\Models\ModelActiveEvent;
use App\Models\PresenceMajelis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class CoreController extends Controller
{
    public function index()
    {
        $dataDiri = DataDiri::where("user_id", Auth::user()->id)->first();
        $cek = PresenceMajelis::where('user_id_presenced', Auth::id())->where('resume', null)->count();

        if (!$dataDiri) {
            return redirect()->route('profile.completation');
        }
        return view("dashboard", compact(['dataDiri', 'cek']));
    }

    public function profileInfo()
    {
        $dataDiri = DataDiri::where("user_id", Auth::user()->id)->first();

        if (!$dataDiri) {
            return redirect()->route('profile.completation');
        }
        return view('profile.index', compact('dataDiri'));
    }



    public function profile()
    {
        $dataDiri = DataDiri::where("user_id", Auth::user()->id)->first();

        if (!$dataDiri) {
            return view('profile.complete');
        }

        return redirect()->route('profile.completation');
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'phone_number' => 'required|numeric',
                'birth_date' => 'required',
                'birth_place' => 'required',
                'profile' => [
                    'required',
                    'file',
                    'image',
                    'mimes:jpg,jpeg,png',
                    'max:2048'
                ],
            ], [
                'name.required' => 'Nama wajib diisi.',
                'address.required' => 'Alamat wajib diisi.',
                'gender.required' => 'Jenis kelamin wajib dipilih.',
                'phone_number.required' => 'Nomor telepon wajib diisi.',
                'phone_number.numeric' => 'Nomor telepon harus berupa angka.',
                'birth_date.required' => 'Tanggal lahir wajib diisi.',
                'birth_place.required' => 'Tempat lahir wajib diisi.',
                'profile.required' => 'Profil gambar wajib diunggah.',
                'profile.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
                'profile.max' => 'Gambar Gedenya Banget Bos',
            ]);

            $dataDiri = DataDiri::where("user_id", Auth::user()->id)->first();
            if (!$dataDiri) {
                $dataDiri = new DataDiri();
                $dataDiri->user_id = Auth::user()->id;
                $dataDiri->name = $request->name;
                $dataDiri->address = $request->address;
                $dataDiri->gender = $request->gender;
                $dataDiri->phone_number = $request->phone_number;
                $dataDiri->birth_date = $request->birth_date;
                $dataDiri->birth_place = $request->birth_place;
                $image = Image::read($request->file('profile'));
                $image->coverDown(354, 472);
                $encoded = $image->toPng();
                $namePath = uniqid();
                Storage::disk('public')->put('profile_pic/' . $namePath . '.png', $encoded);
                $dataDiri->profile_picture = 'profile_pic/' . $namePath . '.png';
                $dataDiri->save();

                if ($dataDiri->wasRecentlyCreated) {
                    return redirect()->route('dashboard')->with('success', 'Profile created successfully.');
                } else {
                    return redirect()->route('profile.completation')->with('error', 'Failed to create profile.');
                }
            }
        } catch (ValidationException $e) {
            // Tangkap error validasi dan kirim ke view
            return redirect()->route('profile.completation')
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function storeProfilePic(Request $request)
    {
        try {
            $request->validate([
                'profile' => [
                    'required',
                    'file',
                    'image',
                    'mimes:jpg,jpeg,png',
                    'max:2048'
                ],
            ], [
                'profile.required' => 'Profil gambar wajib diunggah.',
                'profile.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
                'profile.max' => 'Gambar Gedenya Banget Bos',
            ]);

            $dataDiri = DataDiri::where("user_id", Auth::user()->id)->first();
            if (!$dataDiri) {
                return redirect()->route('dataDiri.index')->with('error', 'User Tidak Ditemukan');
            }

            if (Storage::disk('public')->delete($dataDiri->profile_picture)) {
                $image = Image::read($request->file('profile'));
                $image->coverDown(354, 472);
                $encoded = $image->toPng();
                $namePath = uniqid();
                Storage::disk('public')->put('profile_pic/' . $namePath . '.png', $encoded);
                $dataDiri->profile_picture = 'profile_pic/' . $namePath . '.png';
                if ($dataDiri->save()) {
                    return redirect()->route('dataDiri.index')->with('success', 'Sukses Updat Foto Profile.');
                } else {
                    return redirect()->route('dataDiri.index')->with('warning', 'Gagal Update Foto Profile.');
                }
            }
        } catch (ValidationException $e) {
            // Tangkap error validasi dan kirim ke view
            return redirect()->route('dataDiri.index')
                ->withErrors($e->validator)
                ->withInput();
        }
    }


    public function gantiEmail(Request $request)
    {
        return view('profile.security.emailchange', [
            'user' => $request->user(),
        ]);
    }

    public function gantiPwd(Request $request)
    {
        return view('profile.security.passowrdchange', [
            'user' => $request->user(),
        ]);
    }

    public function joinEvent(Event $event)
    {
        $data = new ModelActiveEvent();
        $data->user_id = Auth::id();
        $data->event_id = $event->id;
        $data->isJoin = 1;
        $data->status = 'Peserta';
        $data->save();
        if ($data->wasRecentlyCreated) {
            return redirect()->route('events.index')->with('success', 'Sukses Join Kegiatan.');
        } else {
            return redirect()->route('events.index')->with('warning', 'Gagal Join Kegiatan');
        }
    }
}
