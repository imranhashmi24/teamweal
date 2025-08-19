@extends('admin.layouts.app', ['title' => @$title])
@section('panel')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blog.store', @$blog->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <x-image-uploader image="{{ @$blog->image }}" name="image" class="w-100" type="blog" />
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Category')</label>
                            <select name="blog_category_id" id="blog_category_id" class="form-control">
                                <option value="">@lang('Select one')</option>
                                @foreach (App\Models\BlogCategory::get() as $category)
                                    <option {{ @$blog->blog_category_id == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Title')</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', @$blog->title) }}">
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Title') (@lang('Arabic'))</label>
                            <input type="text" name="title_ar" class="form-control"
                                value="{{ old('title_ar', @$blog->title) }}">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Slug')</label>
                            <input type="text" name="slug" class="form-control"
                                value="{{ old('slug', @$blog->slug) }}">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Description')</label>
                            <textarea class="form-control nicEdit" name="description" rows="8">@php echo @$blog->description @endphp</textarea>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">@lang('Description') (@lang('Arabic'))</label>
                            <textarea class="form-control nicEdit" name="description_ar" rows="8">@php echo @$blog->description_ar @endphp</textarea>
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
    <a href="{{ route('admin.blog.index') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i>
        @lang('Back')</a>
@endpush

@push('script')
    <script>
        $("input[name=title]").on('keyup', function() {
            let name = $(this).val();
            var slug = slugify(name);
            $("input[name=slug]").val(slug)
        })

        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }
    </script>
@endpush
