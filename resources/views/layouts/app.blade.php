<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Projeto Seacole, mais descrição em breve...">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Seacole') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('css')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('layouts.dashboard.shared.header')
        <div class="app-main">
            @include('layouts.dashboard.shared.sidebar')
            <div class="app-main__outer">
                <main class="">
                    @yield('content')
                </main>
            @include('layouts.dashboard.shared.footer')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/architectui.js') }}"></script>

    <script>
        const API_URL = "{{ env(" APP_URL ") }}" + "/api";
        const APP_URL = "{{ env(" APP_URL ") }}";
    </script>
    <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    @yield('script')
</body>

</html>
