<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta https-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel Vuejs</title>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <!-- Fonts -->
      <!--<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">-->
      <link rel="stylesheet" type="text/css" href="{{mix('css/style.css')}}">
    </head>
    <body>
        <section id="app" class="container">
              <!-- @yield('content')    --> 
        </section>
    </body>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</html>
