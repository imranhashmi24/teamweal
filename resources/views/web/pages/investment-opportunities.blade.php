@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
    <section class="page-bg py-5" style="background-color: #23072D">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center ">
                        <h1 class="text-white">Investment Opportunities</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('sections.investment_opportunities_top')

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="sectore_category d-flex justify-content-between align-items-center py-4">
                        <h3 class="fw-bold" style="color: #0069CA">Startups & Small Enterprises</h3>
                        <button class="btn btn-primary">View All</button>
                    </div>
                    <div class="row">
                        @for ($i = 0; $i < 4; $i++)
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
                <div class="col-12 mb-4">
                    <div class="sectore_category d-flex justify-content-between align-items-center py-4">
                        <h3 class="fw-bold" style="color: #0069CA">Startups & Small Enterprises</h3>
                        <button class="btn btn-primary">View All</button>
                    </div>
                    <div class="row">
                        @for ($i = 0; $i < 4; $i++)
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



    @include('sections.ready_to_invest')
@endsection

{{-- <style>
.page-bg{
      background-image: url({{ asset('assets/web/img/page-bg.jpg') }});
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
}
</style> --}}
