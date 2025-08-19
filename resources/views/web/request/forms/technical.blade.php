


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
                        <input class="form-check-input" type="radio" name="readiness" id="designs" value="Design Files Ready">
                        <label class="form-check-label" for="designs">@lang('Design Files Ready')</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="readiness" id="existing" value="Existing System – Needs Development">
                        <label class="form-check-label" for="existing">@lang('Existing System – Needs Development')</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="readiness" id="consultation" value="I Need a Consultation">
                        <label class="form-check-label" for="consultation">@lang('I Need a Consultation')</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('web.request.partials.file_uploads')

    <div class="card mb-4">
        <div class="card-header">
            <h6>@lang('Project Details')</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="summary" class="form-label">@lang('Project Summary')</label>
                <textarea class="form-control" id="summary" name="summary" rows="4" required></textarea>
            </div>
        </div>
    </div>

    @include('web.request.partials.form_footer')
</form>

