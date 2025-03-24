<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        
    </head>
    <body>
    <header class="bg-blue-600 text-white py-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="{{ route('site.home') }}" class="text-2xl font-bold">Lovatel Car</a>        
        <nav>
            <ul class="flex space-x-6">
                <li><a href="{{ route('site.home') }}" class="hover:text-blue-300">Início</a></li>
                <li><a href="{{ route('site.home') }}" class="hover:text-blue-300">Sobre</a></li>
                <li><a href="{{ route('site.home') }}" class="hover:text-blue-300">Veículos</a></li>
                <li><a href="{{ route('admin.dashboard') }}" class="hover:text-blue-300">Admin</a></li>
            </ul>
        </nav>
    </div>
</header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-blue-800 text-white py-6 mt-12">
    <div class="container mx-auto text-center">
        <p class="text-sm">&copy; {{ date('Y') }} Lovatel Car. Todos os direitos reservados.</p>
        <div class="mt-4 flex justify-center space-x-4">
            <a href="#" class="hover:text-blue-300">Facebook</a>
            <a href="#" class="hover:text-blue-300">Instagram</a>
            <a href="#" class="hover:text-blue-300">LinkedIn</a>
        </div>
    </div>
</footer>


</body>
</html>