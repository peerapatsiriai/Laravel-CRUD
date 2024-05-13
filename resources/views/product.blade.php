<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include($header)
    <div class="flex flex-col justify-center items-center h-screen">

        <h1 class="text-3xl font-bold">Products List</h1>

        <div class="flex flex-col bg-whites w-1/2.7 h-1/2 bg-white ">
            
            <div class="flex justify-end items-end w-full h-10 mb-3 ">
                <a href="{{ route('createpage') }}"id="createBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create
                </a>
            </div>

            @component('components.alert', ['alert' => session('alert', false), 'message' => session('message')])
            @endcomponent

             <!-- Start Table -->
            <table class="table-auto rounded ">
                <thead>
                    <tr>
                        <th class="px-2 py-2 bg-blue-500 text-white">Product Name</th>
                        <th class="px-2 py-2 bg-blue-500 text-white">Product Amounts</th>
                        <th class="px-2 py-2 bg-blue-500 text-white">Product Create</th>
                        <th class="px-2 py-2 bg-blue-500 text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $product->product_name }}</td>
                        <td class="border px-4 py-2 text-center">{{ $product->product_amount }}</td>
                        <td class="border px-4 py-2 text-center">{{ $product->created_at }}</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('products.edit', $product->product_id) }}" class="bg-yellow-500 p-1 text-white hover:text-blue-700 rounded">Edit</a>
                            <form method="POST" action="{{ route('product.destroy', $product->product_id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 p-1 text-white hover:text-gray-700 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Table -->
        </div>
    </div>
</body>
</html>