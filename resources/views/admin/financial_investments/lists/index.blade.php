@extends('admin.layouts.app', ['title' => $title])
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--md table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Title Arabic')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($datas as $list)
                                    <tr>
                                        <td>
                                            {{ $list->title }}
                                        </td>
                                        <td>
                                            {{ $list->title_ar }}
                                        </td>
                                    
                                        <td>
                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route($route.'.edit', ['service_id' => $list->service_id , 'id' => $list->id]) }}" class="btn btn-primary">
                                                            <i class="bi bi-pencil"></i> @lang('Edit')
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <button type="button" 
                                                                class="btn btn-danger confirmationBtn" 
                                                                data-question="@lang('Are you sure to delete this service list?')"
                                                                data-action="{{ route($route.'.delete', ['service_id' => $list->service_id , 'id' => $list->id]) }}">
                                                            <i class="bi bi-trash"></i> @lang('Delete')
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
                @if ($datas->hasPages())
                    <div class="card-footer pagination-card-footer">
                        {{ paginateLinks($datas) }}
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
        <div>
            <a href="{{ route($route.'.create', $service_id) }}" class="btn btn-primary cuModalBtn" data-modal_title="@lang('Add Our Service List')"><i
                    class="fa-solid fa-plus"></i> @lang('Add New')</a>

            <a href="{{ route($route.'.index', $service_id) }}" class="btn btn-primary">
                <i class="fa-solid fa-arrow-left"></i> @lang('Back')</a>
        </div>
    </div>
@endpush
