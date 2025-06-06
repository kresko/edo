<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edo</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <!-- Header -->
        <x-header>
            <ul>
                <li><a href="#"><img class="logo" src="{{ Vite::asset('resources/images/edo-logo.png') }}" alt="logo"/></a></li>
                <li><a href="#">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>

            <ul>
                <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li>
            </ul>
        </x-header>

        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <x-footer></x-footer>
    </body>
</html>