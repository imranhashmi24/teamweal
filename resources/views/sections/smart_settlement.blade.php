@php
    $smartSettlementContent = getContent('smart_settlement.content', true);
    $smartSettlementElements = getContent('smart_settlement.element', null, false, true);
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- Left Image -->
            <div class="col-12 col-md-6 mb-4 mb-md-0 text-center">
                <div class="top-img d-inline-block">
                    <img src="{{ getImage('assets/images/frontend/smart_settlement/' . @$smartSettlementContent->data_values->image_left) }}"
                        alt="Smart Settlement" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-12 col-md-6">
                <div class="what_make_head mb-4">
                    <h2 class="fw-bold mb-3">{{ $smartSettlementContent->lang('title') }}</h2>
                    <p class="text-muted">{{ @$smartSettlementContent->lang('sub_title') }}</p>
                    <h6 class="fw-bold mt-3">{{ @$smartSettlementContent->lang('heading') }}</h6>
                </div>

                <!-- Features List -->
                <div class="row g-2 mb-4">
                    @foreach ($smartSettlementElements as $element)
                        <div class="col-12">
                            <div class="make-item d-flex align-items-center p-3 shadow-sm bg-white rounded-3 transition">
                                <span class="check-icon me-3">
                                    <i class="fa-solid fa-circle-check"></i>
                                </span>
                                <p class="mb-0 fw-medium">{{ @$element->lang('title') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Button + Caption -->
                <div class="settlement-button mt-3 d-flex align-items-center">
                    <a href="#" class="btn btn-primary btn-lg ">Settlement Request Now</a>
                    <p class="mt-2 small text-muted ms-2">with complete privacy and high efficiency</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .make-item {
        transition: all 0.3s ease-in-out;
    }

    .make-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .check-icon {
        color: #4CAF50; /* green check */
        font-size: 20px;
    }

    .settlement-button .btn {
        transition: all 0.3s ease-in-out;
    }

    .settlement-button .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
    }

    .top-img img {
        border-radius: 16px;
    }
</style>
