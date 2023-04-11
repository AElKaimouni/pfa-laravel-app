<!doctype html>
<html lang="en" data-bs-theme="dark">
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
     
  </head>

<body class="bg-error">

<!-- Start wrapper-->
 <div class="pt-5">
 
    <div class="container pt-5">
            <div class="row pt-5">
                <div class="col-lg-12">
                    <div class="text-center error-pages">
                        @yield("content")
                    </div>
                </div>
            </div><!--end row-->
        </div>

 </div><!--wrapper-->


	
</body>
</html>
