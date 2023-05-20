<!doctype html>
<html>
    <head>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <link rel="profile" href="#">

        <title>@yield("title")</title>


        <!--Google Font-->
        <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
        <!-- Mobile specific meta -->
        <meta name=viewport content="width=device-width, initial-scale=1">
        <meta name="format-detection" content="telephone-no">

        <!-- CSS files -->
        <link rel="stylesheet" href="/css/ui/plugins.css">
        <link rel="stylesheet" href="/css/ui/style.css">

    </head>
    <body>


        <div class="overlay openform" style="flex-direction: column">
            @include("comps.messages")
            @yield('content')
        </div>

        <!-- JS files -->
        <script src="/js/ui/jquery.js"></script>
        <script src="/js/ui/plugins.js"></script>
        <script src="/js/ui/plugins2.js"></script>
        <script src="/js/ui/custom.js"></script>
        <script src="/js/ui/app.js"></script>
    </body>
</html>
