<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de gestión de practicantes">
    <meta name="author" content="DavidJA">
    <title>UNJFSC - @yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-yFwcxhZhrM8WxhYMeIvYoL8eQyfxMErYfWZ5w2ZlzzrbnZ8+N1NBBdcGdR6YvYcK3OjDkYXw6PzZKef0fE9FZQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    @stack('scripts')

    @include('layouts.parte-superior')
             

          
        @yield('content')


    @include('layouts.parte-inferior')

</body>

</html>