@extends('web.layouts.frontend',[
    'title' => __('Success'),
])

@section('content')
<section class="py-5 message">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center col-11 col-sm-7 col-md-6">
                <div class="p-3 shadow p-md-4 p-lg-5">
                    <h2 class="text-success">@lang('Success')!</h2>
                    <h4 class="font-weight-bold">@lang('Your request is been received and we will contact you shortly')</h4>
                    <a class="mt-2 custom-btn" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> @lang('Back To Home')</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
