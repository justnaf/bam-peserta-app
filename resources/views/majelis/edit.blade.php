<x-app-layout>
    <x-slot name="header">
        <section class="flex items-center">
            <a href="{{ route('kajian.list') }}" class="text-gray-700 hover:text-gray-900">
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
            <div class="bg-white relative overflow-hidden shadow-sm rounded-lg">
                <div class="p-2 text-gray-900 ">
                    <div class="flex flex-col py-3">
                        <div class="w-full px-1 mb-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="name">
                                Nama Kajian
                            </label>
                            @if(!$data->majelis)
                            <input value="{{$data->desc}}" class="placeholder:italic placeholder:text-slate-400 block bg-gray-300 w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="BAM" type="text" name="name" id="name" disabled required />
                            @else
                            <input value="{{$data->majelis->name}}" class="placeholder:italic placeholder:text-slate-400 block bg-gray-300 w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="BAM" type="text" name="name" id="name" disabled required />
                            @endif
                        </div>
                        <div class="w-full px-1 mb-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="name">
                                Status Kehadiran
                            </label>
                            <input value="{{$data->status}}" class="placeholder:italic placeholder:text-slate-400 block bg-gray-300 w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="BAM" type="text" name="name" id="name" disabled required />
                        </div>
                        @if(!$data->resume)
                        <form method="POST" action="{{route('kajian.update',['kajianId'=>$data->id])}}" x-data='eventsForm' x-ref='eForm'>
                            @csrf
                            @method('PATCH')
                            <div class="w-full px-1 mb-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="resume">
                                    Resume
                                </label>
                                <textarea class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="BAM" type="text" name="resume" id="resume" required></textarea>
                            </div>
                            <div class="px-1">
                                <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" @click="confirmSimpan"><span class="font-extrabold">Update</span></button>
                            </div>
                        </form>
                        @else
                        <div class="w-full px-1">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="resume">
                                Resume
                            </label>
                            <textarea x-data x-init="$el.style.height = $el.scrollHeight + 'px'" @input="$el.style.height = 'auto'; $el.style.height = $el.scrollHeight + 'px'" class="resize-none h-auto placeholder:italic placeholder:text-slate-400 block bg-gray-300 w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="BAM" type="text" name="resume" id="resume" disabled>{{$data->resume}}</textarea>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('addedScript')
    <script>
        function eventsForm() {
            return {
                confirmSimpan() {
                    Swal.fire({
                        title: 'Yakin?'
                        , text: "Sudah Yakin Dengan Data Yang Di Inputkan! Resume Tidak Dapat Di Edit"
                        , icon: 'warning'
                        , showCancelButton: true
                        , confirmButtonColor: '#d33'
                        , cancelButtonColor: '#3085d6'
                        , confirmButtonText: 'Yes'
                        , cancelButtonText: 'Cancel'
                    , }).then((result) => {
                        if (result.isConfirmed) {
                            // Explicitly reference the form element and submit it
                            this.$refs.eForm.submit();
                        }
                    });
                }
            , };
        }

    </script>
    @endpush
</x-app-layout>
