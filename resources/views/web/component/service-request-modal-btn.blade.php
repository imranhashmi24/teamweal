<button data-bs-toggle="modal" data-bs-target="#service_request_modal" class="btn btn-primary"
onclick="setServiceReqeustModalForm({{ $service?->id ?? null }} ?? null)">@lang('Send Request')</button>

@once
<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="service_request_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
 aria-labelledby="modalTitleId" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">@lang('Service Request')</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @include('components.errors')
            <form id="service_request_form" action="{{ route('web.pages.e_service_requests.store') }}" method="POST"
                  class="contact-form shop-form">
                @csrf

                <input type="hidden" id="service_id_field" value="" name="service_id">

                <div class="row">
                    <div class="mb-2 col-md-6">
                        <lable for="name">@lang('The Name')</lable>
                        <input id="name" type="text" name="name" value="{{ $user?->name }}" required>

                    </div>
                    <div class="mb-2 col-md-6">
                        <lable>@lang('The Number')</lable>
                        <input type="number" minlength="10" maxlength="15" name="contact" id="contact" required required>

                    </div>
                    <div class="mb-2 col-md-6">
                        <lable for="email">@lang('Email')</lable>
                        <input type="email" name="email" id="email" value="{{ $user?->email }}" class="text-start"
                               required>

                    </div>


                    <div class="mb-2 col-md-6">
                        <lable>@lang('Nature of the activity')</lable>
                        <select name="nature_of_activity" class="form-control" required>
                            <option value="">@lang('Select an option')</option>
                            <option value="{{ __('New project') }}">@lang('New project')</option>
                            <option value="{{ __('Develop and expand an existing project') }}">@lang('Develop and expand an existing project')</option>
                        </select>

                    </div>

                    <div class="mb-2 col-md-12">
                        <lable>@lang('Active place')</lable>
                        <input type="text" name="active_place" required>

                    </div>

                    <div class="mb-2 col-md-12">
                        <lable>@lang('Website link')</lable>
                        <input type="url" name="website_link">

                    </div>

                    <div class="pt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="custom-btn contact-btn">@lang('Send a request')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@push('js')
<script>
    function setServiceReqeustModalForm(id = null) {
        if (id) {
            $('#service_id_field').val(id)
        }
        // console.log($('#service_id_field').val());
    }

    $('#service_request_form').validate();
</script>
@endpush

@endonce
