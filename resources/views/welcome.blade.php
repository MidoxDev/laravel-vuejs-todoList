<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->


        <!-- Styles -->
        @vite('resources/js/app.js')
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class="main" id="app">
            <index />
        </div>
    </body>
</html>
