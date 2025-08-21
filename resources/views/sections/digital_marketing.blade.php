@php
      $digitalMarketingElements = getContent('digital_marketing.element', null, false, true);
@endphp

<section class="py-4 bg-light">
      <div class="container">
            <div class="row g-3">
                  @foreach($digitalMarketingElements as $key => $digitalMarketingElement)
                        <div class="col-12 col-md-6">
                              <div class="digital-market h-100 {{ $key % 2 == 0 ? 'border-purple bg-light-purple' : 'border-blue bg-light-blue' }}">
                                    <p class="mb-0 text-justify">
                                          {{ @$digitalMarketingElement->lang('title') }}
                                    </p>
                              </div>
                        </div>
                  @endforeach
            </div>
      </div>
</section>

<style>
      .digital-market {
            border: 1px solid;
            border-radius: 10px;
            padding: 15px 20px;
            font-size: 15px;
            line-height: 1.6;
            height: 100%;
      }
      .border-purple { border-color: #7F00FF; }
      .bg-light-purple { background-color: #f9f5ff; }

      .border-blue { border-color: #007BFF; }
      .bg-light-blue { background-color: #f3f9ff; }

      .text-justify { text-align: justify; }
</style>
