
@extends('web.layouts.frontend', ['title' => Str::title($category_name . ' Services')])
@php
    $search_query = request('search');
    $category_name = \App\Models\Category::find(request('category_id'))?->name;
@endphp

@section('content')
@include('sections.breadcrumb')
 <!--    SERVICE SECTION-->
 <section class="py-5 service-main" id="services">
    <div class="container">
        <div class="my-2 text-end">
            <button class="btn btn-primary d-lg-none" type="button" onclick="toggleCategories()"><i class="fa fa-solid fa-list"></i>
                @lang('All Categories')</button>
            @push('js')
                <script>
                    function toggleCategories() {
                        $('#categories_list').slideToggle()
                    }
                </script>
            @endpush
        </div>
        <div class="row">
            <div id="categories_list" class="col-lg-3 d-lg-block" style="display: none">
                <div class="service-left service-left-main">
                    @foreach ($categories as $category)
                        <a href="{{ route('web.pages.services.index', ['category_id' => $category->id]) }}#services"
                           class="{{ request('category_id') == $category->id ? 'bg-white fw-bold' : '' }} px-3 text-truncate ">
                            {{ app()->getLocale() == 'en' ? $category->name : $category->name_ar ?? $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="service-right">
                    <div class="row justify-content-center">
                        @forelse ($services as $service)
                            <div class="mb-4 col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3" style="max-width: 350px">
                                @include('web.component.single-service')
                            </div>
                        @empty
                            <h5 class="mt-5 text-center">
                                <img data-src="{{ asset('assets/img/empty.png') }}" style="opacity: 0.2" alt="">
                            </h5>
                        @endforelse

                        <div class="d-none d-md-block">
                            {{ $services->links() }}
                        </div>
                        <div class="d-md-none">
                            {{ $services->links('pagination::simple-bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--    SERVICE SECTION-->
@endsection
