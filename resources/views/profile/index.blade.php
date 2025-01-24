<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col items-center space-y-2 mt-4">
                <img src="{{ asset('storage/' . $dataDiri->profile_picture) }}" alt="{{ $dataDiri->name}}" class="w-24 h-32 rounded-full mb-4 shadow-lg">
            </div>
            <h1 class="px-1 mb-2 font-bold">Informasi Pribadi</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="px-3 py-3 text-gray-900">
                    <ul class="space-y-3">
                        <li class="border-b-2 py-2 hover:text-emerald-500">
                            <a href="{{route('datadiri.index')}}" class="flex items-center space-x-4"><i class="fas fa-user"></i> <span>Data Diri</span></a>
                        </li>
                        <li class="border-b-2 py-2 hover:text-emerald-500">
                            <a href="" class="flex items-center space-x-4"><i class="fas fa-university"></i><span>Riwayat Pendidikan</span></a>
                        </li>
                        <li class="border-b-2 py-2 hover:text-emerald-500">
                            <a href="" class="flex items-center space-x-4"><i class="fas fa-sitemap"></i><span>Riwayat Organisasi</span></a>
                        </li>
                        <li class="border-b-2 py-2 hover:text-emerald-500">
                            <a href="" class="flex items-center space-x-4"><i class="fas fa-book"></i></i><span>Minat Baca</span></a>
                        </li>
                        <li class="py-2 hover:text-emerald-500">
                            <a href="" class="flex items-center space-x-4"><i class="fas fa-trophy"></i></i><span>Prestasi</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <h1 class="px-1 mb-2 font-bold">Keamanan</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-3 py-3 text-gray-900">
                    <ul class="space-y-3">
                        <li class="border-b-2 py-2 hover:text-emerald-500">
                            <a href="{{route('profile.ganti.pass')}}" class="flex items-center space-x-4"><i class="fas fa-user"></i> <span>Ganti Kata Sandi</span></a>
                        </li>
                        <li class=" py-2 hover:text-emerald-500">
                            <a href="{{route('profile.ganti.email')}}" class="flex items-center space-x-4"><i class="fas fa-university"></i><span>Ganti Email</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
