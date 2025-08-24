@extends('admin.layouts.app', ['title' => __('Edit Our Service')])
@section('panel')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-capitalize">@lang('Edit Our Service')
                <a href="{{ route('admin.our_service.index') }}" class="btn btn-primary float-end">@lang('Back')</a>
            </h4>
        </div>
        <div class="card-body">
                <form action="{{ route('admin.our_service.update', $our_service->id) }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="title">@lang('Title') (en)</label>
                                <input id="title" type="text" placeholder="Title english"
                                       name="title" class="form-control" value="{{ $our_service->title }}" required>
                                <div class="invalid-feedback">
                                    @lang('Title(en) field is required')
                                </div>
                            </div>
                        </div>
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="title_ar">@lang('Title') (ar)</label>
                                <input id="title_ar" type="text" placeholder="Title (arabic)"
                                       name="title_ar" class="form-control" value="{{ $our_service->title_ar }}">
                            </div>
                        </div>
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="description">@lang('Description') (en)</label>
                                <textarea id="description" type="text" placeholder="Description english"
                                       name="description" class="form-control">
                                    {{ $our_service->description }}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">  
                            <div class="mb-1">
                                <label for="description_ar">@lang('Description') (ar)</label>
                                <textarea id="description_ar" type="text" placeholder="Description (arabic)"
                                       name="description_ar" class="form-control">
                                    {{ $our_service->description_ar }}
                                </textarea>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="image">@lang('Image') (@lang('Size'): {{ getFileSize('our_service') }})</label>
                                <input id="image" type="file" name="image" class="form-control">
                            </div>

                            <div class="mb-1">
                                <img 
                                    src="{{ getImage(getFilePath('our_service') . '/' . $our_service->image, getFileSize('our_service')) }}" 
                                    alt="{{ $our_service->title }}" 
                                    class="img-fluid"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="status">@lang('Status')</label>
                                <select class="form-select" name="status">
                                    <option value="active" {{ $our_service->status == 'active' ? 'selected' : '' }}>
                                        @lang('Active')
                                    </option>
                                    <option value="inactive" {{ $our_service->status == 'inactive' ? 'selected' : '' }}>
                                        @lang('Inactive')
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-2 text-center col-12">
                            <a href="{{ route('admin.our_service.index') }}" class="btn btn-danger">@lang('Cancel')</a>
                            <button type="submit" class="mx-2 btn btn-success">@lang('Save')</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
@endsection
