<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Teste Avansys</title>
</head>

<body>
    <div id="app">
        @yield('corpo')
    </div>
    <script src="{{asset('js/app.js')}}"></script>

</body>

</html>