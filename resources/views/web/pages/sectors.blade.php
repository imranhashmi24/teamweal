@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="sectore_category pb-3">
                        <h3 class="fw-bold" style="color: #0069CA">Startups & Small Enterprises</h3>
                        <p><small>Sectors we are proud to serve</small></p>
                    </div>
                    <div class="row">
                        @for ($i = 0; $i < 12; $i++)
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




    <section class="py-5 ">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="sectore_category pb-3">
                        <h3 class="fw-bold" style="color: #0069CA">Startups & Small Enterprises</h3>
                        <p><small>Sectors we are proud to serve</small></p>
                    </div>
                    <div class="row justify-content-center">
                        @for ($i = 0; $i < 15; $i++)
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="card h-100  bg-white">
                                    <img src="{{ asset('assets/web/img/sector-card.png') }}" class="card-img-top img-fluid"
                                        alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Digital apps & innovative platforms</h5>
                                        <p class="text-justify" style="font-size: 14px;">The Social Development Bank provides financing and non-financial services to
                                            micro-projects, associations, and civil society institutions, and loans to
                                            emerging enterprises, in addition to providing social financing for people with
                                            limited income. The bank also works to provide technical and administrative
                                            services, and encourage savings for individuals and institutions in the Kingdom.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
    </section>
@endsection
