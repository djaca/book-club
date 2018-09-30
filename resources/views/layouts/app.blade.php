<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
  @include('layouts._nav')

  <main class="py-4">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <div class="position-fixed" style="right: 15px;bottom: 15px;">
    @include('flash::message')
  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
<script>
  $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
</body>
</html>
