@php
    $lang = session()->get('lang') == 'ar' ? 'ar' : 'en';
@endphp

<!doctype html>
<html lang="{{ config('app.locale') }}" @if ($lang == 'ar') dir="rtl" @endif itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __(gs('site_name')) }} - {{ __(@$title ?? '') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logoIcon/favicon.jpg') }}">
    @yield("meta_tags")
    @stack('seo')
    <!-- Bootstrap CSS -->


    @if ($lang == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.rtl.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.min.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/global/css/all.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}" />
    
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/web/css/main.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    @if ($lang == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/web/css/arabic.css') }}" />
    @endif

    <link rel="stylesheet" href="{{ asset('assets/web/css/custom.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/web/css/jssocials.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css') }}">

    @stack('style-lib')

    @stack('style')
    
    
    @if($lang == 'ar')
        <style>
             body{
                 font-family: 'Cocogoose', sans-serif;
             }
        </style>
    @else
        <style>
             body{
                 font-family: "Open Sans", sans-serif;
             }
        </style>
    @endif
</head>

<body>


    @yield('panel')


    <script src="{{ asset('assets/global/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/web/js/jssocials.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/web/js/main.js') }}"></script>

    @stack('script-lib')

    @include('partials.plugins')

    @include('partials.notify')

    @stack('script')

    <script>
        (function($) {
            "use strict";

            $(".langSel").on("click", function() {
                var langCode = $(this).data('lang');
                window.location.href = "{{ route('home') }}/change/" + langCode;
            });

            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            var inputElements = $('[type=text],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }

            });

            $(document).ready(function() {
                $('.select2-multiple').select2({
                    tags: true
                });

                $('.mobile-menu-click').on('click', function () {
                    $('body').addClass('padding-right-0');
                    
                });
            });

        })(jQuery);


        $(function() {
            $('img[data-src]').lazyload();
            $("form.validate").validate({
                errorClass: 'text-danger'
            });
        });
    </script>
    <script>

    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?15319';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
        "enabled": true,
        "chatButtonSetting": {
            "backgroundColor": "#39004E",
            "ctaText": "{{ app()->getLocale() == 'ar' ? 'ابدأ الدردشة' : 'Start Chat'   }}", 
            "borderRadius": "25",
            "marginLeft": "0",
            "marginBottom": "50",
            "marginRight": "50",
            "position": "right"
        },
        "brandSetting": {
            "brandName": "{{ app()->getLocale() == 'ar' ? 'تينكو' :'Teincu' }}",
            "brandSubTitle":  "{{ app()->getLocale() == 'ar' ? 'تينكو' :'Teincu' }}",
            "brandImg": "https://teincu.com/assets/images/logoIcon/logo.png",
            "welcomeText": "",
            "messageText": "",
            "backgroundColor": "#39004E",
            "ctaText":"{{ app()->getLocale() == 'ar' ? 'ابدأ الدردشة' : 'Start Chat'   }}", 
            "borderRadius": "25",
            "autoShow": false,
            "phoneNumber": "966550217734"
        }
    };

    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);

</script>
</body>

</html>
