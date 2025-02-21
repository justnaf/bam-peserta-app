<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Kajian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-3 ">
            <div class="mt-2 mb-5">
                <a href="{{route('kajian.list')}}" class="p-2 border text-white bg-green-500 border-green-500 rounded-lg">Lihat Riwayat Kajian</a>
            </div>
            @foreach ($kajian as $item)
            <div class="bg-white relative overflow-hidden shadow-sm rounded-lg">
                <p class="absolute top-0 left-0 px-2 py-1 rounded-br-md text-white bg-blue-500 "><span>{{ucfirst($item->status)}}</span> <i class="fas fa-book-open"></i></p>
                <div class="p-6 text-gray-900">
                    <h1 class="font-extrabold mt-3">{{$item->name}}</h1>
                    <div class="grid grid-cols-1 gap-1 mt-2">
                        <div class="flex gap-x-1 items-center">
                            <i class="fas fa-map-pin w-2"></i>
                            <p class="ps-3" href="{{$item->loc_link}}">{{$item->loc_name}}<sup><i class="fas fa-external-link-alt ps-2"></i></sup></p>
                        </div>
                        <div class="flex gap-x-1 items-center">
                            <i class="fas fa-calendar-check w-2"></i>
                            <div>
                                <p class="ps-3 ">Pukul : {{\Carbon\Carbon::parse($item->start_date)->locale('id')->translatedFormat('H:i')}}</p>
                                <p class="ps-3">{{\Carbon\Carbon::parse($item->start_date)->locale('id')->translatedFormat('l, d F Y')}}</p>
                            </div>
                        </div>
                        <div class="flex gap-x-1 items-center">
                            <i class="fas fa-calendar-times w-2"></i>
                            <p class="ps-3">{{$item->end_date}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
