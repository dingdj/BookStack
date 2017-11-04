<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $page->name }}</title>

    <link rel="stylesheet" href="{{ baseUrl('/libs/reveal-js/css/reveal.css') }}"/>
    <link rel="stylesheet" href="{{ baseUrl('/libs/reveal-js/css/theme/beige.css') }}"/>
    
<!--    <script src="{{ baseUrl('/libs/jquery/jquery.min.js?version=2.1.4') }}"></script>-->
    <script src="{{ baseUrl('/libs/reveal-js/js/reveal.min.js?version=3.5.0') }}"></script>
    
    @yield('head')
</head>
<body>

{!! $page->html !!}

<script>
    Reveal.initialize({});
//    $('.reveal').prependTo("body");
</script>
</body>
</html>
