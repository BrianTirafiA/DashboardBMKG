<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="w-full max-w-md space-y-6">

    <div class="flex justify-center mb-6">
        <img src="{{ asset('assets/logo-bmkg.png') }}" alt="Logo BMKG" class="h-40">
    </div>

    <div class="w-full max-w-md p-8 space-y-4 bg-white rounded-lg shadow-lg">
        <h2 class="font-bold text-2xl text-center text-gray-800">Login</h2>
        
        <!-- Form -->
        <form action="/login" method="POST" class="space-y-4">
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">User</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Remember Me -->
            <!-- <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="text-blue-500 border-gray-300 rounded focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-600">Remember Me</span>
                </label>
                <a href="#" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
            </div> -->

            <!-- Submit Button -->
            <button type="submit"
                class="w-full px-4 py-2 font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Login
            </button>
        </form>

        <!-- Register Link -->
        <p class="text-sm text-center text-gray-600">
            Dashboard Manajemen DDK BMKG
            <!-- <a href="/register" class="text-blue-500 hover:underline">Register here</a> -->
        </p> 
    </div>
</div>
</body>
</html>
