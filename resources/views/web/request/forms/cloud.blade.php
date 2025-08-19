
@include('web.request.partials.client_fields')


@include('web.request.partials.budget_timeline')


<div class="row g-3 mb-4">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-header">
                @lang('Project Readiness')
            </div>
            <div class="card-body">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="readiness" id="idea" value="Idea Only" required>
                    <label class="form-check-label" for="idea">@lang('Idea Only')</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="readiness" id="plan" value="Business Plan Ready">
                    <label class="form-check-label" for="plan">@lang('Business Plan Ready')</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="readiness" id="designs" value="Technical Requirements Ready">
                    <label class="form-check-label" for="designs">@lang('Technical Requirements Ready')</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="readiness" id="existing" value="Existing Cloud System – Needs Expansion">
                    <label class="form-check-label" for="existing">@lang('Existing Cloud System – Needs Expansion')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="readiness" id="consultation" value="I Need a Cloud Consultation">
                    <label class="form-check-label" for="consultation">@lang('I Need a Cloud Consultation')</label>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card mb-4">
    <div class="card-header">
        @lang('Project Requirements')
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="requirements" class="form-label">@lang('Describe Your Project')</label>
            <textarea class="form-control" id="requirements" name="requirements" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="current_setup" class="form-label">@lang('Current Cloud Setup')</label>
            <textarea class="form-control" id="current_setup" name="current_setup" rows="2"></textarea>
        </div>
    </div>
</div>

@include('web.request.partials.file_uploads')
@include('web.request.partials.form_footer')