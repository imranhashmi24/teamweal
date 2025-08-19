<div class="service-page-box main">
    <a href="">
        <div class="service-box-image">
            <img height="200px" width="100%" src="{{ asset('assets/web/img/skeleton-loading.gif') }}"
                 data-src="{{ getImage(getFilePath('service') . '/' . $service->image, getFileSize('service')) ?? asset('assets/img/no-photo-available.png') }}"
                 onerror="this.src='{{ asset('assets/img/no-photo-available.png') }}'" alt="{{ app()->getLocale() == 'en' ? $service->title : $service->title_ar }}">
        </div>
        <p class="fw-bold fs-6" title="{{ app()->getLocale() == 'en' ? $service->title : $service->title_ar }}">
            {{  app()->getLocale() == 'en' ? $service->title : $service->title_ar }}
        </p>
    </a>
    <p>
        {{ Str::limit(app()->getLocale() == 'en' ? $service->description : $service->description_ar ?? $service->description, 120, '...') }}
    </p>
</div>
