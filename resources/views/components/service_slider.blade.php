<section class="py-5 service-section">
    <div class="container">
        <h3 class="mb-4 text-center">@lang('Sectors')</h3>
        <div class="row justify-content-center">
            <div class="service-slider owl-carousel">
                @forelse ($categories as $category)
                    <div class="service-box">
                        <a href="{{ route('web.pages.services.index', ['category_id' => $category->id]) }}" class="d-block">
                            <img src="{{ asset('assets/web/img/skeleton-loading.gif') }}"
                                 data-src="{{ getImage(getFilePath('category') . '/' . $category->image, getFileSize('category')) ?? asset('assets/img/no-photo-available.png') }}"
                                 alt="{{ $category->name }}"
                                 class="lazy">
                            <div class="service-overlay-main">
                                <div class="service-overlay">
                                    <div class="d-flex bd-highlight align-items-center">
                                        <div class="flex-shrink-1 bd-highlight service-count">
                                            <h3>{{ $loop->iteration > 9 ? $loop->iteration : '0' . $loop->iteration }}</h3>
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
                @empty
                    <p>{{ __('No categories available.') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

@push('style-lib')
<link rel="stylesheet" href="{{ asset('assets/global/css/owl.carousel.min.css') }}">
@endpush

@push('script-lib')
<script src="{{ asset('assets/global/js/owl.carousel.min.js') }}"></script>
@endpush

@push('script')
<script>
    $(document).ready(function() {
        $('.service-slider').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });
</script>
@endpush
