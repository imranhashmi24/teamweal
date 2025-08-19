@php
$title = __('About Us');
@endphp

@extends('web.layouts.frontend', ['title' => $title])

@section('content')


    @include('sections.about_section')

    @php
        $visionAndMissionContent = getContent('our_vision_and_mission.content', true);
        $ourMessageContent = getContent('our_message.content', true);
    @endphp

    <!-- Mission vission start -->
    <section class="py-5 mission-vission mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-2 mission-bg">
                    <img src="{{ getImage('assets/images/frontend/our_vision_and_mission/' . @$visionAndMissionContent->data_values->vision) }}" alt="">
                </div>
                <div class="col-12 col-md-4">
                    <h4>{{ @$visionAndMissionContent->lang('vision_title') }}</h4>
                    <p>{!! @$visionAndMissionContent->lang('vision_text') !!}</p>
                </div>
                <div class="mt-3 col-12 col-md-2 mission-bg mt-md-0 vission-img">
                    <img src="{{ getImage('assets/images/frontend/our_message/' . @$ourMessageContent->data_values->message) }}" alt="">
                </div>
                <div class="mt-3 col-12 col-md-4 mt-md-0">
                    <h4>{{ @$ourMessageContent->lang('message_title') }}</h4>
                    <p>{!! @$ourMessageContent->lang('message_text') !!}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Mission vission end -->

    <!-- Our goals start -->




@endsection


@push('style')
<style>

.small-line {
    width: 50px;
    height: 1px;
    display: inline-block;
    background-color: #444444;
}


/* About section start  */
.about-section {
    background: #f2f2f2;
}

.about-section .header-content h4 {
    font-size: 30px;
    line-height: 38px;
    letter-spacing: 0.5em;
    text-transform: uppercase;
    color: #452e7e;
}

.about-section .header-content p {
    font-size: 20px;
    line-height: 30px;
    color: #555555;
}

.about-section .content h4 {
    margin-bottom: 15px;
    font-size: 30px;
    line-height: 40px;
    color: #555555;
}

.about-section .content p {
    font-size: 16px;
    line-height: 28px;
    color: #666666;
}

.mission-vission .mission-bg {
    width: 150px;
    height: 150px;
    background: #39004E !important;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mission-vission .mission-bg img {
    width: 80px;
    height: 80px;
}

@media screen and (max-width: 767px) {

    .mission-vission h4{
        text-align: center;
    }

    .mission-vission .mission-bg {
        width: 100px;
        height: 100px;
        background: #f2f2f2;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .mission-vission .mission-bg img {
        width: 100px;
        height: 100px;
    }
}

.mission-vission h4 {
    margin-top: 15px;
    font-size: 30px;
    line-height: 38px;
    color: #555555;
}

.mission-vission p {
    font-size: 16px;
    line-height: 24px;
    color: #787878;
}

/* Our goals part start */

.our-goals h2 {
    font-size: 30px;
    line-height: 60px;
    text-align: center;
    letter-spacing: 0.5em;
    text-transform: uppercase;
    color: #452e7e;
    margin-bottom: 0;
}

.our-goals h3 {
    font-size: 30px;
    text-align: center;
    text-transform: uppercase;
    color: #452e7e;
    margin-bottom: 0;
}

.our-goals .content {
    position: relative;
    margin-left: 38px;
}

.our-goals .content p {
    color: #787878;
}

.our-goals .content:hover p {
    color: #555555;
}

.our-goals .content img {
    position: absolute;
    top: 5px;
    left: -35px;
    width: 17px;
}

/* About page start */
</style>
@endpush
