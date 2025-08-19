@extends('web.layouts.frontend', ['title' => 'Request'])

@php
$formNumber = 0;
if (request()->has('id')) {
    if (request()->has('type') && request('type') == 'frontend') {
        $data = App\Models\Frontend::where('id', request('id'))->firstOrFail();
    } else {
        $data = App\Models\Service::with('category')->where('id', request('id'))->first();
        
        
        if($data->category){
            $formNumber = $data->category->parent_id;
        }
    }
}
@endphp


@php
    $o_countries = App\Models\Country::orderByRaw('ISNULL(sort_order), sort_order')->with('city')->get();
    $countries = sortOrder($o_countries);
@endphp
@section('content')
    <section class="py-5 pages-banner" style="background-image: url({{ asset('assets/images/frontend/breadcrumb/65c196d169df31707185873.png') }});">
        <div class="container">
            <div class="row">
                <div class="py-5 col-12">
                    <h1 class="p-0 m-0 my-5 text-center"></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="p-0 m-0">
                        @if(request()->has('type') && request('type') == 'frontend')
                            {{ @$data->lang('title') }}

                        @else
                          {{ app()->getLocale() == "en" ? $data->title : $data->title_ar }}
                        @endif

                    </h3>
                    <p class="mt-3"> {{ app()->getLocale() == "en" ? $data->description : $data->description_ar }}  </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('services.form.submit') }}" enctype="multipart/form-data">
                        @csrf
                         <input type="hidden" class="form-control" name="service_id" value="{{ $data->id }}">
                        @if($formNumber == 1)
                           <input type="hidden" class="form-control" name="service_type" value="technical">
                           @includeIf('web.request.forms.technical')
                        @elseif($formNumber == 17)
                           <input type="hidden" class="form-control" name="service_type" value="cloud">
                           @includeIf('web.request.forms.cloud')
                        @elseif($formNumber == 23)
                           <input type="hidden" class="form-control" name="service_type" value="ai">
                           @includeIf('web.request.forms.ai')
                        @elseif($formNumber == 25)
                        <input type="hidden" class="form-control" name="service_type" value="coding">
                           @includeIf('web.request.forms.coding')
                        @elseif($formNumber == 36)
                        <input type="hidden" class="form-control" name="service_type" value="cybersecurity">
                           @includeIf('web.request.forms.cybersecurity')
                        @elseif($formNumber == 46)
                        <input type="hidden" class="form-control" name="service_type" value="data-analytics">
                           @includeIf('web.request.forms.data-analytics')
                        @else
                           <input type="hidden" class="form-control" name="service_type" value="cloud">
                           @includeIf('web.request.forms.cloud')
                        @endif
                        
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
