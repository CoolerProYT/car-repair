<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <!--Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <!--Bootstrap-->
        <link href="https://fastly.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://fastly.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <!--JQuery-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!--W3.css-->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">
        <!--Icon-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
        <title>@yield('title', '') | Car Repair Admin Panel</title>
        <link rel="stylesheet" href="{{ asset('css/seller_style.css') }}">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        @livewireStyles
    </head>
    <body class="bg-light d-flex">
        @include('admin.layout.sidebar')
        <div class="content">
            @include('admin.layout.header')
            @yield('content')
        </div>
        @livewireScripts
    </body>
</html>
