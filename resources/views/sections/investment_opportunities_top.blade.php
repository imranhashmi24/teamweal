@php
    $investment_opportunities_topContent = getContent('investment_opportunities_top.content', true);
@endphp

<section class="py-5 fintech-section">
    <div class="container">
        <div class="row align-items-center g-4">
        
            <!-- Text Content -->
            <div class="col-12 col-md-6">
                <h2 class="mb-3 fw-bold">
                  {{ @$investment_opportunities_topContent?->lang('heading') }}
                </h2>
                <p class="text-muted fs-5">
                   {{ @$investment_opportunities_topContent?->lang('title') }}
                </p>
                
            </div>
            <!-- Image -->
            <div class="col-12 col-md-6 text-center">
                <img src="{{ getImage('assets/images/frontend/investment_opportunities_top/' . @$investment_opportunities_topContent?->data_values?->image, '600x400') }}" 
                     class="img-fluid rounded shadow-sm"
                     alt="{{ @$investment_opportunities_topContent?->lang('title') }}">
            </div>

        </div>
    </div>
</section>


<style>
      .fintech-section {
    background: linear-gradient(135deg, #f8f9fa, #ffffff);
}

.fintech-section h2 {

    font-size: 2rem
}

.fintech-section img {
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.fintech-section img:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.fintech-section p {
    line-height: 1.5;
}

</style>
