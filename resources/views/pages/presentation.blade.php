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
                background: url("http://www.ciges.net/revealjs_demo/images/background_bar_h100.png") top left repeat-x;
                position: absolute;
                top: -20px;
                width: 100%;
                height: 80px;
            }

            header .logo {
                background-color: #fff;
                border: solid #fff 10px;
                border-radius: 15px;
                position: absolute;
                top: 0px;
                right: 1em;
            }

            header .logo-text {
                color: white;
                margin: 37px;
            }
        </style>
    
        @yield('head')
    </head>
    
    <body>
        <header class="header">
            <h1 class="logo-text">Twiki - knowledge books</h1>
            <img class="logo" src="http://www.ciges.net/revealjs_demo/images/logo_tegnix_w100.png"/>
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
