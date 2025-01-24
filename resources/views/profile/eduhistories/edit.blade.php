<x-app-layout>
    <x-slot name="header">
        <section class="flex items-center">
            <a href="{{ route('eduhistory.index') }}" class="text-gray-700 hover:text-gray-900">
                <i class="fas fa-chevron-left"></i>
            </a>
        </section>
        <section class="flex grow justify-center">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Riwayat Pendidikan') }}
            </h2>
        </section>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-2">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <div class="py-8 px-2 text-gray-900">
                    <h1 class="text-center font-bold text-lg mb-3">Edit Form Riwayat Pendidikan</h1>
                    <div class="relative overflow-x-auto">
                        <form action="{{route('eduhistory.update',$eduhistory->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="w-full px-1 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-sm text-center font-bold mb-2" for="stage">
                                    Jenjang
                                </label>
                                <select class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" id="stage" name="stage" required>
                                    <option value="" disabled {{ is_null($eduhistory->stage) ? 'selected' : '' }}>Pilih Jenjang</option>
                                    <option value="Strata 1" {{ $eduhistory->stage === 'Strata 1' ? 'selected' : '' }}>Strata 1</option>
                                    <option value="Diploma 4" {{ $eduhistory->stage === 'Diploma 4' ? 'selected' : '' }}>Diploma 4</option>
                                    <option value="Diploma 3" {{ $eduhistory->stage === 'Diploma 3' ? 'selected' : '' }}>Diploma 3</option>
                                    <option value="SMA/Sederajat" {{ $eduhistory->stage === 'SMA/Sederajat' ? 'selected' : '' }}>SMA/Sederajat</option>
                                    <option value="SMP/Sederajat" {{ $eduhistory->stage === 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                                    <option value="SD/Sederajat" {{ $eduhistory->stage === 'SD/Sederajat' ? 'selected' : '' }}>SD/Sederajat</option>
                                </select>

                            </div>
                            <div class="w-full px-1 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-sm text-center font-bold mb-2" for="name">
                                    Nama Sekolah
                                </label>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="SMA Mutual" type="text" name="name" id="name" value="{{$eduhistory->name}}" required />
                            </div>
                            <div class="w-full px-1 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-sm text-center font-bold mb-2" for="graduate_year">
                                    Tahun Lulus
                                </label>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="2019" type="text" name="graduate_year" id="graduate_year" value="{{$eduhistory->graduate_year}}" required />
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
