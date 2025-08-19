<div class="row g-3 mb-4">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-header">
                @lang('Budget & Timeline')
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">@lang('Estimated Budget') (SAR)</label>
                    <select class="form-select" name="budget" required>
                        <option value="<5000">@lang('Less than 5,000')</option>
                        <option value="5000-20000">@lang('5,000 - 20,000')</option>
                        <option value="20000-50000">@lang('20,000 - 50,000')</option>
                        <option value=">50000">@lang('More than 50,000')</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">@lang('Expected Duration')</label>
                    <select class="form-select" name="timeline" required>
                        <option value="1week">@lang('1 Week')</option>
                        <option value="1month">@lang('1 Month')</option>
                        <option value="3months">@lang('3 Months')</option>
                        <option value=">3months">@lang('More than 3 Months')</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>