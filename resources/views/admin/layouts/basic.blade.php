<!doctype html>
<html lang="en" data-bs-theme="semi-dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>

    <!--plugins-->
    <link href="/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
    <link href="/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <!--Styles-->
    <link href="/css/admin/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/admin/icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="/css/admin/main.css" rel="stylesheet">
    <link href="/css/admin/app.css" rel="stylesheet">
    <link href="/css/admin/semi-dark-theme.css" rel="stylesheet">
     
  </head>
  <body>

    <div id="app-basic-layout">
        <div class="container-fluid my-5">
            <div class="row">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                <div class="card border-3">
                <div class="card-body p-5">
                    @yield("content")
                </div>
                </div>
            </div>
            </div><!--end row-->
        </div>
    </div>
    <!--plugins-->
    <script src="/js/admin/jquery.min.js"></script>

    @yield("scripts")

  </body>
</html>