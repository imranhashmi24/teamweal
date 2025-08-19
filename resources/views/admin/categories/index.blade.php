@extends('admin.layouts.app', ['title' => __('All Category')])
@section('panel')
   
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-capitalize">@lang('All Service Categories') 
            
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary float-end">@lang('Add Category')</a>
                
                <div class="flex-wrap gap-3 d-flex float-end">
                    <x-search-form placeholder="Search" />
                    @if (request()->filled('q'))
                        <a class="btn btn-outline-dark" href="{{ request()->url() }}">@lang('Clear Filter')</a>
                    @endif
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filterModal">
                        Filter
                    </button>
                </div>
            </h4>
            
        </div>
       
        <div class="card-body">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>@lang('SL')</th>
                                <th>@lang('Image')</th>
                                <th>@lang('Parent Category')</th>
                                <th>@lang('Name')(En)</th>
                                <th>@lang('Name')(Ar)</th>
                                <th>@lang('Is Featured')</th>
                                <th>@lang('Position')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.show', $category->id) }}">
                                            <img class="ad-img"
                                                 src="{{ $category->image_url }}"
                                                 alt="Not found">
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.categories.show', $category->id) }}">
                                            {{ $category?->parent?->name }}
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.categories.show', $category->id) }}">
                                            {{ $category->name }}
                                        </a>
                                    </td>
                                    <td>{{ $category->name_ar }}</td>
                                    <td>
                                        <form action="{{ route('admin.categories.update', $category) }}"
                                              method="POST">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="update_featured" value="1">
                                            <div class="form-check form-switch">
                                                <input name="is_featured" class="form-check-input" type="checkbox"
                                                       onchange="$(this).parent().parent().submit()"
                                                       {{ $category->is_featured ? 'checked' : '' }}>
                                            </div>
                                        </form>
                                    </td>
                                    <td>{{ $category->position }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                    href="{{ route('admin.service.create') }}">
                                                        <i data-feather="plus" class="me-50"></i>
                                                        <span>@lang('Add Service')</span>
                                                    </a>
                                                    <a class="dropdown-item"
                                                    href="{{ route('admin.service.index') }}?category_id={{ $category->id }}">
                                                        <i data-feather="list" class="me-50"></i>
                                                        <span>@lang('List Services')</span>
                                                    </a>
                                                    <a class="dropdown-item"
                                                    href="{{ route('admin.categories.edit', ['id' => $category->id]) }}">
                                                        <i data-feather="edit-2" class="me-50"></i>
                                                        <span>@lang('Edit')</span>
                                                    </a>
                                                    <a class="dropdown-item" href="#"
                                                    onclick="deleteItem({{ $category->id }})">
                                                        <i data-feather="trash" class="me-50"></i>
                                                        <span>@lang('Delete')</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        @once
                                            @push('html')
                                                @include('admin.components.delete')
                                            @endpush
                                        @endonce
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $categories->links() }}
            </div>
        
    </div>
                   

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="filterModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
         aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Filter </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="">Search</label>
                            <input type="text" name="q" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('filterModal'), options)
    </script>
@endsection


@push('breadcrumb-plugins')
<div class="flex-wrap gap-3 d-flex">
    <x-search-form placeholder="Search" />
    <div>
        @if (request()->filled('q'))
            <a class="btn btn-outline-dark" href="{{ request()->url() }}">@lang('Clear Filter')</a>
        @endif
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filterModal">
            Filter
        </button>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">@lang('Add Category')</a>
    </div>
</div>
@endpush


@push('script')
    @include('partials.validate')
@endpush

