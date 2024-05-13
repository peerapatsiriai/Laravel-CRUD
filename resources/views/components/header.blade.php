<header class="bg-blue-500 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-10">
        <a href="{{ route('productspages') }}" class="text-2xl font-bold">CRUD App</a>
        <h1 class="text-2xl font-bold">Hello {{ $username }}</h1>
        <nav>
            <ul class="flex space-x-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-white text-blue-500 font-bold py-2 px-4 rounded hover:bg-blue-700 hover:text-white " type="submit">Logout</button>
            </form>
                
            </ul>
        </nav>
    </div>
</header>
