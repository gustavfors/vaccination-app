<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <style>
        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            width: 4px;
            height: calc(100% - 24px);
            background-color: #edf2f7;
            border-radius: 6px;
            top: 47px;
            left: 18px;
        }


        .shadow-custom {
            -webkit-box-shadow: 0px 0px 30px 0px rgba(82, 63, 105, 0.05);
            box-shadow: 0px 0px 30px 0px rgba(82, 63, 105, 0.05);
        }

        td,
        th {
            border-bottom: 1px solid #eee;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 15px;
        }

        th {
            padding-top: 0;
        }

        .menu-item {
            padding: 10px 16px;
        }

        .menu-item:hover,
        .menu-item-active {
            background-color: #2d3748;
            border-radius: 0.5rem;
            color: #fff;
        }

        .profile-picture {
            object-fit: cover;
            object-position: center;
        }

    </style>
</head>
<body class="pb-12" style="background-color: #fbf7ef; font-family: 'Poppins', sans-serif;">

    <header class="bg-gray-900">
        <div class="container mx-auto flex items-center">
            <a href="/home" class="text-white text-2xl tracking-wider font-semibold bg-green-600 p-6">Healthzone</a>
        
            <nav class="ml-6 font-medium text-xs tracking-wide">
                @if (Route::current()->uri === 'home')
                <a href="/home" class="text-gray-400 menu-item menu-item-active">Dashboard</a>
                @else
                <a href="/home" class="text-gray-400 menu-item">Dashboard</a>
                @endif

                @if (Route::current()->uri === 'vaccinations/create')
                <a href="/vaccinations/create" class="text-gray-400 menu-item menu-item-active">Add Vaccination</a>
                @else
                <a href="/vaccinations/create" class="text-gray-400 menu-item">Add Vaccination</a>
                @endif
                
                @can ('admin')
                    @if (Route::current()->uri === 'vaccines')
                    <a href="/vaccines" class="text-gray-400 menu-item menu-item-active">Manage Vaccines</a>
                    @else
                    <a href="/vaccines" class="text-gray-400 menu-item">Manage Vaccines</a>
                    @endif
                @endcan

                @if (Route::current()->uri === 'family')
                <a href="/family" class="text-gray-400 menu-item menu-item-active">Manage Family</a>
                @else
                <a href="/family" class="text-gray-400 menu-item">Manage Family</a>
                @endif

                
            </nav>
        
            <div class="ml-auto flex items-center text-xs font-medium tracking-wide relative">
                <!-- <div class="flex items-center mr-4 relative">
                    <span class="material-icons text-white text-xl">
                    notifications
                    </span>
                    <span class="bg-red-600 absolute flex items-center justify-center rounded-full text-white font-bold" style="height: 15px; width: 15px; top: -10px; right: -10px; font-size: 8px;">3</span>
                </div> -->
                <img src="/storage/{{ Auth::user()->avatar }}" alt="avatar" class="rounded-full mr-3 profile-picture" style="height:35px; width: 35px;">
                <h4 class="text-white">{{ Auth::user()->name }}</h4>
                <span class="material-icons ml-1 text-white cursor-pointer" onclick="showMenu()">arrow_drop_down</span>
                <button id="navBackdrop" class="bottom-0 right-0 left-0 top-0 fixed w-full h-full hidden cursor-default" style="z-index: 99;" onclick="hideMenu()"></button>
                <div id="navMenu" class="mt-2 py-2 w-48 bg-white rounded-lg shadow-xl absolute right-0 hidden" style="top: 35px; z-index: 999;">
                    <a class="block px-4 py-2 text-gray-800 hover:bg-green-600 hover:text-white" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                </div>
            </div>
        </div>
    </header>

    <section class="bg-white py-6 shadow-custom">
        <div class="container mx-auto flex items-center">
            <h3 class="font-medium text-lg tracking-wide text-gray-900">Dashboard</h3>
            <a href="/family" class="bg-green-300 hover:bg-green-600 text-green-700 hover:text-white py-2 px-4 rounded text-xs font-semibold ml-auto flex items-center">
                <span class="material-icons mr-2">people</span>Manage Family
            </a>
            <a href="/vaccinations/create" class="bg-green-300 hover:bg-green-600 text-green-700 hover:text-white py-2 px-4 rounded text-xs font-semibold ml-4 flex items-center">
                <span class="material-icons mr-2">book_online</span>Add Vaccination
            </a>
        </div>
    </section>

    <main class="container mx-auto">
        @yield('content')
    </main>

    <!-- <footer class="bg-white py-6 shadow-custom mt-12">
        <div class="container mx-auto">
            <div class="text-center text-gray-600 text-xs">Copyright 2020 Healthzone</div>
        </div>
    </footer> -->

    <script>
        function showMenu() {
            document.getElementById("navMenu").classList.remove("hidden");
            document.getElementById("navBackdrop").classList.remove("hidden");
        }

        function hideMenu() {
            document.getElementById("navMenu").classList.add("hidden");
            document.getElementById("navBackdrop").classList.add("hidden");
        }

    </script>
</body>
</html>
