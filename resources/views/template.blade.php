<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de gestión de practicantes">
    <meta name="author" content="DavidJA">
    <title>UNJFSC - @yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    

</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Nunito', sans-serif;
    }

    #wrapper {
        display: flex;
    }

    /* Sidebar fijo */
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: 240px;
        height: 100vh;
        overflow-y: auto;
        z-index: 1030;
    }

    /* Contenido principal con margen */
    #content-wrapper {
        margin-left: 240px;
        width: calc(100% - 240px);
        overflow-x: hidden;
        background-color: #f8f9fc;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .topbar {
        z-index: 1029;
    }

    @media (max-width: 768px) {
        .sidebar {
            position: relative;
            width: 100%;
            height: auto;
        }

        #content-wrapper {
            margin-left: 0;
            width: 100%;
        }
    }
</style>

<body>
    @stack('scripts')

    @include('layouts.parte-superior')
             

          
        @yield('content')


    @include('layouts.parte-inferior')

</body>

</html>