<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Enartis') }}</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ] -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Premium Icons [ OPTIONAL ]-->
    <!--
    <link href="premium/icon-sets/icons/line-icons/premium-line-icons.min.css" rel="stylesheet">
    <link href="premium/icon-sets/icons/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    -->

    <!--Magic Checkbox [ OPTIONAL ]-->
    <!--
    <link href="plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
    -->

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <!--
    <link href="css/pace.min.css" rel="stylesheet">
    <script src="js/pace.min.js"></script>
    -->
    
    <script type="text/javascript"> const API_KEY = ""</script>

    <!--jQuery [ REQUIRED ]-->
    <script src="{{ asset('js/app.js') }}"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <!--
    <script src="js/bootstrap.min.js"></script>
    -->

    <!--Nifty Admin [ RECOMMENDED ]-->
    <!--
    <script src="js/nifty.min.js"></script>
    -->


</head>

<body>
<div id="container" class="cls-container">
    <div class="cls-content">
        @yield('content')
    </div>
</div>
<!--===================================================-->
<!-- END OF CONTAINER -->


</body>
</html>
