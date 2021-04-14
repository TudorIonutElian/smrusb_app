<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem de Management al Resurselor Umane in Sistemul Bugetar</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css')}}">
        <link rel="stylesheet" href="{{ asset('/css/custom.css')}}">
    </head>
    <body class="antialiased">
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="{{ asset('/js/app.js')}}"></script>
        <script src="{{ asset('/js/bootstrapJavascript.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    </body>
</html>
