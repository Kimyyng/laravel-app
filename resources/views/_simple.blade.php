<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{config("app.name")}}</title>
  <link href="dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-dark text-white">
  <main class="vh-100 d-flex justify-content-center align-items-center container">
    <div class="row">
      @yield("content")
    </div>
  </main>
  <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>