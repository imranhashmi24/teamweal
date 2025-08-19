@extends('web.layouts.master', ['title' => 'Profile Setting'])
@section('content')
    <form class="register" action="{{ route('user.profile.setting') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex gap-4 flex-wrap">
                    <div class="user-profile-img">
                        <div>
                            <x-image-uploader image="{{ $user->image }}" class="w-100" type="userProfile"
                                :showSizeFileType=false />
                        </div>
                    </div>
                    <div class="profile-information">
                        <p>{{ $user->name }}</p>
                        <p>{{ '@' . $user->username }}</p>
                        <p>{{ $user->email }}</p>
                        <p>{{ $user->mobile }}</p>
                        <p>{{ @$user->country->name }}</p>
                    </div>
                </div>
            </div>

            <h6 class="section-title mb-3">@lang('General Information')</h6>
            <div class="row">
                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Full Name / Organization Name')</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Entity Type')</label>
                    <select class="form-select" name="entity_type" required>
                        <option value="Individual" {{ $user->entity_type == 'Individual' ? 'selected' : '' }}>@lang('Individual')</option>
                        <option value="Establishment" {{ $user->entity_type == 'Establishment' ? 'selected' : '' }}>@lang('Establishment')</option>
                        <option value="Company" {{ $user->entity_type == 'Company' ? 'selected' : '' }}>@lang('Company')</option>
                    </select>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('National ID / Commercial Registration No.')</label>
                    <input type="text" class="form-control" name="commercial_registration_no" 
                           value="{{ $user->commercial_registration_no }}" required>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Country')</label>
                    <select name="country" class="form-select" required>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? $country->name : $country->name_ar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('City')</label>
                    <input type="text" name="city" value="{{ @$user->address->city }}" class="form-control" required>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Mobile Number')</label>
                    <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control" required>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Email Address')</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Website URL (if any)')</label>
                    <input type="url" name="website" value="{{ $user->website }}" class="form-control">
                </div>

                <div class="pb-3 form-group col-12">
                    <label class="form-label">@lang('Social Media Accounts')</label>
                    <input type="text" name="social_media" value="{{ $user->social_media }}" class="form-control" 
                           placeholder="@lang('e.g., LinkedIn, Twitter, Facebook profiles')">
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
                          <option value="{{ $category->id }}" {{ $user->category_id == $category->id ? 'selected' : '' }} data-childrens="{{ $category->childs }}">{{ $category?->lang('name') }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-12 pb-3">
                    <label class="form-label">@lang('Sub Service')</label>
                    <select class="form-select" id="sub_category_id" name="sub_category_id">
                        @foreach(\App\Models\Category::where('parent_id', '!=', 0)->get() as $subcategory)
                          <option value="{{ $subcategory->id }}" {{ $user->category_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory?->lang('name') }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="pb-3 form-group col-12">
                    <label class="form-label">@lang('Briefly describe your services and areas of expertise')</label>
                    <textarea name="service_description" class="form-control" rows="4" required>{{ $user->service_description }}</textarea>
                </div>
            </div>

            <hr class="my-4">
            <h6 class="section-title mb-3">@lang('Additional Information')</h6>
            <div class="row">
                <div class="pb-3 form-group col-12">
                    <label class="form-label">@lang('Previous Projects or Achievements')</label>
                    <textarea name="pre_experience_project" class="form-control" rows="4">{{ $user->pre_experience_project }}</textarea>
                </div>

                <div class="pb-3 form-group col-12">
                    <label class="form-label">@lang('Target Clients')</label>
                    <div class="d-flex flex-wrap gap-3">
                        @php
                            $targetClients = json_decode($user->target_clients, true) ?? [];
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="target_clients[]" value="Individuals" 
                                   id="individualsCheck" {{ in_array('Individuals', $targetClients) ? 'checked' : '' }}>
                            <label class="form-check-label" for="individualsCheck">@lang('Individuals')</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="target_clients[]" value="Companies" 
                                   id="companiesCheck" {{ in_array('Companies', $targetClients) ? 'checked' : '' }}>
                            <label class="form-check-label" for="companiesCheck">@lang('Companies')</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="target_clients[]" value="Government Entities" 
                                   id="governmentCheck" {{ in_array('Government Entities', $targetClients) ? 'checked' : '' }}>
                            <label class="form-check-label" for="governmentCheck">@lang('Government Entities')</label>
                        </div>
                    </div>
                </div>

                <div class="pb-3 form-group col-12">
                    <label class="form-label">@lang('Professional Licenses or Certificates')</label>
                    <input type="file" name="certificates[]" class="form-control" multiple>
                    @if($user->certificates)
                        <div class="mt-2">
                            <small class="text-muted">@lang('Current certificates:')</small>
                            @foreach(json_decode($user->certificates, true) as $certificate)
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ asset('storage/'.$certificate) }}" target="_blank" class="text-primary">
                                        @lang('View certificate') {{ $loop->iteration }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <hr class="my-4">
            <h6 class="section-title mb-3">@lang('Preferences')</h6>
            <div class="row">
                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Preferred Communication Method')</label>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="preferred_communication" 
                                   value="Email" id="emailRadio" {{ $user->preferred_communication == 'Email' ? 'checked' : '' }}>
                            <label class="form-check-label" for="emailRadio">@lang('Email')</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="preferred_communication" 
                                   value="Phone" id="phoneRadio" {{ $user->preferred_communication == 'Phone' ? 'checked' : '' }}>
                            <label class="form-check-label" for="phoneRadio">@lang('Phone')</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="preferred_communication" 
                                   value="WhatsApp" id="whatsappRadio" {{ $user->preferred_communication == 'WhatsApp' ? 'checked' : '' }}>
                            <label class="form-check-label" for="whatsappRadio">@lang('WhatsApp')</label>
                        </div>
                    </div>
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Best Time to Contact')</label>
                    <input type="text" name="best_time_to_contact" value="{{ $user->best_time_to_contact }}" 
                           class="form-control" placeholder="@lang('e.g., 9AM-5PM weekdays')">
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Estimated Response Time')</label>
                    <input type="text" name="estimated_response_time" value="{{ $user->estimated_response_time }}" 
                           class="form-control" placeholder="@lang('e.g., 24 hours')">
                </div>
            </div>

            <hr class="my-4">
            <h6 class="section-title mb-3">@lang('Attachments')</h6>
            <div class="row">
                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Commercial Registration / National ID')</label>
                    <input type="file" name="commercial_registration_file" class="form-control">
                    @if($user->commercial_registration_file)
                        <div class="mt-2">
                            <a href="{{ asset('storage/'.$user->commercial_registration_file) }}" target="_blank" class="text-primary">
                                @lang('View current file')
                            </a>
                        </div>
                    @endif
                </div>

                <div class="pb-3 form-group col-sm-6">
                    <label class="form-label">@lang('Certificates or Portfolio Documents')</label>
                    <input type="file" name="portfolio_files[]" class="form-control" multiple>
                    @if($user->portfolio_files)
                        <div class="mt-2">
                            <small class="text-muted">@lang('Current portfolio files:')</small>
                            @foreach(json_decode($user->portfolio_files, true) as $portfolio)
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ asset('storage/'.$portfolio) }}" target="_blank" class="text-primary">
                                        @lang('View file') {{ $loop->iteration }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="pb-3 form-group col-12">
                    <label class="form-label">@lang('Company Profile (optional)')</label>
                    <input type="file" name="company_profile" class="form-control">
                    @if($user->company_profile)
                        <div class="mt-2">
                            <a href="{{ asset('storage/'.$user->company_profile) }}" target="_blank" class="text-primary">
                                @lang('View current company profile')
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-base w-100">@lang('Update Profile')</button>
            </div>
        </div>
    </form>
@endsection

@push('title')
    <h5 class="card-title">@lang('Profile Setting')</h5>
@endpush


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
@endpush