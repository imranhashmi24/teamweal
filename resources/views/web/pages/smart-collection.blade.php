@extends('web.layouts.frontend', ['title' => @$title])
@section('content')


@include('sections.smart_collection')
@include('sections.services_offered')
@include('sections.who_can_benefit')

    
@endsection
