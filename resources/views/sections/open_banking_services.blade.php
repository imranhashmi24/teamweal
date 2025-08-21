@php
    $openBankingServicesContent = getContent('open_banking_services.content', true);
@endphp

<section class="investment-section py-5">
    <div class="container">
        <div class="row align-items-center g-4">

            <!-- Text -->
            <div class="col-12 col-md-6">
                <div class="investment-text">
                    <h2 class="fw-bold mb-3">
                        {{ @$openBankingServicesContent->lang('title') }}
                    </h2>
                    <p class="text-muted mb-4">
                        {{ @$openBankingServicesContent->lang('sub_title') }}
                    </p>

                </div>
            </div>

            <!-- Image -->
            <div class="col-12 col-md-6 text-center">
                <div class="investment-image">
                    <img src="{{ getImage('assets/images/frontend/open_banking_services/' . @$openBankingServicesContent->data_values->image) }}"
                        alt="Open Banking Services" class="img-fluid">
                </div>
            </div>

        </div>
    </div>
</section>

<style>

    .investment-text h2 {
        font-size: 2rem;
        line-height: 1.3;
    }

    .investment-text p {
        font-size: 1rem;
        color: #555;
    }
</style>
