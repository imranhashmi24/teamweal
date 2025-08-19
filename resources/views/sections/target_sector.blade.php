@php
    $targetContent = getContent('target_sector.content', true);
    $targetElements = getContent('target_sector.element', null, false, true);
@endphp


<section class="traning-section py-5">
    <div class="container">
        <div class="section-title text-center">
            <h6 class="text-white"> {{ $targetContent->lang('heading') }} </h6>
            <h2 class="after-line-white text-white text-capitalize">
                {{ $targetContent->lang('sub_heading') }}
            </h2>
        </div>

        <div class="row mt-5">
            @foreach ($targetElements as $targetElement)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-4">
                    <div class="traning-box">
                        <img src="{{ getImage('assets/images/frontend/target_sector/' . @$targetElement->data_values->image) }}"
                            alt="Traning image">
                        <div class="traning-text p-2">
                            <a href="javascript:void(0)">
                                {{ $targetElement->lang('title') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('style')
    <style>
        .traning-section {
            background: #353535;
        }

        .traning-box {
            background: #515050;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
        }

        .traning-box .traning-text span {
            font-weight: 400;
            font-size: 12px;
            line-height: 16px;
            color: var(--wc);
        }

        .traning-box .traning-text a {
            font-weight: 700;
            font-size: 18px;
            text-decoration: none;
            line-height: 27px;
            color: var(--wc);
            margin: 0;
            padding-top: 10px;
            display: block;
            text-align: center;
        }

        .traning-box img {
            width: 100%;
        }
    </style>
@endpush
