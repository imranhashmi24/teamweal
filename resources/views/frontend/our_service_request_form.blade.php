@extends('web.layouts.frontend', ['title' => 'Request Form'])

@php
    $o_countries = App\Models\Country::orderByRaw('ISNULL(sort_order), sort_order')->with('city')->get();
    $countries = sortOrder($o_countries);
@endphp
@section('content')

    <section class="py-5 pages-banner"  style="background-image: url('{{ asset('assets/web/img/Common-banner.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="py-5 col-12">
                    <div class="section-title">
                        <h2 class="text-center text-white">{{ $title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-form">
                        <h5>{{ $title }}</h5>
                    </div>
                </div>
                <div class="col-12">

                    <form method="POST" action="{{ route($route) }}" enctype="multipart/form-data">
                       @csrf
                       <input type="hidden" name="service_id" value="{{ $service_id }}">
                       <input type="hidden" name="type" value="{{ $type }}">
                       @php
                           echo getForm($service_id, $model, $field);
                       @endphp

                       <button type="submit" class="btn btn-primary submit-btn">{{ __('Submit Request') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection


@push('script')
    <script>
        $('[name=country_id]').on('change', function() {
            var cities = $(this).find('option:selected').data('cities');
            var option = [`<option value="">@lang('Select One')</option>`];
            $.each(cities, function(index, value) {
                var name = "{{ app()->getLocale() }}" == 'en' ? value.name : value.name_ar;

                option += "<option value='" + value.id + "' " + (value.id == "" ? "selected" : "") + ">" +
                    name + "</option>";
            });
            $('select[name=city_id]').html(option);
        }).change();
    </script>
@endpush


@push('style')
    <style>
    
        .section-title-form {
            text-align: center;
            padding-top: 0.5rem;
            padding-bottom: 0.2rem;
            font-size: 1rem;
            font-weight: 600;
            background-color: #0D47A1 !important;
            color: #fff;
            margin-bottom: 2rem;
        }

        .submit-btn {
            margin-top: 2rem;
            padding: 0.5rem 2rem;
            background-color: #0D47A1 !important;
            color: #fff;
            border-radius: 0;
        }
    </style>
@endpush

