@extends('web.layouts.frontend', ['title' => @$title])
@section('content')

   @php
       $sectors = \App\Models\Sector::where('type', 'default')->where('status', 'active')->get();
   @endphp

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="sectore_category pb-3">
                        <h3 class="fw-bold" style="color: #0069CA">{{ __('Startups & Small Enterprises') }}</h3>
                        <p><small>{{ __('Sectors we are proud to serve') }}</small></p>
                    </div>
                    <div class="row">
                        @foreach ($sectors as $sector)
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="card h-100 p-3 bg-white">
                                    <img src="{{ getImage(getFilepath('sector') . '/' . $sector->image) }}" class="card-img-top img-fluid"
                                        alt="...">
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

    @php
        $private_sectors = \App\Models\Sector::where('type', 'private')->where('status', 'active')->get();
    @endphp


    <section class="py-5 ">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="row justify-content-center">
                        @foreach ($private_sectors as $sector)
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="card h-100  bg-white">
                                    <img src="{{ getImage(getFilepath('sector') . '/' . $sector->image) }}" class="card-img-top img-fluid"
                                        alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $sector?->lang('title') }}</h5>
                                        <p class="text-justify" style="font-size: 14px;">{{ $sector?->lang('description') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
@endsection
