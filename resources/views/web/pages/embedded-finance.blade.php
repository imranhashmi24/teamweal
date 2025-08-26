@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
    <section class="py-5"
        style="background-image: url('{{ asset('assets/web/img/Common-banner.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white text-center fw-bold">{{ __('Embedded Finance') }}</h2>
                </div>
            </div>
        </div>
    </section>


    @include('sections.digital_marketing')
    @include('sections.embedded_finance')
    @include('sections.embedded_finance_product_solutions')


    @php
        $sectors = \App\Models\Sector::where('type', 'financial')->where('status', 'active')->get();
    @endphp


    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="sectore_category pb-3">
                        <h2 class="fw-bold text-center" style="color: #0069CA">{{ __('Sector') }}</h2>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($sectors as $sector)
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="card h-100 p-3 bg-white">
                                    <img src="{{ getImage(getFilepath('sector') . '/' . $sector->image) }}"
                                        class="card-img-top img-fluid" alt="{{ $sector?->lang('title') }}">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold text-center">{{ $sector?->lang('title') }}</h6>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
@endsection
