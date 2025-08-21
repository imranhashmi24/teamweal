@php
    $whoCanBenefitContent = getContent('who_can_benefit.content', true);
    $whoCanBenefitElements = getContent('who_can_benefit.element', null, false, true);
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-4">
            <!-- Left Content -->
            <div class="col-12 col-md-6">
                <div class="embedded-content mb-4">
                    <h2 class="fw-bold">
                        {{ @$whoCanBenefitContent?->lang('title') }}
                    </h2>
                    <p class="text-muted">
                        {{ @$whoCanBenefitContent?->lang('sub_title') }}
                    </p>
                </div>
                <div class="embede-item">
                    @foreach ($whoCanBenefitElements as $whoCanBenefitElement)
                        <div class="embed-box d-flex align-items-center mb-2">
                            <p class="mb-0 fw-semibold">
                                {{ @$whoCanBenefitElement?->lang('title') }}
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="row align-items-center g-3 py-">
                  <!-- Button -->
                  <div class="col-12 col-md-4 text-center text-md-end">
                      <a href="#" class="btn btn-primary btn-lg">
                          @lang('Request Service')
                      </a>
                  </div>
      
                  <!-- Confidentiality Note -->
                  <div class="col-12 col-md-8 text-center text-md-start">
                      <div class="text-muted small d-flex align-items-center justify-content-center justify-content-md-start">
                          <i class="fa-solid fa-question-circle me-2"></i>
                          <span>@lang('We handled with complete confidentiality and professionalism')</span>
                      </div>
                  </div>
              </div>
              

            </div>

            <!-- Right Image -->
            <div class="col-12 col-md-6 text-center">
                <div class="embedded-img">
                    <img src="{{ getImage('assets/images/frontend/who_can_benefit/' . @$whoCanBenefitContent->data_values->image) }}"
                        alt="Who Can Benefit Content" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .embed-box {
        background: #E9F5FF;
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
