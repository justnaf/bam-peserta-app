<x-app-layout>
    <x-slot name="header">
        <section class="flex items-center">
            <a href="{{ route('datadiri.index') }}" class="text-gray-700 hover:text-gray-900">
                <i class="fas fa-chevron-left"></i>
            </a>
        </section>
        <section class="flex grow justify-center">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Data Diri') }}
            </h2>
        </section>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-2">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <div class="py-8 px-2 text-gray-900">
                    <h1 class="text-center font-bold text-lg mb-3">Form Edit Data Diri</h1>
                    <div class="relative overflow-x-auto">
                        <form action="{{route('achievement.update',$achievement->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="w-full px-1 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-sm text-center font-bold mb-2" for="name">
                                    Prestasi
                                </label>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Juara 1 Design UI UX" type="text" name="name" id="name" value="{{$achievement->name}}" required />
                            </div>
                            <div class="w-full px-1 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-sm text-center font-bold mb-2" for="achieve_year">
                                    Tahun
                                </label>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="2023" type="text" name="achieve_year" id="achieve_year" value="{{$achievement->achieve_year}}" required />
                            </div>
                            <div class="w-full flex justify-center mb-2">
                                <button type="submit" class="focus:outline-none text-white bg-emerald-500 hover:bg-emerald-600 focus:ring-4 focus:ring-green-300 rounded-lg text-sm px-5 py-2.5 me-2 mb-2 "><span class="font-extrabold">Simpan</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
