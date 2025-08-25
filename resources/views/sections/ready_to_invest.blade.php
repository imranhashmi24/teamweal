<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="investor_bg py-5 align-items-center">
                    <div class="py-4">
                        <h2 class="text-center text-white py-4">{{ __('Ready to Invest') }}</h2>

                        <div class="invest-button text-center">
                            <a href="{{ route('user.register') }}" class="btn btn-investor mb-3">{{ __('Create Investor Account') }}</a>
                            <a href="{{ route('web.pages.investment-opportunities') }}" class="btn btn-opportunities mb-3">{{ __('View All Opportunities') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .investor_bg {
        background-color: #330066;
        padding: 20px;
        border-radius: 10px;
    }

    .btn-investor {
        background: #0069CA;
        color: #fff;
        border-radius: 0;
    }

    .btn-investor:hover {
        background: #fff;
        color: #330066;
        border-radius: 0;
    }

    .btn-opportunities {
        border: 1px solid #FFFFFF;
        color: #fff;
        border-radius: 0;
    }

    .btn-opportunities:hover {
        background: #fff;
        color: #330066;
        border-radius: 0;
    }
</style>
