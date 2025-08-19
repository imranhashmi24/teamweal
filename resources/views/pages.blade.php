@extends('web.layouts.frontend',['title'=>@$title])

@section('content')


@include('sections.breadcrumb', ['title' => @$title])



    @if($sections != null)
        @foreach(json_decode($sections) as $sec)
            @include('sections.'.$sec)
        @endforeach
    @endif
@endsection
