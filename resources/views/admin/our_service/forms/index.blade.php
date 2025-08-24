@extends('admin.layouts.app', ['title' => 'Our Service Lists'])
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
                                    <th>@lang('Type')</th>
                                    <th>@lang('Required?')</th>
                                    <th>@lang('Columns')</th>
                                    <th>@lang('Options')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($forms as $form)
                                    <tr>
                                        <td>
                                            {{ $form->name }} <br />
                                            {{ $form->name_ar }}
                                        </td>
                                        <td>
                                            {{ $form->type }}
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $form->required ? 'success' : 'danger' }}">{{ $form->required ? 'Yes' : 'No' }}</span>
                                        </td>
                                        <td>
                                            {{ $form->col }}    
                                        </td>
                                        <td>
                                            @if($form->options)
                                                @foreach($form->options as $option)
                                                    {{ $option }} <br />
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $form->status == 'active' ? 'success' : 'danger' }}">{{ $form->status == 'active' ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a href="{{ route('admin.our_service.forms.edit', ['service_id' => $form->our_service_id , 'id' => $form->id]) }}" class="btn btn-primary">
                                                            <i class="bi bi-pencil"></i> @lang('Edit')
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <button type="button" 
                                                                class="btn btn-danger confirmationBtn" 
                                                                data-question="@lang('Are you sure to delete this service?')"
                                                                data-action="{{ route('admin.our_service.forms.delete', ['service_id' => $form->our_service_id , 'id' => $form->id]) }}">
                                                            <i class="bi bi-trash"></i> @lang('Delete')
                                                        </button>
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
                        </table>
                    </div>
                </div>
                @if ($forms->hasPages())
                    <div class="card-footer pagination-card-footer">
                        {{ paginateLinks($forms) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <div class="flex-wrap gap-3 d-flex justify-content-between mb-3">
        <x-search-form placeholder="Search" />
        <div>
            <a href="{{ route('admin.our_service.forms.create', $service_id) }}" class="btn btn-primary cuModalBtn" data-modal_title="@lang('Add Our Service Form')"><i
                    class="fa-solid fa-plus"></i> @lang('Add New')</a>

            <a href="{{ route('admin.our_service.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-arrow-left"></i> @lang('Back')</a>
        </div>
    </div>
@endpush
