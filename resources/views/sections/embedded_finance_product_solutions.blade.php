@php
    $EmbeddedSolutionsElements = getContent('embedded_finance_product_solutions.element', null, false, true);
@endphp

<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="fw-bold text-primary">
                    @lang('Embedded Financial Product Solutions')
                </h1>
                <p class="text-muted mt-2">
                    @lang('Explore our innovative solutions designed to integrate seamlessly into your business.')
                </p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($EmbeddedSolutionsElements as $EmbeddedSolutionsElement)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="solution-card bg-light p-4 h-100">
                        <h5 class="fw-semibold mb-3">
                            {{ $EmbeddedSolutionsElement?->lang('title') }}
                        </h5>
                        <p class="text-muted small mb-0 " style="font-size: 16px;">
                            {{ $EmbeddedSolutionsElement?->lang('sub_title') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .solution-card {
        background: #fff;
        border: 1px solid #e5e9f2;
        border-radius: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .solution-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 105, 202, 0.15);
        border-color: #0069CA;
    }

    .solution-card .icon-box {
        width: 60px;
        height: 60px;
        margin: 0 auto;
        border-radius: 50%;
        background: #f0f7ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #0069CA;
    }
</style>
