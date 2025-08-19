
@include('web.request.partials.client_fields')


<div class="card mb-4">
    <div class="card-header">
        @lang('Analytics Project Details')
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="objective" class="form-label">@lang('Primary Objective')</label>
                <select class="form-select" id="objective" name="objective" required>
                    <option value="decision">@lang('Decision Support')</option>
                    <option value="process">@lang('Process Improvement')</option>
                    <option value="reporting">@lang('Reporting')</option>
                    <option value="development">@lang('Product/Service Development')</option>
                    <option value="other">@lang('Other')</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="data_status" class="form-label">@lang('Data Availability')</label>
                <select class="form-select" id="data_status" name="data_status" required>
                    <option value="ready">@lang('Data Ready for Analysis')</option>
                    <option value="collection">@lang('Need Data Collection')</option>
                    <option value="both">@lang('Some Data Ready, Some Needed')</option>
                </select>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">@lang('Project Description')</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="col-12">
                <label for="data_sources" class="form-label">@lang('Data Sources')</label>
                <textarea class="form-control" id="data_sources" name="data_sources" rows="2"></textarea>
                <div class="form-text">@lang('Describe available data sources or systems')</div>
            </div>
        </div>
    </div>
</div>

@include('web.request.partials.budget_timeline')

@include('web.request.partials.file_uploads')
@include('web.request.partials.form_footer')