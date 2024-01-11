<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Wendani Sneakers</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
   <link
      href="https://cdn.jsdelivr.net/npm/vue-toast-notification@3/dist/theme-sugar.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('assets/css/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/slick-theme.css') }}"> 
   <link rel="stylesheet" href="{{asset('assets/css/vendor/base.css') }}">


    
    
   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
</head>

<body class="sticky-header">
 

    <div id="app">
      
        <router-view></router-view>

        <!-- Vue Router View -->
    </div>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" ></script>
<script src="{{asset('assets/js/vendor/slick.min.js') }}" ></script>

</body>

</html>
