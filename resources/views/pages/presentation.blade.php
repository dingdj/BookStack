<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>{{ $page->name }}</title>
    
        <link rel="stylesheet" href="{{ baseUrl('/libs/reveal-js/css/reveal.css') }}"/>
        <link rel="stylesheet" href="{{ baseUrl('/libs/reveal-js/css/theme/serif.css') }}"/>
        <link rel="stylesheet" href="{{ baseUrl('/libs/reveal-js/lib/css/zenburn.css') }}"/>

        <script src="{{ baseUrl('/libs/jquery/jquery.min.js?version=2.1.4') }}"></script>
        <script src="{{ baseUrl('/libs/reveal-js/js/reveal.min.js?version=3.5.0') }}"></script>
        <script src="{{ baseUrl('/libs/reveal-js/lib/js/head.min.js?version=1.0.3') }}"></script>
        
        <style>
            header {
                background-color: rgba(209, 122, 2, 0.8);
                width: 100%;
                height: 56px;
                margin-top: 1px;
            }

            header .logo {
                height: 50px;
                float: right;
                padding: 3px 20px;
            }

            header .logo-text {
                color: white;
                float: left;
                font-size: 38px;
                padding: 7px 20px;
            }
        </style>
    
        @yield('head')
    </head>
    
    <body>
        <header class="header">
            <div class="logo-text">Twiki - Present books</div>
            <img class="logo" src="https://camo.githubusercontent.com/566e9f6920a7cc5d43536d90b76069ec80241909/687474703a2f2f692e696d6775722e636f6d2f414b73436179472e706e67"/>
        </header>
        
        <div class='reveal'>
            <div class='slides'>
                {!! $page->html !!}
            </div>
        </div>
    </body>
    
    <script>
        $('.slides>h2').each((index, h) => {
            $(h).nextUntil(h.tagName).andSelf()
                .wrapAll("<section class='section'>");
        });
        $('.slides').find(">*").not('section').remove();
    
        $('section').each((index, section) => {
            $subheading = $('h3', section);
            if ($subheading.length !== 0) {
                $subheading.each((index, h) => {
                    $(h).nextUntil(h.tagName).andSelf()
                        .wrapAll("<section class='section-child'>");
                });
                $(section).find(">*").not('section').wrapAll("<section class='section-child'>")
            }
        });
    
        Reveal.initialize({
            controls: true, //Display controls in the bottom right corner
            progress: true, //Display a presentation progress bar
            slideNumber: true, //Display the page number of the current slide
            history: true, //Push each slide change to the browser history
            keyboard: true, //Enable keyboard shortcuts for navigation
            overview: true, //Enable the slide overview mode
            center: true, //Vertical centering of slides
            touch: true, //Enables touch navigation on devices with touch input
            loop: false, //Loop the presentation
            rtl: false, //Change the presentation direction to be RTL
            fragments: true,  //Turns fragments on and off globally
            embedded: false, //Flags if the presentation is running in an embedded mode, i.e. contained within a limited portion of the screen
            help: true, //Flags if we should show a help overlay when the questionmark key is pressed
            showNotes: true, //Flags if speaker notes should be visible to all viewers
            autoSlide: 0, //Number of milliseconds between automatically proceeding to the next slide, disabled when set to 0, this value can be overwritten by using a data-autoslide attribute on your slides
            autoSlideStoppable: true, //Stop auto-sliding after user input
            mouseWheel: true, //Enable slide navigation via mouse wheel
            hideAddressBar: true, //Hides the address bar on mobile devices
            previewLinks: true, //Opens links in an iframe preview overlay
            transition: 'concave', //none/fade/slide/convex/concave/zoom
            transitionSpeed: 'slow', //default/slow/fast
            backgroundTransition: 'default', //none/fade/slide/convex/concave/zoom  //Transition style for full page slide backgrounds
    
            dependencies: [
                { src: '/libs/reveal-js/plugin/highlight/highlight.js', async: true, callback: function() {
                    hljs.initHighlightingOnLoad();
                }},
            ],
        });
    </script>
</html>
