  <!-- Modal Body -->
  <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
  <div class="modal fade" id="service_request_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
       aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="modalTitleId">Service Request</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  @include('components.errors')

                  <form id="service_request_form" action="{{ route('web.pages.e_service_requests.store') }}" method="post"
                        class="needs-validation contact-form shop-form" novalidate>
                      @csrf

                      <input type="hidden" value="" name="service_id">

                      <div class="row">
                          <div class="mb-2 col-md-6">
                              <lable for="name">@lang('The Name')</lable>
                              <input id="name" type="text" name="name" value="{{ $user?->name }}" required>
                              <div class="invalid-feedback">
                                  The Name field is required.
                              </div>
                          </div>
                          <div class="mb-2 col-md-6">
                              <lable>@lang('The Number')</lable>
                              <input type="text" name="contact" id="contact" required>
                              <div class="invalid-feedback">
                                  The Number field is required.
                              </div>
                          </div>
                          <div class="mb-2 col-md-6">
                              <lable for="email">@lang('Email')</lable>
                              <input type="email" name="email" id="email" value="{{ $user?->email }}" class="text-start"
                                     required>
                              <div class="invalid-feedback">
                                  The Email field is required.
                              </div>
                          </div>


                          <div class="mb-2 col-md-6">
                              <lable>@lang('Nature of the activity')</lable>
                              <select name="nature_of_activity" class="form-control" required>
                                  <option value="">@lang('Select an option')</option>
                                  <option>@lang('New project')</option>
                                  <option>@lang('Develop and expand an existing project')</option>
                              </select>
                              <div class="invalid-feedback">
                                  This field is required.
                              </div>
                          </div>

                          <div class="mb-2 col-md-12">
                              <lable>@lang('Active place')</lable>
                              <input type="text" name="active_place" required>
                              <div class="invalid-feedback">
                                  This field is required.
                              </div>
                          </div>

                          <div class="mb-2 col-md-12">
                              <lable>@lang('Website link')</lable>
                              <input type="text" name="website_link" required>
                              <div class="invalid-feedback">
                                  This field is required.
                              </div>
                          </div>

                          <div class="pt-3 d-flex justify-content-between">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="custom-btn contact-btn">@lang('Send a request')</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
