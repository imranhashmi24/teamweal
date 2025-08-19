@php
    $bannerElements = getContent('banner.element', null, false, true);
@endphp

<section class="py-3 py-lg-5">
    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach(@$bannerElements as  $key=>$bannerElement)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                    <div class="p-4 rounded h-100 w-100 d-flex align-items-center justify-content-center"
                            style="position: absolute; color:white;">
                        <div class="text-center p-lg-5 ms-lg-5">
                            {{-- <h1 class="fw-bold banner-title">{{ @$bannerElement->lang('title') }}</h3>
                            <p class="py-2 fs-5 banner-text">{!! @$bannerElement->lang('description') !!}</p> --}}
                        </div>
                    </div>
                    <img src="{{ getImage('assets/images/frontend/banner/' . @$bannerElement->lang('slider'), '1350x360') }}"
                        class="d-block w-100 s-img" alt="Slider Image">
                </div>
                @endforeach
            </div>

            @if(@$bannerElements->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
            @endif
        </div>
    </div>
</section>


@push('style')
    <style>
        @media only screen and (max-width: 570px) {
            .banner-title{
                font-size: 18px !important;
            }
            .banner-text{
                font-size: 12px !important;
            }
            .s-img{
                height: 200px !important;
            }
        }
    </style>
@endpush
