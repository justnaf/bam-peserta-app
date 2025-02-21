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
            <div class="bg-white relative overflow-hidden shadow-sm rounded-lg">
                <div class="p-3 text-gray-900 ">
                    <form action="{{route('kajian.store')}}" method="POST" enctype="multipart/form-data" x-data="submitForm()" x-ref="seForm">
                        @csrf
                        <div x-data="{step:1}">
                            <div x-show="step === 1">
                                <h1 class="font-extrabold text-lg text-center mb-3">Ketentuan Tambah <br> Kajian Eksternal</h1>
                                <ul class="list-disc ps-3">
                                    <li>Pastikan Resume Diawali Dengan Menulis Tanggal dan Lokasi Kajian</li>
                                    <li>Pastikan Ukuran Gambar Yang Akan Di Upload Maks. 2Mb</li>
                                    <li class="text-red-500">Foto Bukti Wajib Bersama Pembicara</li>
                                    <li class="text-red-500">Semua Harus Di Isikan</li>
                                </ul>
                                <button type="button" @click="step = 2" class="bg-green-600 p-2 mt-3 text-white rounded-md">Lanjut</button>
                            </div>
                            <div x-show="step === 2">
                                <h1 class="font-extrabold text-lg text-center mb-3">Lengkapi Data</h1>
                                <div class="w-full px-1">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="desc">
                                        Nama Kajian
                                    </label>
                                    <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Kajian Pagi" type="text" name="desc" id="desc" required />
                                </div>
                                <button type="button" @click="step = 1" class="bg-orange-600 p-2 mt-3 text-white rounded-md">Sebelumnya</button>
                                <button type="button" @click="step = 3" class="bg-green-600 p-2 mt-3 text-white rounded-md">Lanjut</button>
                            </div>
                            <div x-show="step === 3">
                                <h1 class="font-extrabold text-lg text-center mb-3">Lengkapi Data</h1>
                                <div class="w-full px-1">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="resume">
                                        Resume
                                    </label>
                                    <textarea class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md p-2 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Kajian Pagi, 2 Januari 2025 Masjid Al Falah." type="text" name="resume" id="resume" required></textarea>
                                </div>
                                <button type="button" @click="step = 2" class="bg-orange-600 p-2 mt-3 text-white rounded-md">Sebelumnya</button>
                                <button type="button" @click="step = 4" class="bg-green-600 p-2 mt-3 text-white rounded-md">Lanjut</button>
                            </div>
                            <div x-show="step === 4">
                                <h1 class="font-extrabold text-lg text-center mb-3">Lengkapi Data</h1>
                                <div class="w-full mb-6">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="birth_place">
                                        Foto Bukti Wajib Bersama Pembicara
                                    </label>
                                    <p class="font-normal text-sm text-red-500">*Ukurannya maks. 2Mb Yak</p>
                                    <div x-data="UploadProfileHandler()" class="flex items-center justify-center w-full">
                                        <template x-if="!profile">
                                            <label for="dropzone-file-profile" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
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
                                        <input id="dropzone-file-profile" hidden type="file" @change="handleFileUpload" name="proof_pic" accept="image/jpeg, image/jpg, image/png" />
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
                                    <x-input-error :messages="$errors->get('profile_pic')" class="mt-2" />
                                </div>
                                <button type="button" @click="step = 3" class="bg-orange-600 p-2 mt-3 text-white rounded-md">Sebelumnya</button>
                                <button type="button" @click="confirmSimpan" class="bg-green-600 p-2 mt-3 text-white rounded-md">Simpan Data</button>
                            </div>
                        </div>
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
                    const file = event.target.files[0];
                    const maxSize = 2 * 1024 * 1024; // 2 MB size limit

                    if (file) {
                        if (file.size > maxSize) {
                            alert('File Kebesaran Melebihi 2MB, silahkan compress dahulu');
                            this.removeFile(); // Call removeFile to reset input
                        } else {
                            this.profile = file;
                            // Set file pada input hidden
                            const inputElement = document.getElementById('dropzone-file-profile');
                            inputElement.files = event.target.files;
                            console.log("File accepted:", file.name);
                        }
                    }
                }
                , removeFile() {
                    this.profile = null;
                    const inputElement = document.getElementById('dropzone-file-profile');
                    inputElement.value = ''; // Reset file input
                }
            };
        }

        function submitForm() {
            return {
                confirmSimpan() {
                    Swal.fire({
                        title: 'Yakin?'
                        , text: "Sudah Yakin Dengan Data Yang Di Inputkan! Data Tidak Dapat Di Ubah Dan Di Hapus"
                        , icon: 'warning'
                        , showCancelButton: true
                        , confirmButtonColor: '#d33'
                        , cancelButtonColor: '#3085d6'
                        , confirmButtonText: 'Yes'
                        , cancelButtonText: 'Cancel'
                    , }).then((result) => {
                        if (result.isConfirmed) {
                            // Explicitly reference the form element and submit it
                            this.$refs.seForm.submit();
                        }
                    });
                }
            , };
        }

    </script>
    @endpush
</x-app-layout>
