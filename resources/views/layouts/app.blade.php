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
    <link href="/css/hardware.css" rel="stylesheet"> 

    <script>
        window.company={!! json_encode(company()) !!}
        
    </script>
</head>
<body>
    <div id="app">
        @include('layouts.nav')
     <div class="container-fluid">
        @include('layouts.branches')
       @yield('content')
        <flash :data="{{ session("flash-data")?:'{}' }}"></flash>
     </div>

  {{--    <div class="wrapper">
       @include('layouts.sidebar')
       <div class="main-panel">
         @include('layouts.topNav')
         @yield('content')
         @include('layouts.footer')
       </div>
     </div> --}}

     <flash :data="{{ session("flash-data")?:'{}' }}"></flash>
   </div>
   <!-- Scripts -->
   <script src="/js/hardware.js"></script>
</body>
</html>
