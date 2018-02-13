<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.includes.navbar')
        
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @include('layouts.includes.alertMessage')
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>                                      

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/myjs.js') }}"></script>
</body>
</html>
