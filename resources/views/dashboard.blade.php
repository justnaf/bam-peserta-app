<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-3 lg:px-8">
            @if(!$cek)
            @else
            <div class="bg-orange-300 border border-orange-500 p-3 rounded-md mb-3">
                <p>Kamu Memiliki <span class="font-extrabold">{{$cek}}</span> Resume Kajian Belum Terisi <a href="{{route('kajian.list')}}" class="underline">Lenkapi Disini</a></p>
            </div>
            @endif
            <div class="bg-orange-300 border-orange-500 border-2 rounded-md shadow-sm mb-2">
                <div class="p-6 text-gray-600 text-center">
                    <p>KAJIAN SEDANG DALAM PROSES TESTING FITUR</p>
                    <p class="font-extrabold">DATA PRESENSI KAJIAN SAAT INI, BERKEMUNGKINAN AKAN HILANG.</p>
                    <p>Periode Testing : 1 Maret - 31 Maret 2025</p>
                </div>
            </div>
            <div class="bg-green-300 border-green-500 border-2 rounded-md shadow-sm mb-2">
                <div class="p-6 text-gray-600 text-center">
                    <p class="font-extrabold">KHUSUS KAJIAN JUM'AT 14 MARET 2025</p>
                    <p>Kajian Bersama Prof. Dr. Abdul Mu'ti, M. Ed</p>
                    <p>DATA PRESENSI TIDAK AKAN DI HAPUS</p>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center flex flex-col items-center">
                        <p class="mb-3 dark:bg-white dark:text-black">
                            {!! QrCode::size(256)->generate(Auth::user()->code) !!}
                        </p>
                        <h1>{{Auth::user()->dataDiri->name}}</h1>
                        <h1>{{Auth::user()->username}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
