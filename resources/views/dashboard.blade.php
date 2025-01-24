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
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    @push('addedScript')
    <script>
        function alerta(massage, icon = 'success') {
            Swal.fire({
                title: icon === 'success' ? 'Success!' : 'Error!'
                , [icon === 'error' ? 'html' : 'text']: massage
                , icon: icon
            , });

        }

    </script>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            alerta('{{ session('success') }}', 'success');
        });

    </script>
    @endif
    @endpush
</x-app-layout>
