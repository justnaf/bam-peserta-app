<x-app-layout>
    <x-slot name="header">
        <section class="flex grow justify-start">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Kegiatan') }}
            </h2>
        </section>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-2">
            @if($activeEvent)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <a class="absolute top-0 left-0 px-2 py-1 rounded-br-md text-white bg-emerald-500 "><span>Kegiatan Mu Sekarang </span> <i class="fas fa-book-open"></i></a>
                <div class="py-10 px-8 text-gray-900">
                    <table class="text-md">
                        <tr>
                            <td colspan="2" class="text-md font-extrabold">Detail Kegiatan:</td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-map-pin"></i></td>
                            <td class="ps-3"><a href="{{$activeEvent->event->location_url}}">{{$activeEvent->event->location}}<sup><i class="fas fa-external-link-alt ps-2"></i></sup></a></td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td class="ps-3">{{$activeEvent->event->start_date}}</td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-calendar-times"></i></td>
                            <td class="ps-3">{{$activeEvent->event->end_date}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-md pt-2 font-extrabold">Informasi Lebih Lanjut Hubungi :</td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-building"></i></td>
                            <td class="ps-3">{{$activeEvent->event->institution}}</td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-envelope-open-text"></i></td>
                            <td class="ps-3"><a href="{{'mailto:'.$activeEvent->event->email}}">{{$activeEvent->event->email}}<sup><i class="fas fa-external-link-alt ps-2"></i></sup></a></td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-envelope-open-text"></i></td>
                            <td class="ps-3"><a href="http://wa.me/628973007222">WA LP2SI<sup><i class="fas fa-external-link-alt ps-2"></i></sup></a></td>
                        </tr>
                    </table>

                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <a class="absolute top-0 left-0 px-2 py-1 rounded-br-md text-white bg-emerald-500 "><span>Ruang Istirahat Mu </span> <i class="fas fa-building"></i></a>
                <div class="py-10 px-8 text-gray-900">
                    <div x-data="{ hasRoom: @json(!empty($roomEvent->restRoom->name)) }">
                        <template x-if="!hasRoom">
                            <p class="text-center">Belum Dapat Pembagian Ruang</p>
                        </template>
                        <template x-if="hasRoom">
                            <p x-text="hasRoom"></p>
                        </template>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <div class="py-6 px-3 text-gray-900">
                    <h1 class="text-center font-bold text-lg mb-3">Jadwal Kegiatan</h1>
                    <div x-data="sessionDropdown()" x-init="init()">
                        <!-- Loop through grouped sessions -->

                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-1 py-2">Waktu</th>
                                    <th class="px-1 py-2">Nama Sesi</th>
                                    <th class="px-1 py-2">File Materi</th>
                                    <th class="px-1 py-2">File CV</th>
                                    <th class="px-1 py-2">Narasumber</th>
                                </tr>
                            </thead>
                            <template x-for="(sessions, day) in groupedSessions" :key="day">
                                <tbody>
                                    <tr>
                                        <th colspan="5" class="bg-emerald-500 text-white text-left px-3 py-2 cursor-pointer" @click="toggleDetails(day, null)">
                                            <span x-text="day"></span>
                                        </th>
                                    </tr>
                                    <template x-for="session in sessions" :key="session.id">
                                        <tr class="border-t border-gray-300 bg-gray-100 hover:bg-gray-200 cursor-pointer" @click="toggleDetails(day, session.time)">
                                            <td class="px-1 py-2" x-text="session.time"></td>
                                            <td class="px-1 py-2" x-text="session.name"></td>
                                            <td class="px-1 py-2 text-center">
                                                <template x-if="session.materi_path">
                                                    <a :href="`{{ asset('storage/') }}/${session.materi_path}`" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-3 rounded inline-flex items-center" download>
                                                        <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                                        </svg>
                                                    </a>
                                                </template>
                                                <template x-if="!session.materi_path">
                                                    <span>No File</span>
                                                </template>
                                            </td>
                                            <td class="px-1 py-2 text-center">
                                                <template x-if="session.cv_path">
                                                    <a :href="`{{ asset('storage/') }}/${session.cv_path}`" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-3 rounded inline-flex items-center" download>
                                                        <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                                        </svg>
                                                    </a>
                                                </template>
                                                <template x-if="!session.cv_path">
                                                    <span>No File</span>
                                                </template>
                                            </td>
                                            <td class="px-1 py-2" x-text="session.speaker"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </template>
                        </table>
                    </div>
                </div>
            </div>
            @else
            @forelse ($event as $item)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <a class="absolute top-0 left-0 px-2 py-1 rounded-br-md text-white bg-blue-500 "><span>Upcoming : </span><span>{{$item->name}}</span> <i class="fas fa-book-open"></i></a>
                <div class="py-10 px-8 text-gray-900" x-data="swalJoin()">
                    <table class="text-md mb-5">
                        <tr>
                            <td colspan="2" class="text-md font-extrabold">Detail Kegiatan:</td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-map-pin"></i></td>
                            <td class="ps-3"><a href="{{$item->location_url}}">{{$item->location}}<sup><i class="fas fa-external-link-alt ps-2"></i></sup></a></td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-calendar-check"></i></td>
                            <td class="ps-3">{{$item->start_date}}</td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-calendar-times"></i></td>
                            <td class="ps-3">{{$item->end_date}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-md pt-2 font-extrabold">Informasi Lebih Lanjut Hubungi :</td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-building"></i></td>
                            <td class="ps-3">{{$item->institution}}</td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-envelope-open-text"></i></td>
                            <td class="ps-3"><a href="{{'mailto:'.$item->email}}">{{$item->email}}<sup><i class="fas fa-external-link-alt ps-2"></i></sup></a></td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-envelope-open-text"></i></td>
                            <td class="ps-3"><a href="http://wa.me/628973007222">WA LP2SI<sup><i class="fas fa-external-link-alt ps-2"></i></sup></a></td>
                        </tr>
                    </table>
                    <a href="#" @click="confirmJoin('{{ route('join.event', $item->id) }}','{{$item->name}}')" class="bg-emerald-500 text-white py-2 px-5 rounded-md hover:bg-blue-500">
                        Join
                    </a>

                </div>
            </div>
            @empty
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <div class="py-10 px-8 text-gray-900 text-center" ">
                    <p>Tidak Ada Event Yang Open Registrasi</p>
                </div>
            </div>
            @endforelse
            @endif
        </div>
    </div>
    @push('addedScript')
    <script>
        function swalJoin() {
            return {
                confirmJoin(url,name) {
                    Swal.fire({
                        title: 'Pastikan Kembali!'
                        , html: `Apakah Yakin Bergabung di <span class=" font-extrabold text-emerald-500">${name}</span>?`
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#3085d6'
                    , cancelButtonColor: '#d33'
                    , confirmButtonText: 'Ya, Bergabung!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                    window.location.href = url;
                    }
                    });
                    }
                    }
                    }

                    </script>
                    @if($activeEvent)
                    <script>
                        function sessionDropdown() {
                            return {
                                sessions: @json($sesi)
                                , groupedSessions: {}
                                , selectedDay: null
                                , selectedTime: null
                                , selectedSession: null,

                                init() {
                                    this.groupSessionsByDay();
                                },

                                groupSessionsByDay() {
                                    this.groupedSessions = this.sessions.reduce((groups, session) => {
                                        const [day, time] = session.time.split(',');
                                        const dayTrimmed = day.trim();
                                        const timeTrimmed = time ? time.trim() : 'Unknown Time';

                                        if (!groups[dayTrimmed]) {
                                            groups[dayTrimmed] = [];
                                        }

                                        groups[dayTrimmed].push({
                                            ...session
                                            , time: timeTrimmed
                                        });
                                        return groups;
                                    }, {});
                                },

                                toggleDetails(day, time) {
                                    // Check if the same day and time is clicked again
                                    if (this.selectedDay === day && this.selectedTime === time) {
                                        // If clicked again, toggle the visibility of the session
                                        this.selectedSession = null;
                                        this.selectedDay = null;
                                        this.selectedTime = null;
                                    } else {
                                        // Set the selected day and time to show the session details
                                        this.selectedDay = day;
                                        this.selectedTime = time;
                                        this.selectedSession = this.groupedSessions[day].find(session => session.time === time);
                                    }
                                }
                            }
                        }

                    </script>
                    @endif
                    @endpush
</x-app-layout>
