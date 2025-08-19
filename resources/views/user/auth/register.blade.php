@extends('web.layouts.frontend',['title'=> __('Service providers registration')])
@section('content')
@php
    $policyPages = getContent('policy_pages.element',false,null,true);
@endphp

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card custom-card">
                    <div class="card-header">
                        <h5 class="card-title text-center">@lang('Join our network of verified service providers')</h5>
                        <p class="text-center mb-0">@lang('Start offering your services to businesses and organizations seeking advanced tech solutions')</p>
                    </div>
                    <div class="card-body px-4">
                        <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <h6 class="section-title mb-3">@lang('General Information')</h6>
                            <div class="row">
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Full Name / Organization Name') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Entity Type') <span class="text-danger">*</span></label>
                                        <select class="form-select" name="entity_type" required>
                                            <option value="Individual">@lang('Individual')</option>
                                            <option value="Establishment">@lang('Establishment')</option>
                                            <option value="Company">@lang('Company')</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('National ID / Commercial Registration No.') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="commercial_registration_no" value="{{ old('commercial_registration_no') }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Country') <span class="text-danger">*</span></label>
                                        <select name="country" class="form-select" required>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ app()->getLocale() == 'en' ? $country->name : $country->name_ar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('City') <span class="text-danger">*</span></label>
                                        <input type="text" name="city" value="{{ old('city') }}" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Mobile Number') <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control checkUser" required>
                                        <small class="text-danger mobileExist"></small>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Email Address') <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control checkUser" name="email" value="{{ old('email') }}" required>
                                        <small class="text-danger emailExist"></small>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Website URL (if any)')</label>
                                        <input type="url" name="website" value="{{ old('website') }}" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-12 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Social Media Accounts (optional)')</label>
                                        <input type="text" name="social_media" value="{{ old('social_media') }}" class="form-control" placeholder="@lang('e.g., LinkedIn, Twitter, Facebook profiles')">
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <h6 class="section-title mb-3">@lang('Service Description')</h6>
                            
              
                            <div class="row">
                                <div class="col-12 pb-3">
                                    <label class="form-label">@lang('Service') <span class="text-danger">*</span></label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="0" selected>@lang('Select one')</option>
                                        @foreach(\App\Models\Category::where('parent_id', 0)->get() as $category)
                                          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} data-childrens="{{ $category->childs }}">{{ $category?->lang('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-12 pb-3">
                                    <label class="form-label">@lang('Sub Service')</label>
                                    <select class="form-select" id="sub_category_id" name="sub_category_id">
                                        <option value="0" selected>@lang('Select one')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Briefly describe your services and areas of expertise')</label>
                                        <textarea name="service_description" class="form-control" rows="4" required>{{ old('service_description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <h6 class="section-title mb-3">@lang('Additional Information')</h6>
                            <div class="row">
                                <div class="col-12 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Previous Projects or Achievements (optional)')</label>
                                        <textarea name="pre_experience_project" class="form-control" rows="4">{{ old('pre_experience_project') }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-12 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Target Clients')</label>
                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="target_clients[]" value="Individuals" id="individualsCheck">
                                                <label class="form-check-label" for="individualsCheck">@lang('Individuals')</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="target_clients[]" value="Companies" id="companiesCheck">
                                                <label class="form-check-label" for="companiesCheck">@lang('Companies')</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="target_clients[]" value="Government Entities" id="governmentCheck">
                                                <label class="form-check-label" for="governmentCheck">@lang('Government Entities')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Professional Licenses or Certificates')</label>
                                        <input type="file" name="certificates[]" class="form-control" multiple>
                                        <small class="text-muted">@lang('Please attach files')</small>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <h6 class="section-title mb-3">@lang('Preferences')</h6>
                            <div class="row">
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Preferred Communication Method')</label>
                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="preferred_communication" value="Email" id="emailRadio" checked>
                                                <label class="form-check-label" for="emailRadio">@lang('Email')</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="preferred_communication" value="Phone" id="phoneRadio">
                                                <label class="form-check-label" for="phoneRadio">@lang('Phone')</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="preferred_communication" value="WhatsApp" id="whatsappRadio">
                                                <label class="form-check-label" for="whatsappRadio">@lang('WhatsApp')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Best Time to Contact')</label>
                                        <input type="text" name="best_time_to_contact" value="{{ old('best_time_to_contact') }}" class="form-control" placeholder="@lang('e.g., 9AM-5PM weekdays')">
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Estimated Response Time')</label>
                                        <input type="text" name="estimated_response_time" value="{{ old('estimated_response_time') }}" class="form-control" placeholder="@lang('e.g., 24 hours')">
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <h6 class="section-title mb-3">@lang('Attachments')</h6>
                            <div class="row">
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Commercial Registration / National ID') <span class="text-danger">*</span></label>
                                        <input type="file" name="commercial_registration_file" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Certificates or Portfolio Documents')</label>
                                        <input type="file" name="portfolio_files[]" class="form-control" multiple>
                                    </div>
                                </div>
                                
                                <div class="col-12 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Company Profile (optional)')</label>
                                        <input type="file" name="company_profile" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Username') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control checkUser" name="username" value="{{ old('username') }}" required>
                                        <small class="text-danger usernameExist"></small>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Password') <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @if(gs('secure_password')) secure-password @endif" name="password" required>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6 pb-3">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Confirm Password') <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                            
                            <x-captcha />
                            
                            @if(gs()->agree)
                            <div class="col-12 pb-3">
                                <div class="form-group">
                                    <input type="checkbox" id="agree" @checked(old('agree')) name="agree" required>
                                    <label for="agree">@lang('I confirm that the provided information is accurate and I accept the platforms Terms & Conditions')</label>
                                    <span>
                                        @foreach($policyPages as $policy)
                                            <a style="font-weight: bold;" href="{{ route('policy.pages',[slug($policy->data_values->title),$policy->id]) }}" target="_blank">{{ __($policy->data_values->title) }}</a>
                                            @if(!$loop->last), @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            @endif
                            
                            <div class="col-12 pb-3">
                                <div class="form-group">
                                    <button type="submit" id="recaptcha" class="btn btn-base w-100">@lang('Submit Application')</button>
                                </div>
                                
                                <p class="mb-0 text-center pt-3">@lang('Already have an account?') <a href="{{ route('user.login') }}">@lang('Sign In')</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if(gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        $(document).ready(function() {
            var isArabic = "{{ app()->getLocale() === 'ar' }}" === '1';
            
            $('#category_id').change(function() {
                $('#sub_category_id').html('<option value="0" selected>@lang("Select one")</option>');
                
                var selectedOption = $(this).find('option:selected');
                var childrenCategories = selectedOption.data('childrens');
                
                if (childrenCategories && childrenCategories.length > 0) {
                    $.each(childrenCategories, function(index, child) {
                        var childName = (isArabic && child.name_ar) ? child.name_ar : child.name || 'Unnamed';
                        $('#sub_category_id').append($('<option>', {
                            value: child.id,
                            text: childName
                        }));
                    });
                }
            });
        });
    </script>
    <script>
      "use strict";
        (function ($) {
            $('.checkUser').on('focusout',function(e){
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';

                if ($(this).attr('name') == 'email') {
                    var data = {email:value,_token:token}
                }
                if ($(this).attr('name') == 'username') {
                    var data = {username:value,_token:token}
                }

                if ($(this).attr('name') == 'mobile') {
                    var data = {mobile:value,_token:token}
                }

                $.post(url,data,function(response) {
                  if(response.data != false){
                    $(`.${response.type}Exist`).text(`${response.type} already exists`);
                  }else{
                    $(`.${response.type}Exist`).text('');
                  }
                });
            });
        })(jQuery);
    </script>
@endpush