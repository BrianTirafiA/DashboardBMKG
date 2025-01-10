<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>  
  
<div>  
    <div class="relative flex items-center justify-center min-h-screen">  
        <div class="w-[85rem] h-[67rem] lg:h-[48rem] ms-4 me-4 p-7 bg-[#F1F5F9] rounded-xl shadow-md border border-blue-gray-100 border-collapse bg-clip-border">  
            <div class="font-[sans-serif] ">  
                <div class="grid lg:grid-cols-2 rounded-xl gap-4 max-lg:gap-12 bg-gradient-to-r from-blue-500 to-blue-700 sm:px-8 px-4 py-12 h-[380px] lg:h-[360px]">  
  
                    <div class="lg:items-start items-center">  
                        <a href="javascript:void(0)"><img  
                                src="{{ asset('assets/bmkgxugm.svg') }}" alt="logo" class="w-80" />  
                        </a>  
  
                        <div class="max-w-lg ms-2 mb-5 lg:mb-10">  
                            <h3 class="text-2xl font-semibold  text-white mt-7 lg:mt-12 ">ASSET MANAGEMENT SYSTEM</h3>  
                            <h3 class="text-2xl font-semibold  text-white ">DIREKTORAT DATA DAN KOMPUTASI</h3>  
                            <div class="mt-5 ">  
                                <span class="text-white  font-serif fw-light fs-7 md:inline hidden">Made with ❤️ and ☕ by  
                                    <a class="fw-bold enter text-yellow-300 " href="https://jteti.ugm.ac.id/">Mahasiswa Kerja Praktik - DTETI FT UGM</a>  
                                </span>  
                            </div>  
                        </div>  
                    </div>  
  
                    <div class="bg-white rounded-xl 2xl:mt-0 -mt-7 sm:px-6 px-8 py-8 max-w-md w-full border border-blue-gray-100 border-collapse h-max">  
                        <form method="post" action="/register" x-data="{password: '', password_confirmation: '', showModal: false}">  
                            @csrf  
                            <div class="mb-8">    
                                <h3 class="text-3xl font-extrabold text-gray-800">Register Account</h3>    
                            </div>    
                            <div>    
                                <label class="text-gray-800 text-sm mb-2 block">Username</label>    
                                <div class="relative flex items-center">    
                                    <input name="user" id="user" type="text" required class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Masukkan username" />    
                                </div>    
                            </div>    
                          
                            <div class="mt-4">    
                                <label class="text-gray-800 text-sm mb-2 block">Email</label>    
                                <div class="relative flex items-center">    
                                    <input name="email" id="email" type="text" required class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Masukkan email" />    
                                </div>    
                            </div>    
                          
                            <div class="mt-4">    
                                <label class="text-gray-800 text-sm mb-2 block">Password</label>    
                                <div class="relative flex items-center">    
                                    <input type="password" name="password" id="password" x-model="password" required class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Masukkan password" />    
                                </div>    
                            </div>    
                          
                            <div class="mt-4">    
                                <label class="text-gray-800 text-sm mb-2 block">Confirm Password</label>    
                                <div class="relative flex items-center">    
                                    <input type="password" name="password_confirmation" id="password_confirmation" x-model="password_confirmation" required class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Masukkan ulang password" />    
                                </div>    
                            </div>         
  
                            <div class="flex justify-start mt-3 ml-4 p-1">    
                                <ul>    
                                    <li class="flex items-center py-1">    
                                        <div :class="{'bg-green-200 text-green-700': password == password_confirmation && password.length > 0, 'bg-red-200 text-red-700':password != password_confirmation || password.length == 0}"    
                                             class=" rounded-full p-1 fill-current ">    
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">    
                                                <path x-show="password == password_confirmation && password.length > 0" stroke-linecap="round"    
                                                      stroke-linejoin="round" stroke-width="2"    
                                                      d="M5 13l4 4L19 7"/>    
                                                <path x-show="password != password_confirmation || password.length == 0" stroke-linecap="round"    
                                                      stroke-linejoin="round" stroke-width="2"    
                                                      d="M6 18L18 6M6 6l12 12"/>    
                                            </svg>    
                                        </div>    
                                        <span :class="{'text-green-700': password == password_confirmation && password.length > 0, 'text-red-700':password != password_confirmation || password.length == 0}"    
                                              class="font-medium text-sm ml-3"    
                                              x-text="password == password_confirmation && password.length > 0 ? 'Passwords match' : 'Passwords do not match' "></span>    
                                    </li>    
                                    <li class="flex items-center py-1">    
                                        <div :class="{'bg-green-200 text-green-700': password.length > 7, 'bg-red-200 text-red-700':password.length < 7 }"    
                                             class=" rounded-full p-1 fill-current ">    
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">    
                                                <path x-show="password.length > 7" stroke-linecap="round"    
                                                      stroke-linejoin="round" stroke-width="2"    
                                                      d="M5 13l4 4L19 7"/>    
                                                <path x-show="password.length < 7" stroke-linecap="round"    
                                                      stroke-linejoin="round" stroke-width="2"    
                                                      d="M6 18L18 6M6 6l12 12"/>    
                                            </svg>    
                                        </div>    
                                        <span :class="{'text-green-700': password.length > 7, 'text-red-700':password.length < 7 }"    
                                              class="font-medium text-sm ml-3"    
                                              x-text="password.length > 7 ? 'The minimum length is reached' : 'At least 8 characters required' "></span>    
                                    </li>    
                                </ul>    
                            </div>    
                            
                            <div class="mt-3">    
                                <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">    
                                    Register    
                                </button>    
                            </div>    
                            <p class="text-sm mt-6 text-center text-gray-800">Sudah punya akun?     
                                <a href="/login" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Login</a>    
                            </p>    
                        </form>    
                    </div>    
                </div>    
            </div>    
        </div>    
    </div>    
  
    <div class="mt-20">    
        <x-footer/>    
    </div>    
  
    <!-- Modal -->  
    <div id="hs-basic-modal" x-show="showModal" class="hs-overlay fixed top-0 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">  
        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto">  
            <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">  
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">  
                    <h3 id="hs-basic-modal-label" class="font-bold text-gray-800 dark:text-white">  
                        Register Berhasil  
                    </h3>  
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" @click="showModal = false">  
                        <span class="sr-only">Close</span>  
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">  
                            <path d="M18 6 6 18"></path>  
                            <path d="m6 6 12 12"></path>  
                        </svg>  
                    </button>  
                </div>  
                <div class="p-4 overflow-y-auto">  
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">  
                        Hore! Pendaftaran Account-mu berhasil. Tunggu kami menyetujui permohonanmu dalam 1-3 hari kerja  
                    </p>  
                </div>  
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">  
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" @click="showModal = false">  
                        Close  
                    </button>  
                    <a href="/login" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">  
                        Back to Login Dashboard  
                    </a>  
                </div>  
            </div>  
        </div>  
    </div>  
  
    <script>    
        document.getElementById('togglePassword').addEventListener('click', function () {    
            const passwordInput = document.getElementById('password');    
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';    
            passwordInput.setAttribute('type', type);    
        });    
  
        // Menangani pengiriman formulir  
        document.querySelector('form').addEventListener('submit', function(event) {  
            event.preventDefault(); // Mencegah pengiriman formulir default  
  
            // Mengambil data formulir  
            const formData = new FormData(this);  
  
            // Mengirim data ke server  
            fetch(this.action, {  
                method: 'POST',  
                body: formData,  
                headers: {  
                    'X-Requested-With': 'XMLHttpRequest',  
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value  
                }  
            })  
            .then(response => {  
                if (response.ok) {  
                    // Jika pendaftaran berhasil, tampilkan modal  
                    this.reset(); // Reset formulir  
                    this.__x.$data.showModal = true; // Tampilkan modal  
                } else {  
                    // Jika ada kesalahan, tampilkan pesan kesalahan  
                    return response.json().then(data => {  
                        // Tampilkan pesan kesalahan di UI (Anda bisa menambahkan logika untuk menampilkan pesan kesalahan)  
                        alert(data.message || 'Terjadi kesalahan, silakan coba lagi.');  
                    });  
                }  
            })  
            .catch(error => {  
                console.error('Error:', error);  
            });  
        });  
    </script>    
</div>  
