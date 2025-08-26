@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
    <section class="py-5"
        style="background-image: url('{{ asset('assets/web/img/Common-banner.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white text-center fw-bold">{{ __('Smart Collection & Settlement Solutions') }}</h2>
                </div>
            </div>
        </div>
    </section>

    @include('sections.smart_collection')
    @include('sections.services_offered')
    @include('sections.who_can_benefit')
@endsection
