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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Josefin Sans', sans-serif;
        font-size: 18px;
        font-weight: 400;
        color: #494C6B;
        background: #F9FAFB;
    }

    h1 {
        font-size: 40px;
        font-weight: 700;
        letter-spacing: 15px;
        color: #FFF;
    }

    .todo-input {
        border: none;
        outline: none !important;
        background: none !important;
        color: #393A4B;
        padding-left: 48px !important;
        width: 100%;
    }

    .card {
        box-shadow: 0 0 20px rgba(0, 0, 0, .1);
        border-radius: 5px;
        border: 1px solid transparent;
    }


    .todo-title {
        border: none;
        outline: none;
        background: none;
        padding: 0;
        color: #494C6B;
        max-width: 400px;
    }

    .todo-container {
        margin-top: 72px;
        margin-bottom: 42px;
    }

    .todo-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 24px;
        text-align: start;
        margin: 0;
        cursor: pointer;

    }

    .todo-item:not(:last-child) {
        border-bottom: 1px solid #E3E4F1;
    }

    .dark-mode .todo-item:not(:last-child) {
        border-bottom: 1px solid rgba(255, 255, 255, .1);
    }

    .complete-button,
    .incomplete-button {
        border-radius: 50%;
        border: none;
        outline: none;
        margin-right: 24px;
        width: 24px;
        height: 24px;
        font-size: 24px;
        text-align: center;
        overflow: hidden;
    }

    .incomplete-button {
        color: #E3E4F1;
    }

    .incomplete-button:hover {
        background: linear-gradient(147deg, rgba(85, 221, 255, 1) 0%, rgba(192, 88, 243, 1) 73%);
        -webkit-text-fill-color: transparent;
        -webkit-background-clip: text;
    }

    .complete-button,
    .dark-mode .complete-button {
        border-radius: 50%;
        height: 24px;
        width: 24px;
        color: white !important;
        background: linear-gradient(147deg, rgba(85, 221, 255, 1) 0%, rgba(192, 88, 243, 1) 73%);
    }

    .btn-primary {
        background: linear-gradient(147deg, rgba(85, 221, 255, 1) 0%, rgba(192, 88, 243, 1) 73%);
        border: none;
        outline: none;
    }

    .completed {
        text-decoration: line-through;
        color: #BFBFBF !important;
    }

    .dark-mode .completed {
        color: rgba(255, 255, 255, .5) !important;
    }

    .dark-mode .todo-title {
        color: #fff !important;
    }

    .no-todos {
        text-align: center;
        color: #494C6B;
    }

    a {
        border: none !important;
        outline: none !important;
        background: none;
        cursor: pointer;
    }

    .active {
        color: #3A7CFD !important;
    }

    .icon {
        background-image: url('/img/icon-moon.svg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        width: 24px;
        height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .bg {
        background: url('{{ asset('img/bg-desktop-light.jpg') }}');
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 320px;
        z-index: -1;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }

    .dark-mode .dark-backdrop {
        background-color: #171823;
        z-index: -100;
        width: 100%;
        height: 100vh;
        position: absolute;
        top: 0;
        left: 0;
    }

    .dark-mode .navbar,
    .dark-mode .navbar-brand,
    .dark-mode .navbar-nav .nav-link,
    .dark-mode .navbar-nav .dropdown-menu,
    .dark-mode .navbar-nav .dropdown-item,
    .dark-mode .card,
    .dark-mode .card-body,
    .dark-mode input {
        background-color: #25273D !important;
        color: #FFF !important;
    }

    .dark-mode .bg {
        background: url('{{ asset('img/bg-desktop-dark.jpg') }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        width: 100%;
        height: 320px;
        z-index: -1;

    }

    .dark-mode .icon {
        background-image: url('/img/icon-sun.svg');
    }

    .dark-mode .todo-count {
        background-color: #25273D !important;
        color: #5B5E7E !important;
    }

    .dark-mode a:hover {
        color: #E3E4F1 !important;
    }

    .dark-mode .selections {
        color: #5B5E7E !important;
    }

    .dark-mode .selections:hover {
        color: #E3E4F1 !important;
    }

    .light-mode .selections:hover {
        color: #494C6B !important;
    }

    .selections,
    .light-mode .todo-count {
        color: #9495A5 !important;
    }
</style>

<body class="{{ session('isDark') ? 'dark-mode' : 'light-mode' }}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item
    dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="position-relative">
            <div class="bg">
            </div>
            <div class="dark-backdrop">
            </div>
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>

</html>
