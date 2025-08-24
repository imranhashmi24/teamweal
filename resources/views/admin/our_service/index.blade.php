@extends('admin.layouts.app', ['title' => 'Our Services'])
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
                                    <th>@lang('Description')</th>
                                    <th>@lang('Description Arabic')</th>
                                    <th>@lang('Image')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($our_services as $service)
                                    <tr>
                                        <td>
                                            {{ $service->title }}
                                        </td>
                                        <td>
                                            {{ $service->title_ar }}
                                        </td>
                                        <td>
                                            {{ $service->description }}
                                        </td>
                                        <td>
                                            {{ $service->description_ar }}
                                        </td>

                                        <td>
                                            <img src="{{ getImage(getFilePath('our_service') . '/' . $service->image, getFileSize('our_service')) }}" alt="" class="img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                       <a href="{{ route('admin.our_service.edit', $service->id) }}" class="btn btn-primary">
                                                        <i class="bi bi-pencil"></i>@lang('Edit')
                                                       </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.our_service.lists.index', $service->id) }}" class="btn btn-primary">
                                                            <i class="bi bi-list"></i>@lang('Lists')
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.our_service.forms.index', $service->id) }}" class="btn btn-primary">
                                                            <i class="bi bi-list"></i>@lang('Forms')
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <button type="button" 
                                                            class="btn btn-danger confirmationBtn" 
                                                            data-question="@lang('Are you sure to delete this service?')" 
                                                            data-action="{{ route('admin.our_service.delete', $service->id) }}">
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
                @if ($our_services->hasPages())
                    <div class="card-footer pagination-card-footer">
                        {{ paginateLinks($our_services) }}
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
            <a href="{{ route('admin.our_service.create') }}" class="btn btn-primary"><i
                    class="fa-solid fa-plus"></i> @lang('Add New')</a>
        </div>
    </div>
@endpush

