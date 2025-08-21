@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
    @include('sections.digital_marketing')
    @include('sections.embedded_finance')
    @include('sections.embedded_finance_product_solutions')


    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="sectore_category pb-3">
                        <h2 class="fw-bold text-center" style="color: #0069CA">Sector</h2>
                   
                    </div>
                    <div class="row justify-content-center">
                        @for ($i = 0; $i < 14; $i++)
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="card h-100 p-3 bg-white">
                                    <img src="{{ asset('assets/web/img/sector-card.png') }}" class="card-img-top img-fluid"
                                        alt="...">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold text-center">Digital apps & innovative platforms</h6>

                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
    </section>
@endsection
