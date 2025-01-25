<x-app-layout>
    <x-slot name="header">
        <section class="flex items-center">
            <a href="{{ route('readInterest.index') }}" class="text-gray-700 hover:text-gray-900">
                <i class="fas fa-chevron-left"></i>
            </a>
        </section>
        <section class="flex grow justify-center">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Minat Baca') }}
            </h2>
        </section>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-2">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <div class="py-8 px-2 text-gray-900">
                    <h1 class="text-center font-bold text-lg mb-3">Form Minat Baca</h1>
                    <div class="relative overflow-x-auto">
                        <form action="{{route('readInterest.store')}}" method="POST">
                            @csrf
                            <div class="w-full px-1 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-sm text-center font-bold mb-2" for="type">
                                    Jenis Buku
                                </label>
                                <select class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" id="type" name="type" required>
                                    <option selected>Pilih Jenis Buku</option>
                                    <option value="antologi">Antologi</option>
                                    <option value="biografi">Biografi</option>
                                    <option value="dongeng">Dongeng</option>
                                    <option value="ensiklopedi">Ensiklopedi</option>
                                    <option value="jurnal">Jurnal/Karya Tulis Ilmiah</option>
                                    <option value="komik">Komik</option>
                                    <option value="agama">Keagamaan</option>
                                    <option value="novel">Novel</option>
                                    <option value="sejarah">Sejarah</option>
                                    <option value="lain-lain">Lain-lain</option>
                                </select>
                            </div>
                            <div class="w-full px-1 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-sm text-center font-bold mb-2" for="name">
                                    Judul Buku
                                </label>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Madilog" type="text" name="name" id="name" required />
                            </div>
                            <div class="w-full px-1 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-sm text-center font-bold mb-2" for="achieve_year">
                                    Penulis
                                </label>
                                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Tan Malaka" type="text" name="authors" id="authors" required />
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
