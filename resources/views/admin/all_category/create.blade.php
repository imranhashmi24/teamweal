@extends('admin.layouts.app', ['title' => @$title])
@section('panel')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.all_category.store', @$all_category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">@lang('Image') <span class="text-danger fs-6">*</span></label>
                        <x-image-uploader image="{{ @$all_category->image }}" name="image" class="w-100" type="all_category"/>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Type') <span class="text-danger fs-6">*</span></label>
                            <select class="form-control" name="type">
                                <option value="0">@lang('Select one')</option>
                                <option value="event" {{ old('type', @$all_category->type) == 'event' ? 'selected' : '' }}>@lang('Event')</option>
                                <option value="others" {{ old('type', @$all_category->type) == 'others' ? 'selected' : '' }}>@lang('Others')</option>
                            </select>
                        </div>


                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Name') <span class="text-danger fs-6">*</span></label>
                            <input type="text" name="title" class="form-control" required
                                value="{{ old('title', @$all_category->title) }}">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Name Ar') <span class="text-danger fs-6">*</span></label>
                            <input type="text" name="title_ar" class="form-control" required
                                value="{{ old('title_ar', @$all_category->title_ar) }}">
                        </div>

                        <div class="mb-3 form-group">
                            <button type="submit" class="btn btn-primary w-100">@lang('Submit')</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.city.index') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i>
        @lang('Back')</a>
@endpush

@push('script')
    <script>
        $('.select2-basic').select2({
            dropdownParent: $('.card-body')
        });
    </script>
@endpush

