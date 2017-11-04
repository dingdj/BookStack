<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $page->name }}</title>

    <link rel="stylesheet" href="{{ baseUrl('/libs/reveal-js/css/reveal.css') }}"/>
    <link rel="stylesheet" href="{{ baseUrl('/libs/reveal-js/css/theme/beige.css') }}"/>

    <script src="{{ baseUrl('/libs/jquery/jquery.min.js?version=2.1.4') }}"></script>
    <script src="{{ baseUrl('/libs/reveal-js/js/reveal.min.js?version=3.5.0') }}"></script>

    @yield('head')
</head>
<body>
    <div class='reveal'>
        <div class='slides'>
            {!! $page->html !!}
        </div>
    </div>
    

<script>
    $slideRoot = $('.slides');
    $('h2').each((index, h2) => {
        $(h2)
            .nextUntil('.slides>h2')
            .andSelf()
            .wrapAll("<section class='section'>");
    });
    $slideRoot.find(">*").not('section').remove();

    Reveal.initialize({});
</script>
</body>
</html>
