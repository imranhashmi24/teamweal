
@include('web.request.partials.client_fields')

<div class="card mb-4">
    <div class="card-header">
        @lang('Coding Services Needed')
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="digital_signature" name="services[]" value="digital_signature">
                    <label class="form-check-label" for="digital_signature">@lang('Digital Signature')</label>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="barcode" name="services[]" value="barcode">
                    <label class="form-check-label" for="barcode">@lang('GS1 (Global Barcode) Services')</label>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="qr_code" name="services[]" value="qr_code">
                    <label class="form-check-label" for="qr_code">@lang('Interactive QR Code Solutions')</label>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="ar" name="services[]" value="ar">
                    <label class="form-check-label" for="ar">@lang('Augmented Reality (AR)')</label>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="vr" name="services[]" value="vr">
                    <label class="form-check-label" for="vr">@lang('Virtual Reality (VR)')</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        @lang('Service Details')
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="service_description" class="form-label">@lang('Service Description/Requirements')</label>
                <textarea class="form-control" id="service_description" name="service_description" rows="3" required></textarea>
            </div>
            <div class="col-md-6">
                <label for="purpose" class="form-label">@lang('Purpose of the Service')</label>
                <textarea class="form-control" id="purpose" name="purpose" rows="3" required></textarea>
            </div>
            <div class="col-12">
                <label for="documents" class="form-label">@lang('Type of Documents/Products')</label>
                <textarea class="form-control" id="documents" name="documents" rows="2" required></textarea>
                <div class="form-text">@lang('Describe what the service will be applied to')</div>
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
                    <input class="form-check-input" type="radio" name="readiness" id="idea" value="I have an idea only" required>
                    <label class="form-check-label" for="idea">@lang('I have an idea only')</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="readiness" id="plan" value="I have an initial concept">
                    <label class="form-check-label" for="plan">@lang('I have an initial concept')</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="readiness" id="designs" value="I have a design or written plan">
                    <label class="form-check-label" for="designs">@lang('I have a design or written plan')</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="readiness" id="existing" value="I need technical consultation / project development">
                    <label class="form-check-label" for="existing">@lang('I need technical consultation / project development')</label>
                </div>
            </div>
        </div>
    </div>
</div>


@include('web.request.partials.file_uploads')
@include('web.request.partials.form_footer')