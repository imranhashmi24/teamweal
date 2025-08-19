

@extends('admin.layouts.app', ['title' => 'Cities'])
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--md table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th> @lang('Name') (@lang('Arabic'))</th>
                                    <th>@lang('Country')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cities as $city)
                                    <tr>

                                        <td> {{ $city->name }} </td>
                                        <td> {{ $city->name_ar }} </td>
                                        <td>
                                            @if (app()->getLocale() == 'en')
                                                {{@$city->country->name}}
                                            @else
                                              {{@$city->country->name_ar}}
                                            @endif
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('admin.city.edit', $city->id) }}">
                                                            <i class="bi bi-pencil"></i>@lang('Edit')
                                                        </a>
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
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($cities->hasPages())
                    <div class="card-footer pagination-card-footer">
                        {{ paginateLinks($cities) }}
                    </div>
                @endif
            </div>
        </div>


    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="flex-wrap gap-3 d-flex">
        <x-search-form placeholder="Search" />
        <a href="{{ route('admin.city.create') }}" class="btn btn-primary"> <i class="fa-solid fa-plus"></i>@lang('Add New')</a>
    </div>
@endpush
