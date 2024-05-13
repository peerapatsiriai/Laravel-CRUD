<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>

    <div class="flex flex-col justify-center items-center h-screen">
        <h1 class="text-3xl font-bold mb-4">Login Page</h1>

        @component('components.alert', ['alert' => session('alert', false), 'message' => session('message')])
        @endcomponent

        <form action="{{ route('login.check') }}" method="POST" class="w-1/5 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="text" id="email" name="email" placeholder="Enter product email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter product password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
                <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Register</a>
            </div>
        </form>
    </div>
    
</body>
</html>
