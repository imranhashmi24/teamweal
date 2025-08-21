@php
    $MarketingElements = getContent('marketing.element', null, false, true);
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($MarketingElements as $MarketingElement)
                <div class="col-12 col-md-6 col-lg-3 mb-3">
                    <div class="card h-100 p-3 bg-white">
                        <img src="{{ getImage('assets/images/frontend/marketing/' . @$MarketingElement->data_values->image) }}"
                        alt="Marketing" class="img-fluid">
                        <div class="card-text pt-3">
                            <h6 class="card-title fw-bold text-center mb-0">{{ @$MarketingElement?->lang('title') }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
