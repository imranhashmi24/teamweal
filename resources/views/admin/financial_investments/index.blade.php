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
                                    <th>@lang('Description')</th>
                                    <th>@lang('Description Arabic')</th>
                                    <th>@lang('Image')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($datas as $data)
                                    <tr>
                                        <td>
                                            {{ $data->title }}
                                        </td>
                                        <td>
                                            {{ $data->title_ar }}
                                        </td>
                                        <td>
                                            {{ $data->description }}
                                        </td>
                                        <td>
                                            {{ $data->description_ar }}
                                        </td>

                                        <td>
                                            <img src="{{ getImage(getFilePath($file_path) . '/' . $data->image, getFileSize($file_path)) }}" alt="" class="img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                       <a href="{{ route($route.'.edit', $data->id) }}" class="btn btn-primary">
                                                        <i class="bi bi-pencil"></i>@lang('Edit')
                                                       </a>
                                                    </li>

                                                    @if ($is_list)
                                                    <li>
                                                        <a href="{{ route($route.'.lists.index', $data->id) }}" class="btn btn-primary">
                                                            <i class="bi bi-list"></i>@lang('Lists')
                                                        </a>
                                                    </li>
                                                    @endif

                                                    @if ($is_form)
                                                    <li>
                                                        <a href="{{ route($route.'.forms.index', $data->id) }}" class="btn btn-primary">
                                                            <i class="bi bi-list"></i>@lang('Forms')
                                                        </a>
                                                    </li>
                                                    @endif

                                                    <li>
                                                        <button type="button" 
                                                            class="btn btn-danger confirmationBtn" 
                                                            data-question="{{ __('Are you sure to delete this') . __($title) . __('?') }}" 
                                                            data-action="{{ route($route.'.delete', $data->id) }}">
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
            <a href="{{ route($route.'.create') }}" class="btn btn-primary"><i
                    class="fa-solid fa-plus"></i> @lang('Add New')</a>
        </div>
    </div>
@endpush

