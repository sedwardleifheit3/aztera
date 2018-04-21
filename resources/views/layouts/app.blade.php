<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Enartis') }}</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <script type="text/javascript"> const API_KEY = "{{ (Auth::check()) ? Auth::user()->api_token : ''}}"</script>
    @ifUserIs('admin')
        <script type="text/javascript"> const IS_ADMIN = true; </script>
    @else    
        <script type="text/javascript"> const IS_ADMIN = false; </script>
    @endif
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</head>

<body>
<div id="container" class="effect aside-float aside-bright reveal mainnav-out navbar-fixed ">
    @include('components.navbar')
    <div class="boxed">
        <div id="content-container" class="app-container">
            @yield('content')
         </div>
    </div>
    @include('components.footer')
</div>

</body>
</html>
