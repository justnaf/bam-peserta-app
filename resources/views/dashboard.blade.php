<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
