@extends('web.layouts.frontend', [
    'title' => 'Request',
])
@php
if (request()->has('id')) {
    $service = \App\Models\Service::findOrFail(request('id'));
}

$user = auth()->user();
@endphp

@push('css')
    <style>
        #service_request_form select {
            padding: 12px 10px
        }
    </style>
@endpush

@section('content')
    <!--    SHOP FORM SECTION-->
    <section class="py-5 shop-form-section request">
        <div class="container">
            <div class="shop-form-box">
                <div class="shop-form-head">
                    <h6>@lang('Opportunity Submission Form')</h6>
                </div>
                <div class="contact-form shop-form">
                    @isset($service)
                        <p class="mb-3 text-center">@lang('Reference Service'):
                            <a class="fw-bold" href="{{ route('web.pages.services.show', request('id')) }}">
                                {{ app()->getLocale() == 'en' ? $service->title : $service->title_ar ?? $service->title }}
                            </a>
                        </p>
                    @endisset
                    <form id="service_request_form" action="{{ route('web.pages.service_requests.create') }}" method="post"
                          class="validate">
                        @csrf

                        <input type="hidden" value="{{ request('id') }}" name="service_id">

                        @include('components.errors')

                        <div class="row">
                            <div class="mb-2 col-md-6">
                                <lable for="name">@lang('Contact Name')*</lable>
                                <input id="name" type="text" name="name" value="{{ $user?->name }}" required>

                            </div>
                            <div class="mb-2 col-md-6">
                                <lable>@lang('Phone Number')*</lable>
                                <input type="number" minlength="10" maxlength="15" name="contact" required>

                            </div>
                            <div class="mb-2 col-md-6">
                                <lable for="email">@lang('Email')*</lable>
                                <input type="email" name="email" id="email" value="{{ $user?->email }}" class="text-start"
                                       required>

                            </div>

                            <div class="mb-2 col-md-6">
                                <lable>@lang('Company Name')*</lable>
                                <input type="text" name="company_name" minlength="3" required>

                            </div>

                            <div class="mb-2 col-md-6">
                                <lable>@lang('Budget')</lable>
                                <input type="text" id="budget" name="budget" required>

                            </div>



                            <div class="mb-2 col-md-6">
                                <lable>@lang('Nature of the project')</lable>
                                <select name="nature_of_project" class="form-control" required>
                                    <option value="">@lang('Select an option')</option>
                                    <option>@lang('New project')</option>
                                    <option>@lang('Develop and expand an existing project')</option>
                                </select>

                            </div>

                            <div class="mb-2 col-md-12">
                                <lable>@lang('The project location')</lable>
                                <input type="text" name="project_location" required>

                            </div>

                            <div class="mb-2 col-md-12">
                                <lable>@lang('Previous experience of the investor in the project field')</lable>
                                <select name="previous_experience" class="form-control" required>
                                    <option value="">@lang('Select an option')</option>
                                    <option value="{{ __('Great experience') }}">@lang('Great experience')</option>
                                    <option value="{{ __('Intermediate experience') }}">@lang('Intermediate experience')</option>
                                    <option value="{{ __('Simple experience') }}">@lang('Simple experience')</option>
                                    <option value="{{ __('There is no previous experience with the project') }}">@lang('There is no previous experience with the project')</option>
                                </select>

                            </div>

                            <div class="mb-2 col-md-6">
                                <lable>@lang('The aim of the study work')</lable>
                                <select name="aim" class="form-control" required>
                                    <option value="">@lang('Select an option')</option>
                                    <option value="{{ __('Estimating the projects market share') }}">@lang('Estimating the projects market share')</option>
                                    <option value="{{ __('Making the decision to implement the project') }}">@lang('Making the decision to implement the project')</option>
                                    <option value="{{ __('Finance') }}">@lang('Finance')</option>
                                    <option value="{{ __('Required for a government agency') }}">@lang('Required for a government agency')</option>
                                    <option value="{{ __('Other') }}">@lang('Other')</option>
                                </select>

                            </div>
                            <div class="mb-2 col-md-6">
                                <lable>@lang('Total expected investment cost')</lable>
                                <select name="investment_cost" class="form-control" required>
                                    <option value="">@lang('Select an option')</option>
                                    <option value="{{ __('Less than a million riyals') }}">@lang('Less than a million riyals')</option>
                                    <option value="{{ __('From 1 million to 5 million riyals') }}">@lang('From 1 million to 5 million riyals')</option>
                                    <option value="{{ __('From 5 to 10 million') }}">@lang('From 5 to 10 million')</option>
                                    <option value="{{ __('Furthermore') }}">@lang('Furthermore')</option>
                                    <option value="{{ __('Less than a million riyals') }}">@lang('Less than a million riyals')</option>
                                </select>

                            </div>
                            <div class="mb-2 col-md-6">
                                <lable>@lang('Nature of financing')</lable>
                                <select name="nature_of_finance" class="form-control" required>
                                    <option value="">@lang('Select an option')</option>
                                    <option value="{{ __('Fully self-financing') }}">@lang('Fully self-financing')</option>
                                    <option value="{{ __('Funding from government development funds') }}">@lang('Funding from government development funds')</option>
                                    <option value="{{ __('Financing from commercial banks') }}">@lang('Financing from commercial banks')</option>
                                </select>

                            </div>
                            <div class="mb-2 col-md-6">
                                <lable>@lang('Existing project equipment')</lable>
                                <select name="project_equipment" class="form-control" required>
                                    <option value="">@lang('Select an option')</option>
                                    <option value="{{ __('Equipment and supplies quotations') }}">@lang('Equipment and supplies quotations')</option>
                                    <option value="{{ __('Quotations for materials and services required') }}">@lang('Quotations for materials and services required')</option>
                                    <option value="{{ __('All offers are available') }}">@lang('All offers are available')</option>
                                    <option value="{{ __('There are no bids') }}">@lang('There are no bids')</option>
                                </select>

                            </div>

                            {{-- <div class="mb-2 col-md-6">
                                    <lable for="description">@lang('Project Description')</lable>
                                    <textarea name="description" id="description" required></textarea>

                                </div> --}}
                            <div class="pt-3 text-center">
                                <button type="submit" class="btn btn-primary">@lang('Submit Opportunity')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--    SHOP FORM SECTION END-->
@endsection

@push('script')
@include('partials.validate')
@endpush

