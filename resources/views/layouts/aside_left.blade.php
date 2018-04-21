<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bridgekids') }}</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script type="text/javascript"> const API_KEY = "{{Auth::user()->api_token }}"</script>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>




</head>

<body>
<div id="container" class="effect mainnav-lg aside-bright  aside-left  aside-in">
    @include('components.navbar')
    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->

            @yield('content')

        <!--===================================================-->
        <!--END CONTENT CONTAINER-->

        @include('components.main-nav')



    </div>
    @include('components.footer')
</div>

</body>
</html>
