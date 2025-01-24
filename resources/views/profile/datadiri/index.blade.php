<x-app-layout>
    <x-slot name="header">
        <section class="flex items-center">
            <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-gray-900">
                <i class="fas fa-chevron-left"></i>
            </a>
        </section>
        <section class="flex grow justify-center">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Data Diri') }}
            </h2>
        </section>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col items-center space-y-2 mt-4">
                <img src="{{ asset('storage/' . Auth::user()->dataDiri->profile_picture) }}" alt="{{ Auth::user()->dataDiri->name}}" class="w-24 h-32 rounded-full mb-4 shadow-lg">
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative mb-4">
                <a href="#" class="absolute top-0 right-0 p-2 text-emerald-500 hover:text-gray-700"><span>Atur </span><i class="fas fa-cogs"></i></a>
                <div class="p-6 text-gray-900">
                    <table>
                        <tr>
                            <td class="pe-2">Nama</td>
                            <td>:</td>
                            <td class="ps-2">{{Auth::user()->dataDiri->name}}</td>
                        </tr>
                        <tr>
                            <td class="pe-2">Alamat</td>
                            <td>:</td>
                            <td class="ps-2">{{Auth::user()->dataDiri->address}}</td>
                        </tr>
                        <tr>
                            <td class="pe-2">Jenis Kelamin</td>
                            <td>:</td>
                            <td class="ps-2">{{Auth::user()->dataDiri->gender}}</td>
                        </tr>
                        <tr>
                            <td class="pe-2">Tanggal Lahir</td>
                            <td>:</td>
                            <td class="ps-2">{{Auth::user()->dataDiri->birth_date}}</td>
                        </tr>
                        <tr>
                            <td class="pe-2">Tempat Lahir</td>
                            <td>:</td>
                            <td class="ps-2">{{Auth::user()->dataDiri->birth_place}}</td>
                        </tr>
                        <tr>
                            <td class="pe-2">No. Telp</td>
                            <td>:</td>
                            <td class="ps-2">{{Auth::user()->dataDiri->phone_number}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="p-3 text-gray-900">
                    <h1 class="text-center font-bol mb-3">Ganti Foto Profile</h1>
                    <form action="{{route('profile.ganti.pic')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div x-data="UploadProfileHandler()" class="flex items-center justify-center w-full">
                            <template x-if="!profile">
                                <label for="dropzone-file-profile" class="flex flex-col items-center justify-center w-full h-30 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Click to upload</span> or drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">JPG or JPEG (MAX. 5000x5000px)</p>
                                    </div>
                                </label>
                            </template>
                            <input id="dropzone-file-profile" hidden type="file" @change="handleFileUpload" name="profile" accept="image/jpeg, image/jpg, image/png" required />
                            <!-- Preview Section -->
                            <template x-if="profile">
                                <div class="mt-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Selected file:</p>
                                    <p class="text-gray-800 dark:text-white font-semibold" x-text="profile.name"></p>
                                    <button @click="removeFile" class="mt-2 text-red-500 hover:text-white border border-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2">
                                        Remove File
                                    </button>
                                </div>
                            </template>
                        </div>
                        <button type="submit" class=" bg-emerald-500 p-2 rounded-md text-white font-bold mt-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('addedScript')
    <script>
        function UploadProfileHandler() {
            return {
                profile: null
                , handleFileUpload(event) {
                    this.profile = event.target.files[0];
                    // Set file pada input hidden
                    const inputElement = document.getElementById('dropzone-file-profile');
                    inputElement.files = event.target.files;
                }
                , removeFile() {
                    this.profile = null;
                    const inputElement = document.getElementById('dropzone-file-profile');
                    inputElement.value = ''; // Reset file input
                }
            };
        }

    </script>
    @endpush
</x-app-layout>
