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
   @include('sections.hero_section')

    {{-- ===================================== Hero secton End=================================== --}}

    {{-- ===================================== Service secton Start=================================== --}}

    <section class="py-5">
        <div class="container">
            
            <!-- Title -->
            <div class="section-title">
                <h2>{{ __('Our Market Place') }}</h2>
                <div class="divider"><span></span>◆<span></span></div>
                <p>
                    {{ __('Empowering individuals and businesses to explore and apply for funding and support services provided by
                    government development funds through a unified platform — with ease and transparency.') }}
                </p>
                <h5 class="mt-4 fw-bold">
                    {{ __('Development Funds and Banks Affiliated with the National Development Fund') }}
                </h5>
            </div>


            @if ($our_services->count() > 0)
                
        
            <!-- Cards -->
            <div class="row g-4">

                <!-- Card 1 -->
                @foreach ($our_services as $our_service)
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-header bg-light text-center p-0">
                                <img src="{{ getImage(getFilepath('our_service') . '/' . $our_service->image) }}" alt="" class="img-fluid">
                            </div>
                            <div class="card-body d-flex flex-column bg-white">
                                <h5 class="mb-3">{{ $our_service?->lang('title') }}</h5>
                                <ul class="list-unstyled mb-4">

                                    @if ($our_service->lists->count() > 0)
                                        @foreach ($our_service->lists as $list)
                                            <li class="d-flex mb-2">
                                                <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                                <div>
                                                    <span class="fw-bold">{{ $list?->lang('title') }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                                <!-- Button at bottom -->

                                <div class="mt-auto">
                                    <a href="{{ route('our-service-request.index', ['id' => base64urlEncode($our_service->id)]) }}" class="btn btn-request">Request Service</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
                <p>{{ __('No services found') }}</p>
            @endif
        </div>
    </section>


    {{-- ===================================== Service secton End=================================== --}}
    {{-- ===================================== Private Sector secton End=================================== --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center privet-sector mb-5">
                <h2 class="">{{ __('Private Sector') }}</h2>
                <a href="#" class="Sector-link">{{ __('Finance') }}</a>
            </div>
    
            @if ($private_sectors->count() > 0)
            <div class="row g-4">
                <!-- Card Start -->

                @foreach ($private_sectors as $private_sector)
                <div class="col-md-4">
                    <div class="card h-100 p-4 bg-white rounded-4">
                        <div class="d-flex mb-3">
                            <img src="{{ getImage(getFilepath('private_sector') . '/' . $private_sector->image) }}" alt="Sector Icon"
                                class="img-fluid sector-icon">
                        </div>
                        <h5 class="text-center mb-4 fw-semibold">{{ $private_sector?->lang('title') }}</h5>
                        <ul class="list-unstyled ps-0">
                            @if ($private_sector->lists->count() > 0)
                                @foreach ($private_sector->lists as $list)
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="fa-solid fa-circle-check text-primary me-2 mt-1"></i>
                                        <span>{{ $list?->lang('title') }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="mt-auto">
                            <a href="{{ route('private-sector-request.index', ['id' => base64urlEncode($private_sector->id)]) }}" class="btn btn-sector">Send Request</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <p>{{ __('No private sectors found') }}</p>
            @endif
        </div>
    </section>
   
    {{-- ===================================== Private Sector secton End=================================== --}}

    @include('sections.investment_opportunities')
    @include('sections.browse_by_category')
    @include('sections.ready_to_invest')    
    @include('sections.why_finance_incubator')    
    @include('sections.what_makes_us_unique')
    @include('sections.our_financial')
    @include('sections.smart_settlement')
    @include('sections.subscribe')


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
