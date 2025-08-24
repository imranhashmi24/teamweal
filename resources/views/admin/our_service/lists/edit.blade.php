@extends('admin.layouts.app', ['title' => __('Add Our Service List')])
@section('panel')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-capitalize">@lang('Add New Our Service List')
                <a href="{{ route('admin.our_service.lists.index', $service_id) }}" class="btn btn-primary float-end">@lang('Back')</a>
            </h4>
        </div>
        <div class="card-body">
                <form action="{{ route('admin.our_service.lists.update', ['service_id' => $service_id, 'id' => $our_service_list->id]) }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="our_service_id" value="{{ $service_id }}">

                    <div class="row">
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="title">@lang('Title') (en)</label>
                                <input id="title" type="text" placeholder="Title english"
                                       name="title" class="form-control" value="{{ $our_service_list->title }}" required>
                                <div class="invalid-feedback">
                                    @lang('Title(en) field is required')
                                </div>
                            </div>
                        </div>
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="title_ar">@lang('Title') (ar)</label>
                                <input id="title_ar" type="text" placeholder="Title (arabic)"
                                       name="title_ar" class="form-control" value="{{ $our_service_list->title_ar }}">
                            </div>
                        </div>
                    
                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="status">@lang('Status')</label>
                                <select class="form-select" name="status">
                                    <option value="active" {{ $our_service_list->status == 'active' ? 'selected' : '' }}>
                                        @lang('Active')
                                    </option>
                                    <option value="inactive" {{ $our_service_list->status == 'inactive' ? 'selected' : '' }}>
                                        @lang('Inactive')
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-2 text-center col-12">
                            <a href="{{ route('admin.our_service.lists.index', $service_id) }}" class="btn btn-danger">@lang('Cancel')</a>
                            <button type="submit" class="mx-2 btn btn-success">@lang('Save')</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
@endsection
