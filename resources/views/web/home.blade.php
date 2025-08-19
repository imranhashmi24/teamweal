@extends('web.layouts.frontend', ['title' => __('homepage')])

@section('meta_tags')
    @if (app()->getLocale() == 'en')
        <meta name="locale" content="{{ app()->getLocale() }}" />
        <link rel="canonical" href="{{ url()->current() }}" />
        <meta property="og:locale" content="en" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="حاضنة التكنولوجيا" />
        <meta property="og:description" content="خدمات وحلول تكنولوجيا المعلومات" />
        <meta property="og:keyword" content="خدمات وحلول تكنولوجيا المعلومات" />
        <meta property="og:url" content="https://demo.teincu.com/">
        <meta property=" og:site_name" content="{{ gs('site_name') }}" />
        <meta property="article:author" content="Muhammad Al Sari" />
        <meta property="article:published_time" content="2024-05-15T15:31:38+00:00" />
        <meta property="article:modified_time" content="2024-05-15T15:32:33+00:00" />
        <meta property="og:image" content="{{ siteLogo() }}" />
        <meta property="og:image:width" content="1280" />
        <meta property="og:image:height" content="853" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:creator" content="@#" />
        <meta name="twitter:label1" content="Written by" />
        <meta name="twitter:data1" content="خليل النمازي" />
    @else
        <meta name="locale" content="{{ app()->getLocale() }}" />
        <link rel="canonical" href="{{ url()->current() }}" />
        <meta property="og:locale" content="ar" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="حاضنة التكنولوجيا " />
        <meta property="og:description" content="خدمات وحلول تكنولوجيا المعلومات" />
        <meta property="og:keyword" content="خدمات وحلول تكنولوجيا المعلومات" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property=" og:site_name" content="{{ gs('site_name') }}" />
        <meta property="article:author" content="لمستشار  محمد آل ساري " />
        <meta property="article:published_time" content="2024-05-15T15:31:38+00:00" />
        <meta property="article:modified_time" content="2024-05-15T15:32:33+00:00" />
        <meta property="og:image" content="{{ siteLogo() }}" />
        <meta property="og:image:width" content="1280" />
        <meta property="og:image:height" content="853" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:creator" content="@#" />
        <meta name="twitter:label1" content="Written by" />
        <meta name="twitter:data1" content="خليل النمازي" />
    @endif
@endsection
@section('content')

    {{-- ===================================== Hero secton Start=================================== --}}
    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="col-lg-8">
                <h1>Finance Incubator –</h1>
                <h2>The Integrated Platform for Developmental and Social Investment</h2>
                <p>
                    A unified platform that brings together financing services from developmental and financial
                    institutions,
                    along with investment opportunities in promising projects and community-driven initiatives. It offers
                    marketing, training, and employment tools to empower investors, funders, and entrepreneurs in building
                    impactful and sustainable economic and social partnerships.
                </p>
                <a href="#" class="btn btn-custom mt-3">Create Investor Account</a>
            </div>
        </div>
    </section>

    {{-- ===================================== Hero secton End=================================== --}}

    {{-- ===================================== Service secton Start=================================== --}}

    <section class="py-5">
        <div class="container">
            <!-- Title -->
            <div class="section-title">
                <h2>Our Market Place</h2>
                <div class="divider"><span></span>◆<span></span></div>
                <p>
                    Empowering individuals and businesses to explore and apply for funding and support services provided by
                    government development funds through a unified platform — with ease and transparency.
                </p>
                <h5 class="mt-4 fw-bold">
                    Development Funds and Banks Affiliated with the National Development Fund
                </h5>
            </div>

            <!-- Cards -->
            <div class="row g-4">

                <!-- Card 1 -->
                @for ($i = 0; $i < 12; $i++)
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-header bg-light text-center p-0">
                                <img src="{{ asset('assets/web/img/service-img.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="card-body d-flex flex-column bg-white">
                                <h5 class="mb-3">Real Estate Development Fund</h5>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex mb-2">
                                        <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                        <div>
                                            <span class="fw-bold">Subsidized Housing Loan:</span>
                                            <span> Providing subsidized home loans to citizens in partnership with
                                                banks.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-2">
                                        <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                        <div>
                                            <span class="fw-bold">Self-Build Financing:</span>
                                            <span> Supporting citizens in building their own homes on private land.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-2">
                                        <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                        <div>
                                            <span class="fw-bold">Mortgage:</span>
                                            <span> Financing solutions for housing and land purchase.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-2">
                                        <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                        <div>
                                            <span class="fw-bold">Mortgage:</span>
                                            <span> Financing solutions for housing and land purchase.</span>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-2">
                                        <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                        <div>
                                            <span class="fw-bold">Mortgage:</span>
                                            <span> Financing solutions for housing and land purchase.</span>
                                        </div>
                                    </li>
                                </ul>
                                <!-- Button at bottom -->
                                <div class="mt-auto">
                                    <a href="#" class="btn btn-request">Request Service</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>


    {{-- ===================================== Service secton End=================================== --}}
    {{-- ===================================== Service secton End=================================== --}}

    <div class="container py-5">
        <!-- Section Title -->
        <div class="section-title">
            <h2>Private Sector</h2>
            <a href="#">Finance</a>
        </div>

        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header bg-light p-0">
                        <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                    </div>
                    <div class="card-body d-flex flex-column bg-white">
                        <h5 class="mb-3">Real Estate Development Fund</h5>
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex mb-1">
                                <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                <p class="mb-0">Personal Financing</p>
                            </li>
                            <li class="d-flex mb-1">
                                <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                <p class="mb-0">Personal Financing</p>
                            </li>
                            <li class="d-flex mb-1">
                                <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                <p class="mb-0">Personal Financing</p>
                            </li>

                        </ul>
                        <!-- Button at bottom -->
                        <div class="mt-auto">
                            <a href="#" class="btn btn-request">Request Service</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- ===================================== Service secton End=================================== --}}




    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include('sections.' . $sec)
        @endforeach
    @endif

@endsection



@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/web/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/slick-theme.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/web/js/slick.min.js') }}"></script>
@endpush


@push('script')
    <script>
        $(window).on('resize', function(event) {
            let width = $(document).width()

            if (width < 576) {
                $(".property-type-area-slider").slick({
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    speed: 1800,
                    dots: false,
                    arrows: false,
                    @if (session()->get('lang') == 'ar')
                        rtl: true,
                    @endif
                });
            }
        });

        if ($(window).width() < 576) {
            $(".property-type-area-slider").slick({
                slidesToShow: 2,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 3000,
                speed: 1800,
                dots: true,
                arrows: false,
                @if (session()->get('lang') == 'ar')
                    rtl: true,
                @endif
            });
        }
    </script>
@endpush
