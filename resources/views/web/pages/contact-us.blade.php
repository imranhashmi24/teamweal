@php
    $title = __('Contact us')
@endphp

@extends('web.layouts.frontend',[
    'title' => $title,
])

@section('content')
    @include('partials.contact-form')
@endsection
