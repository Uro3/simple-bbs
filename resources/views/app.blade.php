<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

    <script>
      window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        clientId: "{{ config('passport.client_id') }}",
        clientSecret: "{{ config('passport.client_secret') }}"
      };
    </script>
  </head>
  <body>
    <div id="app"></div>
  </body>
  <script src="{{ mix('js/app.js')}}"></script>
</html>
