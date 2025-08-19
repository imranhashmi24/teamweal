@extends('web.layouts.app')

@section('panel')
    @include('web.partials.header')

    <section class="py-5 dashboard-main">
        <div class="container">
            <div class="dashboard">
                <div class="flex-wrap gap-4 dashboard-head align-items-end">
                    @include('web.partials.dashboard_header')
                </div>
                <div class="row">
                    <div class="col-12 col-lg-3 d-mobile-menu">
                        <div class="dashboard-sidnav">
                            @include('web.partials.dashboard_sidnav')
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="dashboard-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.partials.footer')
@endsection
