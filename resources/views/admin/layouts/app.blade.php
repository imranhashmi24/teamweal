@extends('admin.layouts.master')

@section('content')

    @include('admin.partials.topnav')

    @include('admin.partials.sidenav')

    <main class="page-content">
         @stack('breadcrumb-plugins')
        @yield('panel')
    </main>
    
@endsection
