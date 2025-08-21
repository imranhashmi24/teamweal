@php
    $EmbeddedFinanceContent = getContent('embedded_finance.content', true);
    $EmbeddedFinanceElements = getContent('embedded_finance.element', null, false, true);
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-4">
            <!-- Left Content -->
            <div class="col-12 col-md-6">
                <div class="embedded-content mb-4">
                    <h2 class="fw-bold mb-3">
                        {{ @$EmbeddedFinanceContent?->lang('title') }}
                    </h2>
                    <p class="text-muted">
                        {{ @$EmbeddedFinanceContent?->lang('sub_title') }}
                    </p>
                </div>

                <div class="embede-item">
                    @foreach ($EmbeddedFinanceElements as $EmbeddedFinanceElement)
                        <div class="embed-box d-flex align-items-center mb-2">
                            <p class="mb-0 fw-semibold">
                                {{ @$EmbeddedFinanceElement?->lang('title') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Image -->
            <div class="col-12 col-md-6 text-center">
                <div class="embedded-img">
                    <img src="{{ getImage('assets/images/frontend/embedded_finance/' . @$EmbeddedFinanceContent->data_values->image) }}"
                        alt="Embedded Finance Content" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .embed-box {
        background: #FEFFED;
        border: 1px solid #e0e6f1;
        padding: 10px 12px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .embed-box:hover {
        background: #f5faff;
        box-shadow: 0 4px 12px rgba(0, 105, 202, 0.1);
        transform: translateY(-2px);
    }


</style>
