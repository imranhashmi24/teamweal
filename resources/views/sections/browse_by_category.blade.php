
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">@lang('Browse by Category')</h2>
            </div>
            
            @foreach ($investment_opportunity_categories as $category)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="browser-card card  shadow-sm h-100 text-center p-4 bg-white">
                        <a href="{{ route('web.pages.investment-opportunity.view', ['id' => base64urlEncode($category->id)]) }}" class="text-decoration-none text-dark">
                            <div class="icon-circle mx-auto mb-3">
                                <img src="{{ getImage(getFilepath('investment_opportunity_category') . '/' . $category->image) }}"
                                    alt="Category" class="img-fluid">
                            </div>
                            <h6 class="fw-semibold">{{ $category->lang('title') }}</h6>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .browser-card {
        border-radius: 16px;
        transition: all 0.3s ease-in-out;
    }
    .browser-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }
    .icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #EFDFFF, #D6C2FF);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px;
        transition: background 0.3s ease;
    }
    .browser-card:hover .icon-circle {
        background: linear-gradient(135deg, #d3b3ff, #a88bff);
    }
    .icon-circle img {
        width: 48px;
        height: 48px;
        object-fit: contain;
    }
</style>
