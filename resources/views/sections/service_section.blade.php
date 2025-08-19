
<section class="py-3 py-lg-5">
    <div class="container">
        <div class="gap-3 d-flex align-itmes-center justify-content-between">
            <div>
                <h5 class="py-3 pt-3 m-0 fs-3">{{ app()->getLocale() == 'en' ? $category->name : $category->name_ar }}</h5>
            </div>
            <div class="mt-4 text-end">
                <a href="{{ route('services', ['slug' => $category->id]) }}">@lang('View All')</a>
            </div>
        </div>
         <div class="row g-md-3">
            @foreach ($category->services->take(16) as $element)
                <div class="col-6 col-md-4 col-lg-3 my-2">
                    <div class="card h-100">
                        <img src="{{ getImage(getFilePath('service') . '/' . $element->image, getFileSize('service')) }}"
                            alt="" class="card-img-top">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center">{{ app()->getLocale() == 'en' ?  $element->title : $element->title_ar}}</h5>
                            <x-request-button route="web.pages.service_requests.create" id="{{ @$element->id }}" type="service" text="Request Service" />
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>



