
@include('web.request.partials.client_fields')


@php
    $industries =  [
        ['id' => 1, 'name' => 'Banking'],
        ['id' => 2, 'name' => 'Insurance'],
        ['id' => 3, 'name' => 'Healthcare'],
        ['id' => 4, 'name' => 'Restaurants'],
        ['id' => 5, 'name' => 'Call Centers'],
        ['id' => 6, 'name' => 'Developers'],
        ['id' => 7, 'name' => 'Supply Chains'],
        ['id' => 8, 'name' => 'Retail & E-commerce'],
        ['id' => 9, 'name' => 'Telecommunications'],
        ['id' => 10, 'name' => 'Culinary Innovation'],
        ['id' => 11, 'name' => 'Medical Diagnosis'],
        ['id' => 12, 'name' => 'Invoice Processing'],
        ['id' => 13, 'name' => 'Internet of Things (IoT)'],
        ['id' => 14, 'name' => 'Oil & Gas'],
        ['id' => 15, 'name' => 'Industrial Manufacturing'],
        ['id' => 16, 'name' => 'Public Sector'],
        ['id' => 17, 'name' => 'Utilities'],
        ['id' => 18, 'name' => 'Automotive'],
        ['id' => 19, 'name' => 'Chemicals'],
        ['id' => 20, 'name' => 'Legal Services'],
        ['id' => 21, 'name' => 'Logistics & Transportation'],
        ['id' => 22, 'name' => 'Media & Entertainment'],
        ['id' => 23, 'name' => 'Education'],
        ['id' => 24, 'name' => 'High Tech'],
        ['id' => 25, 'name' => 'Engineering & Construction'],
        ['id' => 26, 'name' => 'Defense & Intelligence'],
        ['id' => 27, 'name' => 'Aerospace'],
    ];
@endphp

<div class="card mb-4">
    <div class="card-header">
        @lang('Project Details')
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="industry" class="form-label">@lang('Industry Sector')</label>
                <select class="form-select" id="industry" name="industry" required>
                    <option value="">@lang('Select Industry')</option>
                    @foreach($industries as $industry)
                        <option value="{{ $industry['id'] }}">@lang($industry['name'])</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="ai_type" class="form-label">@lang('AI Implementation Type')</label>
                <select class="form-select" id="ai_type" name="ai_type" required>
                    <option value="new">@lang('New Implementation')</option>
                    <option value="enhancement">@lang('Enhance Existing System')</option>
                    <option value="integration">@lang('Integration with Other Systems')</option>
                </select>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">@lang('Project Description')</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
        </div>
    </div>
</div>

@include('web.request.partials.budget_timeline')

<div class="row g-3 mb-4">
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header">
                    @lang('Project Readiness')
                </div>
                <div class="card-body">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="readiness" id="idea" value="I only have an idea" required>
                        <label class="form-check-label" for="idea">@lang('I only have an idea')</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="readiness" id="plan" value="I have a clear business plan">
                        <label class="form-check-label" for="plan">@lang('I have a clear business plan')</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="readiness" id="designs" value="I have technical requirements">
                        <label class="form-check-label" for="designs">@lang('I have technical requirements')</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="readiness" id="existing" value="I need technical consultation">
                        <label class="form-check-label" for="existing">@lang('I need technical consultation')</label>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('web.request.partials.file_uploads')
@include('web.request.partials.form_footer')