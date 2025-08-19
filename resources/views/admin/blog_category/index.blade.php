@extends('admin.layouts.app', ['title' => __('Blog Category')])
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="flex-wrap gap-3 d-flex">
                        <x-search-form placeholder="Search" />
                        <div>
                            <button class="btn btn-primary cuModalBtn" data-modal_title="@lang('Add Category')"><i
                                    class="fa-solid fa-plus"></i> @lang('Add New')</button>
                        </div>
                    </div>
                </div>
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

                                @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->title }}
                                        </td>
                                        <td>
                                            {{ $category->title_ar }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button class="cuModalBtn" data-modal_title="@lang('Update Category')"
                                                            data-resource="{{ $category }}">
                                                            <i class="bi bi-pencil"></i>@lang('Edit')
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
                @if ($categories->hasPages())
                    <div class="card-footer pagination-card-footer">
                        {{ paginateLinks($categories) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.blog.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Title')</label>
                            <input class="form-control" name="title" type="text" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Title Arabic')</label>
                            <input class="form-control" name="title_ar" type="text" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary w-100" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="flex-wrap gap-3 d-flex">
        <x-search-form placeholder="Search" />
        <div>
            <button class="btn btn-primary cuModalBtn" data-modal_title="@lang('Add Category')"><i
                    class="fa-solid fa-plus"></i> @lang('Add New')</button>
        </div>
    </div>
@endpush

@push('script')
    <script>
        $('.select2-basic').select2({
            dropdownParent: $('#cuModal')
        });
    </script>
@endpush
