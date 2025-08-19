@extends('admin.layouts.app', ['title' => @$title])
@section('panel')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.city.store', @$city->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">@lang('Image') <span class="text-danger fs-6">*</span></label>
                        <x-image-uploader image="{{ @$city->image }}" name="image" class="w-100" type="city"/>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Country') <span class="text-danger fs-6">*</span></label>
                            <select class="form-control select2-basic" name="country_id" required>
                                <option value="">@lang('Select One')</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected(old('country_id', @$country->id == @$city->country_id))>{{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Name') <span class="text-danger fs-6">*</span></label>
                            <input type="text" name="name" class="form-control" required
                                value="{{ old('name', @$city->name) }}">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Name Ar') <span class="text-danger fs-6">*</span></label>
                            <input type="text" name="name_ar" class="form-control" required
                                value="{{ old('name_ar', @$city->name_ar) }}">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Latitude') <span class="text-danger fs-6">*</span></label>
                            <input type="text" name="lat" class="form-control" required
                                value="{{ old('lat', @$city->lat) }}">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Longitude') <span class="text-danger fs-6">*</span></label>
                            <input type="text" name="lng" class="form-control" required
                                value="{{ old('lng', @$city->lng) }}">
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

