@extends('web.layouts.frontend', ['title' => @$title])
@section('content')
    <section class="page-bg py-5" style="background-color: #23072D">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center ">
                        <h1 class="text-white">{{ $investment_opportunity_category?->lang('title') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach ($investment_opportunities as $investment_opportunity)
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
    </section>
@endsection

