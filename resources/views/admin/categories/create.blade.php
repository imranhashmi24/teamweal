@extends('admin.layouts.app', ['title' => __('Add Category')])
@section('panel')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-capitalize">@lang('Add New Service Category')
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary float-end">@lang('Back')</a>
            </h4>
        </div>
        <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="parent_id">@lang('Category')</label>
                                <select class="form-select select2" name="parent_id">
                                    <option value="0">
                                        @lang('Select category')
                                    </option>
                                    @foreach (\App\Models\Category::where('parent_id', 0)->get() as $pcategory)
                                        <option value="{{ $pcategory->id }}" {{ old('parent_id', @$category->parent_id) == $pcategory->id ? 'selected' : '' }}>
                                            {{ $pcategory?->lang('name') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="name">@lang('Category Name') (en)</label>
                                <input id="name" type="text" placeholder="Category name english"
                                       name="name" class="form-control" value="{{ old('name') }}" required>
                                <div class="invalid-feedback">
                                    @lang('Title(en) field is required')
                                </div>
                            </div>
                        </div>
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="name_ar">@lang('Category Name') (ar)</label>
                                <input id="name_ar" type="text" placeholder="Category name (arabic)"
                                       name="name_ar" class="form-control" value="{{ old('name_ar') }}">
                            </div>
                        </div>
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="position">@lang('Position')</label>
                                <input id="position" type="text" placeholder="{{ __('position') }}"
                                       name="position" class="form-control" value="{{ old('position') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="image">@lang('Image') (@lang('ratio') 3:2)</label>
                                <input id="image" type="file" name="image" class="form-control" required>
                                <div class="invalid-feedback">
                                    @lang('The Image field is required.')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-2 text-center col-12">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">@lang('Cancel')</a>
                            <button type="submit" class="mx-2 btn btn-success">@lang('Save Category')</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
@endsection


@push('script')
    @include('partials.validate')
@endpush
