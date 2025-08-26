@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
<section class="py-5"
style="background-image: url('{{ asset('assets/web/img/Common-banner.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
<div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center ">
                        <h1 class="text-white">{{ __('Investment Opportunities') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('sections.investment_opportunities_top')


    @php
        $investment_opportunity_categories = \App\Models\InvestmentOpportunityCategory::where('status', 'active')->get();
    @endphp

    <section class="py-5 bg-light">
        <div class="container">

            @foreach ($investment_opportunity_categories as $investment_opportunity_category)
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="sectore_category d-flex justify-content-between align-items-center py-4">
                        <h3 class="fw-bold" style="color: #0069CA">{{ $investment_opportunity_category?->lang('title') }}</h3>
                        <a href="{{ route('web.pages.investment-opportunity.view', ['id' => base64urlEncode($investment_opportunity_category->id)]) }}" class="btn btn-primary">{{ __('View All') }}</a>
                    </div>
                    <div class="row">
                        @foreach ($investment_opportunity_category->investmentOpportunities as $investment_opportunity)
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="card h-100 p-3 bg-white">
                                    <img src="{{ getImage(getFilepath('investment_opportunity') . '/' . $investment_opportunity->image) }}" class="card-img-top img-fluid"
                                        alt="{{ $investment_opportunity?->lang('title') }}">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold text-center">{{ $investment_opportunity?->lang('title') }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
    </section>



    @include('sections.ready_to_invest')
@endsection

