@extends('admin.layouts.app', ['title' => @$title])
@section('panel')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-end gap-3">
            <a href="{{ route('admin.users.download.excel') }}" class="btn btn-success">
                <i class="las la-file-excel"></i> @lang('Download Excel')
            </a>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--md table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>@lang('Company/Individual')</th>
                                    <th>@lang('Entity Type')</th>
                                    <th>@lang('Contact Info')</th>
                                    <th>@lang('Services')</th>
                                    <th>@lang('Registration')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ $user->company_name ?? $user->name }}</span>
                                            <br>
                                            <span class="small">
                                                <a href="{{ route('admin.users.detail', $user->id) }}">
                                                    <span>@</span>{{ $user->username }}
                                                </a>
                                            </span>
                                            @if($user->entity_type)
                                                <br>
                                                <span class="badge bg-primary">{{ $user->entity_type }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ ucfirst($user->entity_type) }}
                                            @if($user->commercial_registration_no)
                                                <br>
                                                <small class="text-muted">@lang('CR No.'): {{ $user->commercial_registration_no }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div><i class="las la-envelope"></i> {{ $user->email }}</div>
                                            <div><i class="las la-phone"></i> {{ $user->mobile }}</div>
                                            @if($user->website)
                                                <div><i class="las la-globe"></i> {{ $user->website }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->services_provided)
                                                <span class="badge bg-info">{{ $user->services_provided }}</span>
                                            @endif
                                            @if($user->category)
                                                <br>
                                                <small>{{ $user->category->name }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div>@lang('Joined'): {{ showDateTime($user->created_at) }}</div>
                                            @if($user->commercial_registration_file)
                                                <div>
                                                    <a href="{{ asset('storage/'.$user->commercial_registration_file) }}" target="_blank">
                                                        <i class="las la-file-alt"></i> @lang('View CR')
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = $user->status ? 'success' : 'danger';
                                                $statusText = $user->status ? 'Active' : 'Banned';
                                            @endphp
                                            <span class="badge bg-{{ $statusClass }}">{{ $statusText }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('admin.users.detail', $user->id) }}">
                                                            <i class="las la-desktop"></i> @lang('Details')
                                                        </a>
                                                    </li>
                                                   
                                                    @if($user->status)
                                                        <li>
                                                            <a href="javascript:void(0)" class="confirmationBtn" 
                                                               data-action="{{ route('admin.users.status', $user->id) }}" 
                                                               data-question="@lang('Are you sure to ban this user?')">
                                                                <i class="las la-ban"></i> @lang('Ban')
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="javascript:void(0)" class="confirmationBtn" 
                                                               data-action="{{ route('admin.users.status', $user->id) }}" 
                                                               data-question="@lang('Are you sure to unban this user?')">
                                                                <i class="las la-check-circle"></i> @lang('Unban')
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('admin.users.notification.single', $user->id) }}">
                                                            <i class="las la-bell"></i> @lang('Send Notification')
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-muted" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($users->hasPages())
                    <div class="card-footer pagination-card-footer">
                        {{ paginateLinks($users) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="flex-wrap gap-3 d-flex">
        <x-search-form placeholder="Search by username, email, company name or CR number" />
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="las la-filter"></i> @lang('Filter')
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['entity_type' => 'Company']) }}">@lang('Companies')</a></li>
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['entity_type' => 'Establishment']) }}">@lang('Establishments')</a></li>
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['entity_type' => 'Individual']) }}">@lang('Individuals')</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ request()->url() }}">@lang('All')</a></li>
            </ul>
        </div>
        <a href="{{ route('admin.users.export.excel') }}" class="btn btn-primary">
            <i class="fa-solid fa-export"></i> @lang('Export')
        </a>
    </div>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            
            // Confirmation for ban/unban actions
            $('.confirmationBtn').on('click', function () {
                let modal = $('#confirmationModal');
                modal.find('.modal-text').text($(this).data('question'));
                modal.find('form').attr('action', $(this).data('action'));
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush