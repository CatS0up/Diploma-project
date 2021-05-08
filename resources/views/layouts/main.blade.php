<!DOCTYPE html>
<html lang="pl-PL">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', $appName)</title>
</head>

<body class=@yield('page-bg')>
    <div id="page" class="site">
        <header class="headers headers--dark site__headers">
            @include('shared.navigation')
        </header>

        <div class="site__inner">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
