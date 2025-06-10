<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de gestión de practicantes">
    <meta name="author" content="DavidJA">
    <title>UNJFSC</title>

</head>

<body>

    @include('layouts.parte-superior')
             

          
        @yield('content')


    @include('layouts.parte-inferior')

</body>

</html>