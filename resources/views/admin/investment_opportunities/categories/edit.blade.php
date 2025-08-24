@extends('admin.layouts.app', ['title' => $title])
@section('panel')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-capitalize">@lang('Edit Our Service List')
                <a href="{{ route($route.'.index') }}" class="btn btn-primary float-end">@lang('Back')</a>
            </h4>
        </div>
        <div class="card-body">
                <form action="{{ route($route.'.update', ['id' => $data->id]) }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">

                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="parent_id">@lang('Parent Category')</label>
                                <select class="form-select" name="parent_id">
                                    <option value="">@lang('Select Parent Category')</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $data->parent_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="title">@lang('Title') (en)</label>
                                <input id="title" type="text" placeholder="Title english"
                                       name="title" class="form-control" value="{{ $data->title }}" required>
                                <div class="invalid-feedback">
                                    @lang('Title(en) field is required')
                                </div>
                            </div>
                        </div>
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="title_ar">@lang('Title') (ar)</label>
                                <input id="title_ar" type="text" placeholder="Title (arabic)"
                                       name="title_ar" class="form-control" value="{{ $data->title_ar }}">
                            </div>
                        </div>


                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="image">@lang('Image') (@lang('Size'): {{ getFileSize($file_path) }})</label>
                                <input id="image" type="file" name="image" class="form-control">
                                <div class="invalid-feedback">
                                    @lang('The Image field is required. ' . getFileSize($file_path))
                                </div>
                                <img src="{{ getImage(getFilePath($file_path) . '/' . $data?->image, getFileSize($file_path)) }}" alt="" class="img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        </div>
                    
                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="status">@lang('Status')</label>
                                <select class="form-select" name="status">
                                    <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>
                                        @lang('Active')
                                    </option>
                                    <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>
                                        @lang('Inactive')
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-2 text-center col-12">
                            <a href="{{ route($route.'.index') }}" class="btn btn-danger">@lang('Cancel')</a>
                            <button type="submit" class="mx-2 btn btn-success">@lang('Save')</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
@endsection
