<section class="py-5 service-section">
    <div class="container">
        <h3 class="text-center">@lang('Sectors')</h3>
        <div class="row justify-content-center">
            @forelse ($categories as $category)
                <div class="mb-4 col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="service-box">
                        <a href="{{ route('web.pages.services.index', ['category_id' => $category->id]) }}" class="d-block">
                            <img
                            src="{{ asset('assets/web/img/skeleton-loading.gif') }}"
                                 data-src="{{ getImage(getFilePath('category') . '/' . $category->image, getFileSize('category')) ?? asset('assets/img/no-photo-available.png') }}" alt="{{ $category->name }}">
                            <div class="service-overlay-main">
                                <div class="service-overlay">
                                    <div class="d-flex bd-highlight align-items-center">
                                        <div class="flex-shrink-1 bd-highlight service-count">
                                            <h3>
                                                {{ $loop->iteration > 9 ? $loop->iteration : '0' . $loop->iteration }}
                                            </h3>
                                        </div>
                                        <div class="w-100 bd-highlight service-row"></div>
                                    </div>
                                    <p class="fw-bold">
                                        {{ app()->getLocale() == 'en' ? $category->name : $category->name_ar ?? $category->name }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
