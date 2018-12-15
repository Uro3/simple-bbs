<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <script>
      window.Laravel = {csrfToken: "{{ csrf_token() }}"};
    </script>
  </head>
  <body>
    <div id="app">
      <div class="container">
        <router-view></router-view>
      </div>
    </div>
  </body>
  <script src="js/app.js"></script>
</html>
