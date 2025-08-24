@extends('admin.layouts.app', ['title' => 'Request Services'])
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--md table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>@lang('Service')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order?->service($order->type, $order->service_id)?->title }}
                                        </td>
                                        <td>

                                            @if($order->status == 'pending')
                                                <span class="badge bg-warning">@lang('Pending')</span>
                                            @elseif($order->status == 'approved')
                                                <span class="badge bg-success">@lang('Approved')</span>
                                            @elseif($order->status == 'rejected')
                                                <span class="badge bg-danger">@lang('Rejected')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                       <a href="{{ route('admin.request_order.show', $order->id) }}" class="btn btn-primary">
                                                        <i class="bi bi-pencil"></i>@lang('Show')
                                                       </a>
                                                    </li>
                                                    <li>
                                                        <button type="button" 
                                                            class="btn btn-danger confirmationBtn" 
                                                            data-question="@lang('Are you sure to delete this service?')" 
                                                            data-action="{{ route('admin.request_order.delete', $order->id) }}">
                                                            <i class="bi bi-trash"></i>@lang('Delete')
                                                        </button>
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
                @if ($orders->hasPages())
                    <div class="card-footer pagination-card-footer">
                        {{ paginateLinks($orders) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <div class="flex-wrap gap-3 d-flex justify-content-between mb-3">
        <x-search-form placeholder="Search" /> 
    </div>
@endpush

