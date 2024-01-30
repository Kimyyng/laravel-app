<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{config("app.name")}}</title>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <main class="container">

      @yield('content')
      
    </main>
    <script src="dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
