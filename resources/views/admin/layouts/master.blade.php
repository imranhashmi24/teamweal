@php
    $lang = session()->get('lang') == 'ar' ? 'ar' : 'en';
@endphp

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" @if ($lang == 'ar') dir="rtl" @endif class="semi-dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ siteFavicon() }}">
    <title>{{ gs('site_name') }} - {{ __(@$title ?? '') }}</title>
    @if ($lang == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.rtl.min.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">

    <link href="{{ asset('assets/admin/css/icons.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    @stack('style-lib')

    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/css/extensions/sweetalert2.min.css') }}">


    @if ($lang == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/rtl_style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    @endif

    @stack('style')
</head>

<body>
    <div class="wrapper">
        @yield('content')
    </div>

    @stack('html')

    <script src="{{ asset('assets/global/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>

    {{-- panel --}}
    <script src="{{ asset('assets/admin/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>


    @include('partials.notify')

    @stack('script-lib')

    <script src="{{ asset('assets/admin/js/nicEdit.js') }}"></script>
    <script src="{{ asset('assets/admin/js/cuModal.js') }}"></script>

    <script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    {{-- LOAD NIC EDIT --}}


    <script>
        "use strict";

        $(".langSel").on("click", function() {
            var langCode = $(this).data('lang');
            window.location.href = "{{ route('home') }}/change/" + langCode;
        });


        bkLib.onDomLoaded(function() {
            $(".nicEdit, nicEdit2").each(function(index) {
                $(this).attr("id", "nicEditor" + index);
                new nicEditor({
                    fullPanel: true
                }).panelInstance('nicEditor' + index, {
                    hasPanel: true
                });
            });
        });

        (function($) {
            $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function() {
                $('.nicEdit-main').focus();
            });
        })(jQuery);


        $(document).ready(function() {
            $('.select2-multiple').select2();
        });

    </script>



    @stack('script')

</body>

</html>
