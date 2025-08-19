@extends('admin.layouts.app', ['title' => __('Messages')])
@section('panel')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="p-0 content-wrapper">
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-capitalize">@lang('Contact Messages')</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @if ($messages->count())
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>@lang('SL')</th>
                                                <th>@lang('Name')</th>
                                                <th>@lang('Email')</th>
                                                <th>@lang('Status')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($messages as $message)
                                                <tr class="{{ $message->seen_at ? '' : 'fw-bold table-light' }}">
                                                    <td>{{ $loop->index + 1 }}</td>

                                                    <td>{{ $message->name }}</td>
                                                    <td>
                                                        <a
                                                           href="{{ route('admin.messages.show', $message->id) }}">{{ $message->email }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $message->reply ? 'Replyed' : 'Not Replyed' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.messages.show', $message) }}"
                                                           class="btn btn-sm btn-success">
                                                            <i data-feather="eye" class="me-50"></i>
                                                            @lang('View')</a>
                                                        <button class="btn btn-danger btn-sm"
                                                                onclick="deleteItem({{ $message->id }})">
                                                            <i data-feather="trash" class="me-50"></i>
                                                            <span>@lang('Delete')</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <h5 class="text-center">@lang('No data found<')/h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.components.delete')
@endsection



@push('breadcrumb-plugins')
<div class="flex-wrap gap-3 d-flex">
    <x-search-form placeholder="Search" />
</div>
@endpush
