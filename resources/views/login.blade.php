<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center bg-cover items-center justify-center" style="background-image: url('{{ asset('assets/cloudanime.webp') }}');">
    @if(isset($error))
        <div id="error-alert"    
            class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-500 text-white px-4 py-3 mt-6 rounded-lg shadow-lg transition-opacity duration-300 opacity-100">    
            <span>{{ $error }}</span>    
        </div>     

        <script>
            setTimeout(() => {
                const alert = document.getElementById('error-alert');
                if (alert) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 150); // Remove after fade-out
                }
            }, 3000);
        </script>
    @endif

    <x-login-component />

<!-- <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1 max-h-screen-xl">
    <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
        <div class="mt-12 flex flex-col items-center">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('assets/logo-bmkg.png') }}" alt="Logo BMKG" class="h-40">
            </div>
            <h1 class="text-5xl xl:text-4xl font-medium">
                Login to Dashboard
            </h1>
            <div class="w-full flex-1 mt-8">
                <form class="mx-auto max-w-xs" method="post" action="/login">
                    @csrf
                    <div class="relative mt-6">
                        <input type="text" name="user" id="user" placeholder="Username" class="peer mt-2 w-full bg-transparent border-b-2  border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="user" class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 bg-transparent transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Username</label>
                    </div>
                    <div class="relative mt-6">
                        <input type="password" name="password" id="password" placeholder="Password" class="peer peer mt-2 w-full bg-transparent border-b-2  border-gray-300 px-0 py-1 placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                        <label for="password" class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm text-gray-800 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Password</label>
                    </div>
                    <div class="flex items-center justify-between mt-8">
                        <button type="submit" class="btn flex items-center justify-center px-8 py-3 border border-transparent text-base font-normal rounded-md text-white bg-[#28c76f] hover:bg-[#209f58] md:py-4 md:text-lg md:px-10">Log In</button>
                        <Link href={'/forget-password'} class="font-normal text-red-500">
                        Ajukan akun?
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="flex-1 text-center hidden lg:flex relative">
        <div class="absolute w-full h-full bg-gray-500 opacity-5 sm:rounded-lg"></div>
        <div class="w-full bg-contain bg-center bg-cover bg-no-repeat sm:rounded-lg"
            style="background-image: url('assets/cloud-sky.jpg')">
        </div>
    </div>
</div> -->
</body>
</html>
