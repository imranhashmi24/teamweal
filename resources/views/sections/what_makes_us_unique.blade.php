@php
    $whatMakesUsUniqueContent = getContent('what_makes_us_unique.content', true);
    $whatMakesUsUniqueElements = getContent('what_makes_us_unique.element', null, false, true);
@endphp

<section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="what_make_head">
                    <h2 class="mb-3 fw-bold">{{ $whatMakesUsUniqueContent->lang('title') }}</h2>
                </div>
                <div class="row">
                    @foreach ($whatMakesUsUniqueElements as $element)
                        <div class="col-12 col-md-6 mb-3">
                            <div class="make-item h-100">
                                <img src="{{ getImage('assets/images/frontend/what_makes_us_unique/' . @$element->data_values->image) }}"
                                    alt="What Makes Us Unique" class="img-fluid">
                                <p>{{ $element->lang('title') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="top-img">
                    <img src="{{ getImage('assets/images/frontend/what_makes_us_unique/' . @$whatMakesUsUniqueContent->data_values->image_left) }}"
                        alt="What Makes Us Unique" class="img-fluid">

                    <div class="left-img">
                        <img src="{{ getImage('assets/images/frontend/what_makes_us_unique/' . @$whatMakesUsUniqueContent->data_values->image_right) }}"
                            alt="What Makes Us Unique" class="img-fluid">
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .make-item {
        border: 1px solid #CCCCCC;
        padding: 15px;
        border-radius: 8px
    }


    .make-item img {
        height: 40px;
        width: 40px;
        padding: 10px;
        background: #F3E8FF;
        border-radius: 50%;
        margin-bottom: 10px;

    }

    .top-img {
        position: relative;
    }

    .left-img {
        position: absolute;
        bottom: -136px;
        right: -75px;
        border: 5px solid #ffffff;
        border-radius: 15px;
    }
</style>
