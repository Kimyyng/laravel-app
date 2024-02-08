<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{config("app.name")}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
      main {
        max-width: 576px;
      }
    </style>
  </head>
  <body>
    <main class="mx-auto py-1 px-2">
      @yield('content')
    </main>
    <script src="/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
