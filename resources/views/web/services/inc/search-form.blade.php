<section class="mt-5">
    <div class="container">
        <div class="mx-auto col-md-6">
            <h3 class="mb-4 fw-bold">@lang('Find the service you need')</h3>
            <form action="{{ route('web.pages.services.index') }}">
                <div class="gap-1 d-flex">
                    <input type="text" class="py-2 form-control" placeholder="@lang('Search')" name="search"
                           value="{{ request('search') }}">
                    <button class="rounded custom-btn">@lang('Search')</button>
                </div>
            </form>
        </div>
    </div>
</section>
