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
    <style>
        .level {display: flex; align-items: center; }
        .flex {flex: 1;}
        [v-cloak] {display: none;}
    </style>
    @yield('head')
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main class="py-4">
            @yield('content')
            <flash message="{{session('flash')}}"></flash>
        </main>

    </div>
    <script
        src="http://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
