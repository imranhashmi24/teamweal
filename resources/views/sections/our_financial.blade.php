@php
    $financial_investments = \App\Models\FinancialInvestment::where('status', 'active')->get();
@endphp

<section class="py-5" style="background-color: #270831">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-white py-4">{{ __('Our Financial and Investment Solutions') }}</h2>
                @if ($financial_investments->count() > 0)
                    <div class="row">
                        @foreach ($financial_investments as $financial_investment)
                            <div class="col-12 col-md-6 mb-4">
                                <div class="card h-100 p-3" style="background: #370E45">
                                    <div class="card-body d-flex flex-column">
                                        <h3 class="card-title fw-bold text-white fs-5">
                                            {{ $financial_investment?->lang('title') }}</h3>
                                        <hr style="color: #A4AF00">

                                        @if ($financial_investment->lists->count() > 0)
                                            @foreach ($financial_investment->lists as $list)
                                                <p class="mb-2 d-flex align-items-center text-white fs-6">
                                                    <i class="fa-solid fa-check text-warning me-2 mt-1"></i>
                                                    <span
                                                        class="fs-6 text-white ms-2">{{ $list?->lang('title') }}</span>
                                                </p>
                                            @endforeach
                                        @endif

                                        <div class="mt-auto mt-3">
                                            <a href="{{ route('financial-investment-request.index', ['id' => base64urlEncode($financial_investment->id)]) }}"
                                                class="btn btn-request">{{ __('Request Service') }}</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="text-center at-service">
                    <h5 class="fw-bold" style="color: #A4AF00">{{ __('At Your Service') }}</h5>
                    <p>@lang('To request a consultation or access any of our financing or investment services, please fill out the Unified Application Form, and our team will contact you to support your journey toward the most suitable financing or investment opportunity')</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .at-service {
        color: #ffffff;
        border: 1px dashed #A4AF00;
        padding: 20px;
        margin-top: 50px;
    }
</style>
