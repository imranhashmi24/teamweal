@extends('admin.layouts.app', ['title' => $category->name])

@section('panel')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="p-0 content-wrapper container-xxl">
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-capitalize">{{ $category->name }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>@lang('Category Name')(en)</th>
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('Category Name')(ar)</th>
                                <td>{{ $category->name_ar }}</td>
                            </tr>
                            <tr>
                                <th>@lang('Image')</th>
                                <td>
                                    @include('admin.components.image-link', [
                                        'url' => $category->image_url,
                                    ])
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
<div class="flex-wrap gap-3 d-flex">
    <div>
        <a href="{{ route('admin.categories.index') }}"
        class="mx-2 btn btn-outline-dark"style="border-radius: 30px;">@lang('Back')</i>
     </a>
    </div>
</div>
@endpush
