<x-app-layout>
    <x-slot name="header">
        <section class="flex items-center">
            <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-gray-900">
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
                <a href="{{route('eduhistory.create')}}" class="absolute top-0 left-0 px-2 py-1 rounded-br-md text-white hover:text-emerald-500 bg-blue-500"><span>Tambah Data</span><i class="fas fa-cogs"></i></a>
                <div class="py-8 px-2 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-gray-500 text-center mt-2">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200 ">
                                <tr>
                                    <th scope="col" class="px-2 py-1">
                                        Jenjang
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Nama Sekolah
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Tahun Lulus
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($eduHist) > 0)

                                @foreach ($eduHist as $item)
                                <tr class="bg-white border-b border-gray-200">
                                    <td class="px-1 py-1 ">
                                        {{$item->stage}}
                                    </td>
                                    <td class="px-2 py-2">
                                        {{$item->name}}
                                    </td>
                                    <td class="px-2 py-2">
                                        {{$item->graduate_year}}
                                    </td>
                                    <td class="px-2 py-2">
                                        <a href="{{route('eduhistory.edit',['eduhistory' => $item->id])}}" class="hover:text-emerald-500">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <form action="{{route('eduhistory.destroy',['eduhistory' => $item->id])}}" method="POST" class="hover:text-red-500">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">No Data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
