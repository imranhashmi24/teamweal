@extends('web.layouts.master', ['title' => 'Favorite'])
@section('content')
<div class="card custom-card">
    <div class="card-body">
        <div class="table-responsive--md table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> @lang('Title') </th>
                        <th>@lang('Type')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($favorites as $favorite)
                        <tr>
                            <td>
                                <div class="gap-2 d-flex align-items-center">
                                    @lang('N/A')
                                </div>
                            </td>
                            <td> @lang('N/A')</td>

                            <td>

                                @lang('N/A')

                            </td>
                            <td>
                                <div>
                                    <button
                                        class="btn btn-sm btn-outline-danger confirmationBtn"
                                        data-question="@lang('Are you sure to Remove Favorite Property?')"
                                        data-action="{{ route('user.favorite.remove', $favorite->id) }}">
                                        <i class="bi bi-trash me-1"></i>@lang('Remove Favorite')
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="100%">{{ __($emptyMessage) }}
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table><!-- table end -->
        </div>
    </div>
    @if ($favorites->hasPages())
        <div class="card-footer pagination-card-footer">
            {{ paginateLinks($favorites) }}
        </div>
    @endif
</div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <div class="flex-wrap gap-3 d-flex">
        <x-search-form placeholder="Search" />
    </div>
@endpush
