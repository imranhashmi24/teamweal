@foreach ($list_items as $authority)
<div class="mb-2 col-12 mb-lg-0">
    <div class="p-3 mb-3 bg-white card">
        {{-- thumbnail --}}
        <div class="text-center">
            <img src="{{ asset('assets/web/img/skeleton-loading.gif') }}" height="200" width="300"
                style="max-width: 100%"
                data-src="{{ getImage(getFilePath('authority') . '/' . $authority->logo, getFileSize('authority')) }}"
                onerror="this.src='{{ asset('assets/img/no-photo-available.png') }}'" alt="{{ $authority->title }}">
            {{-- title --}}
            <p class="mt-1 fw-bold" style="color: #6B438A;">
                {{ app()->isLocale('en') ? $authority->title : $authority->title_ar }}</p>
        </div>
        {{-- list of main parts --}}
        <div class="row justify-content-center">
            @foreach ($authority->opportunities()->limit(4)->get() as $opportunity)
            <div class="p-2 col-xl-3 col-lg-4 col-md-5 col-sm-6 col-12" style="max-width: 350px">
                <div class="p-2 border h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="text-center">
                            <img height="200" class="w-100" src="{{ asset('assets/web/img/skeleton-loading.gif') }}"
                                data-src="{{ getImage(getFilePath('opportunity') . '/' . $opportunity->thumb, getFileSize('opportunity')) ?? asset('assets/img/no-photo-available.png') }}"
                                alt="">
                        </div>
                        <p class="mt-2 fw-bold">
                            {{ app()->isLocale('ar') ? $opportunity->title_ar : $opportunity->title }}
                        </p>
                        <p>{{ app()->isLocale('ar') ? $opportunity->overview_ar : $opportunity->overview }}</p>
                    </div>
                    @include('web.component.opportunity-submission-form-btn')
                </div>
            </div>
            @endforeach
            @if ($authority->opportunities()->count() > 4)
            <div class="my-2 text-center">
                <a href="" class="btn btn-primary">@lang('View
                    More')</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endforeach
