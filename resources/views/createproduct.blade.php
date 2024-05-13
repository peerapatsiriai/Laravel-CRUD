<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    @include($header)
    <div class="flex flex-col justify-center items-center h-screen">
        <h1 class="text-3xl font-bold mb-4">Create Product</h1>

        @component('components.alert', ['alert' => session('alert', false), 'message' => session('message')])
        @endcomponent

        <form action="{{ route('product.create') }}" method="POST" class="w-1/5 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" id="name" name="product_name" placeholder="Enter product name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                <input type="number" id="amount" name="product_amount" placeholder="Enter product amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Product
                </button>
                <a href="{{ route('productspages') }}" class="text-blue-500 hover:text-blue-700">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
