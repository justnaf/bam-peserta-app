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
                        <tr class="mb-3">
                            <td><i class="fas fa-building"></i></td>
                            <td class="ps-3">{{$activeEvent->event->institution}}</td>
                        </tr>
                        <tr class="mb-3">
                            <td><i class="fas fa-envelope-open-text"></i></td>
                            <td class="ps-3"><a href="{{'mailto:'.$activeEvent->event->email}}">{{$activeEvent->event->email}}<sup><i class="fas fa-external-link-alt ps-2"></i></sup></a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <div class="py-6 px-8 text-gray-900">
                    <h1 class="text-center font-bold text-lg mb-3">Jadwal Kegiatan</h1>
                    <div x-data="sessionDropdown()" x-init="init()">
                        <!-- Loop through grouped sessions -->
                        <template x-for="(sessions, day) in groupedSessions" :key="day">
                            <div>
                                <div class="font-bold text-lg bg-emerald-500 px-3 text-white" @click="toggleDetails(day, null)">
                                    <span x-text="day"></span>
                                </div>

                                <!-- Loop through sessions for each day -->
                                <template x-for="session in sessions" :key="session.id">
                                    <div class="bg-gray-300">
                                        <div @click="toggleDetails(day, session.time)" class="cursor-pointer flex items-center space-x-2 pl-2">
                                            <span x-text="session.time"></span>
                                            <span x-text="session.name"></span>   
                                            <!-- Chevron icon that toggles -->
                                            <svg  xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform transition-transform duration-200" :class="{'rotate-180': selectedSession === session}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>

                                        <div x-show="selectedDay === day && selectedTime === session.time" class="pl-4 bg-blue-300">
                                            <div class="space-y-2 ">
                                                <p>
                                                    <strong>File Materi :</strong> 
                                                    <template x-if="session.materi_path">
                                                        <a :href="`{{ asset('storage/') }}/${session.materi_path}`" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-3 rounded inline-flex items-center" download>
                                                            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                                            </svg>
                                                        </a>
                                                    </template>
                                                    <template x-if="!session.materi_path">
                                                        <span>No File</span>
                                                    </template>
                                                </p>
                                                <p>
                                                    <strong>File CV :</strong> 
                                                    <template x-if="session.cv_path">
                                                        <a :href="`{{ asset('storage/') }}/${session.materi_path}`" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-3 rounded inline-flex items-center" download>
                                                            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                                            </svg>
                                                        </a>
                                                    </template>
                                                    <template x-if="!session.cv_path">
                                                        <span>No File</span>
                                                    </template>
                                                </p>
                                                <p><strong>Narasumber:</strong> <span x-text="session.speaker"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            @else
            @forelse ($event as $item)
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <a class="absolute top-0 left-0 px-2 py-1 rounded-br-md text-white bg-blue-500 "><span>{{$item->name}} </span> <i class="fas fa-book-open"></i></a>
                <div class="py-10 px-8 text-gray-900">
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
                    </table>
                    <a href="{{route('join.event',$item->id)}}" class="bg-emerald-500 text-white py-2 px-5 rounded-md hover:bg-blue-500">Join</a>
                </div>
            </div>
            @empty
            <div class="bg-white overflow-hidden shadow-sm rounded-lg relative mb-4">
                <div class="py-10 px-8 text-gray-900 text-center">
                    <p>Tidak Ada Event Yang Open Registrasi</p>
                </div>
            </div>
            @endforelse
            @endif
        </div>
    </div>
    @push('addedScript')
    @if($activeEvent)
    <script>
        function sessionDropdown() {
            return {
                sessions: @json($activeEvent->event->sesi)
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
