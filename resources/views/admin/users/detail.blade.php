@extends('admin.layouts.app', ['title' => 'Service Provider Details - ' . $user->username])

@section('panel')
 <div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-end gap-3">
            <a href="{{ route('admin.users.download.pdf', $user->id) }}" class="btn btn-danger">
                <i class="las la-file-pdf"></i> @lang('Download PDF')
            </a>
            <a href="{{ route('admin.users.download.excel', $user->id) }}" class="btn btn-success">
                <i class="las la-file-excel"></i> @lang('Download Excel')
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ getImage(getFilePath('userProfile').'/'.$user->image) }}" 
                     class="rounded-circle mb-3" width="120" alt="Profile Image">
                <h4>{{ $user->name }}</h4>
                <p class="text-muted mb-1">{{ '@' . $user->username }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge bg-{{ $user->status ? 'success' : 'danger' }}">
                        {{ $user->status ? 'Active' : 'Banned' }}
                    </span>
                    <span class="badge bg-primary">{{ $user->entity_type }}</span>
                </div>
                
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                    <a href="{{ route('admin.users.login', $user->id) }}" target="_blank" 
                       class="btn btn-sm btn-outline-success">
                        <i class="las la-sign-in-alt"></i> @lang('Login as User')
                    </a>
                    @if($user->status)
                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#banModal">
                            <i class="las la-ban"></i> @lang('Ban')
                        </button>
                    @else
                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#banModal">
                            <i class="las la-check-circle"></i> @lang('Unban')
                        </button>
                    @endif
                </div>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between">
                        <span>@lang('Email')</span>
                        <span>{{ $user->email }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span>@lang('Mobile')</span>
                        <span>{{ $user->mobile }}</span>
                    </div>
                    @if($user->website)
                    <div class="list-group-item d-flex justify-content-between">
                        <span>@lang('Website')</span>
                        <a href="{{ $user->website }}" target="_blank">Visit</a>
                    </div>
                    @endif
                    <div class="list-group-item d-flex justify-content-between">
                        <span>@lang('Joined')</span>
                        <span>{{ showDateTime($user->created_at) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Verification Status -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">@lang('Verification Status')</h5>
            </div>
            <div class="card-body">
                <div class="verification-item d-flex justify-content-between mb-3">
                    <span>@lang('Email Verification')</span>
                    <span class="badge bg-{{ $user->ev ? 'success' : 'danger' }}">
                        {{ $user->ev ? 'Verified' : 'Unverified' }}
                    </span>
                </div>
                <div class="verification-item d-flex justify-content-between">
                    <span>@lang('Mobile Verification')</span>
                    <span class="badge bg-{{ $user->sv ? 'success' : 'danger' }}">
                        {{ $user->sv ? 'Verified' : 'Unverified' }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Documents -->
        @if($user->commercial_registration_file || $user->company_profile || $user->certificates || $user->portfolio_files)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">@lang('Documents')</h5>
            </div>
            <div class="card-body">
                @if($user->commercial_registration_file)
                <div class="document-item mb-3">
                    <div class="d-flex align-items-center">
                        <i class="las la-file-alt fs-4 text-primary me-3"></i>
                        <div>
                            <h6 class="mb-0">@lang('Commercial Registration')</h6>
                            <small class="text-muted">.{{ pathinfo($user->commercial_registration_file, PATHINFO_EXTENSION) }}</small>
                        </div>
                    </div>
                    <a href="{{ asset('storage/'.$user->commercial_registration_file) }}" 
                       target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="las la-download"></i>
                    </a>
                </div>
                @endif
                
                @if($user->company_profile)
                <div class="document-item mb-3">
                    <div class="d-flex align-items-center">
                        <i class="las la-file-pdf fs-4 text-danger me-3"></i>
                        <div>
                            <h6 class="mb-0">@lang('Company Profile')</h6>
                            <small class="text-muted">.{{ pathinfo($user->company_profile, PATHINFO_EXTENSION) }}</small>
                        </div>
                    </div>
                    <a href="{{ asset('storage/'.$user->company_profile) }}" 
                       target="_blank" class="btn btn-sm btn-outline-danger">
                        <i class="las la-download"></i>
                    </a>
                </div>
                @endif
                
                @if($user->certificates)
                    @foreach(json_decode($user->certificates) as $index => $certificate)
                    <div class="document-item mb-3">
                        <div class="d-flex align-items-center">
                            <i class="las la-certificate fs-4 text-success me-3"></i>
                            <div>
                                <h6 class="mb-0">@lang('Certificate') {{ $index + 1 }}</h6>
                                <small class="text-muted">.{{ pathinfo($certificate, PATHINFO_EXTENSION) }}</small>
                            </div>
                        </div>
                        <a href="{{ asset('storage/'.$certificate) }}" 
                           target="_blank" class="btn btn-sm btn-outline-success">
                            <i class="las la-download"></i>
                        </a>
                    </div>
                    @endforeach
                @endif
                
                @if($user->portfolio_files)
                    @foreach(json_decode($user->portfolio_files) as $index => $portfolio)
                    <div class="document-item mb-3">
                        <div class="d-flex align-items-center">
                            <i class="las la-briefcase fs-4 text-info me-3"></i>
                            <div>
                                <h6 class="mb-0">@lang('Portfolio') {{ $index + 1 }}</h6>
                                <small class="text-muted">.{{ pathinfo($portfolio, PATHINFO_EXTENSION) }}</small>
                            </div>
                        </div>
                        <a href="{{ asset('storage/'.$portfolio) }}" 
                           target="_blank" class="btn btn-sm btn-outline-info">
                            <i class="las la-download"></i>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif
    </div>
    
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#companyInfo">
                            @lang('Company Info')
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#serviceInfo">
                            @lang('Service Info')
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#contactInfo">
                            @lang('Contact Info')
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content pt-3">
                    <!-- Company Info Tab -->
                    <div class="tab-pane fade show active" id="companyInfo" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Company Name')</span>
                                    <span>{{ $user->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Entity Type')</span>
                                    <span>{{ $user->entity_type ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Commercial Reg. No')</span>
                                    <span>{{ $user->commercial_registration_no ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Company Activity')</span>
                                    <span>{{ $user->company_activity ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Years in Business')</span>
                                    <span>{{ $user->age_of_company ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Team Size')</span>
                                    <span>{{ $user->number_of_work_team ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service Info Tab -->
                    <div class="tab-pane fade" id="serviceInfo" role="tabpanel">
                        <div class="info-item">
                            <span class="fw-bold">@lang('Service Category')</span>
                            <span>{{ $user?->category?->lang('name') ?? 'N/A' }}</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="fw-bold">@lang('Sub Service Category')</span>
                            <span>{{ $user?->subcategory?->lang('name') ?? 'N/A' }}</span>
                        </div>
                        
                        <div class="info-item">
                            <span class="fw-bold">@lang('Service Description')</span>
                            <div class="border p-3 rounded bg-light">
                                {!! nl2br(e($user->service_description ?? 'N/A')) !!}
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <span class="fw-bold">@lang('Past Projects')</span>
                            <div class="border p-3 rounded bg-light">
                                {!! nl2br(e($user->pre_experience_project ?? 'N/A')) !!}
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <span class="fw-bold">@lang('Target Clients')</span>
                            <div>
                                @if($user->target_clients)
                                    @foreach(json_decode($user->target_clients) as $client)
                                        <span class="badge bg-primary me-1">{{ $client }}</span>
                                    @endforeach
                                @else
                                    <span>N/A</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Info Tab -->
                    <div class="tab-pane fade" id="contactInfo" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Contact Person')</span>
                                    <span>{{ $user->person_in_charge ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Job Title')</span>
                                    <span>{{ $user->job_title ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Headquarters')</span>
                                    <span>{{ $user->address_headquarter ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Country')</span>
                                    <span>{{ $user->country->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('City')</span>
                                    <span>{{ $user->address->city ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('State')</span>
                                    <span>{{ $user->address->state ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Zip Code')</span>
                                    <span>{{ $user->address->zip ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Preferred Contact Method')</span>
                                    <span>{{ $user->preferred_communication ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Best Time to Contact')</span>
                                    <span>{{ $user->best_time_to_contact ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Response Time')</span>
                                    <span>{{ $user->estimated_response_time ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold">@lang('Social Media')</span>
                                    <span>{{ $user->social_media ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ban Modal -->
<div class="modal fade" id="banModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if($user->status)
                            @lang('Ban User')
                        @else
                            @lang('Unban User')
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($user->status)
                        <div class="form-group">
                            <label class="fw-bold">@lang('Reason for Ban')</label>
                            <textarea name="reason" class="form-control" rows="3" required></textarea>
                        </div>
                    @else
                        <p>@lang('Are you sure you want to unban this user?')</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-{{ $user->status ? 'danger' : 'success' }}">
                        @if($user->status)
                            @lang('Ban User')
                        @else
                            @lang('Unban User')
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .info-item {
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .document-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    
    .verification-item {
        padding: 8px 0;
    }
    
    .nav-tabs .nav-link {
        font-weight: 500;
    }
</style>
@endpush

@push('script')
<script>
    // Activate Bootstrap tabs
    (function($) {
        "use strict";
        var tab = new bootstrap.Tab(document.querySelector('.nav-tabs .nav-link'));
        tab.show();
    })(jQuery);
</script>
@endpush