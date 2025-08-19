

@include('web.request.partials.client_fields')


<div class="card mb-4">
    <div class="card-header">
        @lang('Security Requirements')
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="target" class="form-label">@lang('Target System/Scope')</label>
                <textarea class="form-control" id="target" name="target" rows="3" required></textarea>
            </div>
            <div class="col-md-6">
                <label for="implementation" class="form-label">@lang('Implementation Purpose')</label>
                <textarea class="form-control" id="implementation" name="implementation" rows="3" required></textarea>
            </div>
            <div class="col-12">
                <label for="current_security" class="form-label">@lang('Current Security Measures')</label>
                <textarea class="form-control" id="current_security" name="current_security" rows="2"></textarea>
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
                    <input class="form-check-input" type="radio" name="readiness" id="plan" value="I have a written plan">
                    <label class="form-check-label" for="plan">@lang('I have a written plan')</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="readiness" id="designs" value="I have an existing system and need enhanced protection">
                    <label class="form-check-label" for="designs">@lang('I have an existing system and need enhanced protection')</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="readiness" id="existing" value="I need initial cybersecurity consultation">
                    <label class="form-check-label" for="existing">@lang('I need initial cybersecurity consultation')</label>
                </div>
            </div>
        </div>
    </div>
</div>


@include('web.request.partials.file_uploads')
@include('web.request.partials.form_footer')