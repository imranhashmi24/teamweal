<section class="py-5 invesment-section">
    <div class="container">
        <div class="row">
            <div class="text-center section-title">
                <h2>@lang('Investment Projects')</h2>
            </div>
        </div>
        <div class="mt-5 row justify-content-center">
            @forelse (\App\Models\Project::take(4) as $project)
                <div class="mb-4 col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="invesment-box">
                        <a target="_blank" href="{{ $project->url }}">
                            <img height="90px" src="{{ asset('assets/web/img/skeleton-loading.gif') }}" data-src="{{ getImage(getFilePath('project') . '/' . $project->image, getFileSize('project')) ?? asset('assets/img/no-photo-available.png') }}" alt="Investment Logo">
                        </a>
                        <h5>{{ app()->getLocale() == 'en' ? $project->title : $project->title_ar  }}</h5>
                        <p class="">
                            {{ app()->getLocale() == 'en' ? makeDotStr($project->description, 200) : makeDotStr($project->description_ar, 200) ?? makeDotStr($project->description, 200) }}
                        </p>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <div class="row">
            <div class="mt-4 text-center col">
                <a class="rounded custom-btn-lg fw-bold" href="{{ route('web.pages.partners') }}">@lang('View all')</a>
            </div>
        </div>
    </div>
</section>
