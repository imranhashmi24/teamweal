@php
    $heroSectionContent = getContent('hero_section.content', true);
@endphp

<section class="hero-section d-flex align-items-center">
      {{-- style="background-image: url({{ getImage('assets/images/frontend/hero_section/' . @$heroSectionContent->data_values->image) }}); background-size: cover; background-position: center;"> --}}
    <div class="container">
        <div class="col-lg-8">
            <h1>{{ @$heroSectionContent->lang('title') }}</h1>
            <h2>{{ @$heroSectionContent->lang('heading') }}</h2>
            <p>
                {{ @$heroSectionContent->lang('description') }}
            </p>
            <a href="{{ route('user.register') }}" class="btn btn-custom mt-3">@lang('Create Investor Account')</a>
        </div>
    </div>
</section>


<style>
      .hero-section {
    background: #2d123f;
    /* dark purple background */
    color: #fff;
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.hero-section h1 {
    font-size: 2rem;
    font-weight: 400;
}

.hero-section h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #c3d600;
    /* lime-green text */
}

.hero-section p {
    font-size: 0.95rem;
    line-height: 1.6;
    max-width: 700px;
}

.btn-custom {
    background-color: #c3d600;
    color: #000;
    font-weight: 600;
    border-radius: 0;
    padding: 10px 20px;
    transition: 0.3s;
}

.btn-custom:hover {
    background-color: #a6b800;
    color: #fff;
}

/* Optional: subtle background network effect */


</style>