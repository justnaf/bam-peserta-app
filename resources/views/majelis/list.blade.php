<x-app-layout>
    <x-slot name="header">
        <section class="flex items-center">
            <a href="{{ route('kajian.index') }}" class="text-gray-700 hover:text-gray-900">
                <i class="fas fa-chevron-left"></i>
            </a>
        </section>
        <section class="flex grow justify-center">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Riwayat Kajian') }}
            </h2>
        </section>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-3 ">
            @if($cek == 3)
            @else
            <div class="mt-2 mb-5">
                <a href="{{route('kajian.create')}}" class="p-2 border text-white bg-orange-500 border-orange-500 rounded-lg">Tambah Kajian Eksternal (Maks. 3)</a>
            </div>
            @endif
            <div class="bg-white relative overflow-hidden shadow-sm rounded-lg">
                <div class="p-2 text-gray-900 ">
                    <table class="w-full text-sm text-left text-gray-500 border border-gray-200" x-data="dataTable()">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b">
                            <tr>
                                <th class="px-1 py-2">Kategori</th>
                                <th class="px-1 py-2">Nama Kajian</th>
                                <th class="px-1 py-2">Status</th>
                                <th class="px-1 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <template x-for="item in data" :key="item.id">
                            <tbody>
                                <tr class="border-b" :class="{'bg-orange-400 text-white':!item.resume}">
                                    <td class="p-1">
                                        <template x-if="!item.majelis">
                                            <p>Eksternal</p>
                                        </template>
                                        <template x-if="item.majelis">
                                            <p x-text="item.majelis.category"></p>
                                        </template>
                                    </td>
                                    <td class="p-1">
                                        <template x-if="!item.majelis">
                                            <p x-text="item.desc"></p>
                                        </template>
                                        <template x-if="item.majelis">
                                            <p x-text="item.majelis.name"></p>
                                        </template>
                                    </td>
                                    <td>
                                        <p x-text="item.status"></p>
                                    </td>
                                    <td>
                                        <a :href="item.id+'/edit'">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </template>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('addedScript')
    <script>
        function dataTable() {
            return {
                data: @json($data)
            }
        }

    </script>
    @endpush
</x-app-layout>
