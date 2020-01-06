<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

    @if(isset($page_title))
    <title>{{ config('app.name', 'InTransPortal').' - '.$page_title }}</title>
    @else
        <title>{{ config('app.name', 'InTransPortal')}}</title>
    @endif

    <!-- Scripts -->
    <script>
      window.App = {!! json_encode([
        'user' => Auth::user(),
        'signedIn' => Auth::check()
    ]); !!}
    </script>

<    <script src="{{ asset('js/app.js') }}" defer>
</script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .navbar-nav li:hover > ul.dropdown-menu {
            display: block;
        }
        .dropdown-submenu {
            position:relative;
        }
        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top:-6px;
        }

        /* rotate caret on hover */
        .dropdown-menu > li > a:hover:after {
            text-decoration: underline;
            transform: rotate(-90deg);
        }

        body {
            padding-bottom: 100px;
            font-size: 14px !important;
        }
        .level {display: flex; align-items: center; }
        .flex {flex: 1;}
        [v-cloak] {display: none;}
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main class="py-4">
            @yield('content')
        </main>
        <flash message="{{session('flash')}}"></flash>
    </div>
</body>
</html>
