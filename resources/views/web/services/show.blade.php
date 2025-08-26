@extends('web.layouts.frontend', ['title' => 'Services'])
@php
$title = $service->title;
$og_image = asset('media/images/services/' . $service->image);
@endphp

@section('content')
@include('web.services.inc.search-form')

<section class="py-5 about-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="about-images">
                    <img width="100%" src="{{ getImage(getFilePath('service') . '/' . $service->image, getFileSize('service')) ?? asset('assets/img/no-photo-available.png') }}" alt="Service Photo">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="about-content">
                    <h3 class="service-details-head">
                        {{ app()->getLocale() == 'en' ? $service->title : $service->title_ar ?? $service->title }}
                    </h3>
                    <p class="py-3">
                        {!! app()->getLocale() == 'en' ? $service->description : $service->description_ar ??
                        $service->description !!}
                    </p>
                    <h6 class="mb-5"><b>Category:</b>
                        @if ($service->category)
                        <a
                            href="{{ route('web.pages.services.index', ['category_id' => $service->category_id]) }}#services">{{
                            $service->category?->name }}
                        </a>
                        @else
                        N/A
                        @endif
                    </h6>
                    <div class="mt-3">
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <a href="{{ route('web.pages.service_requests.create', ['id' => $service->id]) }}"
                            class="custom-btn">@lang('Place Order')</a>
                        <a href="#" class="custom-btn service-btn ms-2">@lang('Contact Us')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--    SERVICE SECTION-->
<section class="py-5 service-main" id="services">
    <div class="container">
        <h5 class="mb-3 fw-bold">@lang('Popular Services')</h5>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 col-xl-3">
                <div class="service-left service-left-main">

                    @foreach ($categories as $category)
                    <a href="{{ route('web.pages.services.index', ['category_id' => $category->id]) }}#services"
                        class="{{ request('category_id') == $category->id ? 'bg-white' : '' }} px-3 text-truncate ">
                        {{ app()->getLocale() == 'en' ? $category->name : $category->name_ar ?? $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8 col-xl-9">
                <div class="service-right">
                    <div class="row justify-content-center">

                        @forelse ($services as $service)
                        <div class="mb-4 col-6 col-xl-4">
                            <div class="service-page-box main">
                                <a href="{{ route('web.pages.services.show', $service->slug) }}">
                                    <div class="service-box-image">
                                        <img height="200px" width="100%"
                                            src="{{ getImage(getFilePath('service') . '/' . $service->image, getFileSize('service')) ??  asset('assets/img/no-photo-available.png') }}"
                                            alt="Service Photo">
                                    </div>
                                    <h5 class=""
                                        title="{{ app()->getLocale() == 'en' ? $service->title : $service->title_ar ?? $service->title }}">
                                        {{ makeDotStr(app()->getLocale() == 'en' ? $service->title : $service->title_ar
                                        ?? $service->title, 25) }}
                                    </h5>
                                </a>
                                <p>
                                    {{ app()->getLocale() == 'en' ? makeDotStr($service->description, 100) :
                                    makeDotStr($service->description_ar, 100) ?? makeDotStr($service->description, 100)
                                    }}

                                </p>

                            </div>
                        </div>
                        @empty
                        @php
                        $search_query = request('search');
                        $category_name = \App\Models\Category::find(request('category_id'))?->name;
                        @endphp
                        <h5 class="mt-5 text-center">
                            {{ $search_query ? "No result found for: \"$search_query\"" : "No result found on:
                            \"$category_name\"" }}
                        </h5>
                        @endforelse

                        <div>
                            {{ $services->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--    SERVICE SECTION-->
@endsection
