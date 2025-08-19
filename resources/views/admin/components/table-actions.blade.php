<div class="btn-group">
    <div class="dropdown">
        <button data-bs-toggle="dropdown">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ request()->url() . '/edit' .'/' .$id }}">
                <i data-feather="edit-2" class="me-50"></i>
                <span>@lang('Edit')</span>
            </a>
            <a class="dropdown-item" href="#" onclick="deleteItem(`{{ $id }}`)">
                <i data-feather="trash" class="me-50"></i>
                <span>@lang('Delete')</span>
            </a>
        </div>
    </div>
</div>


@once
@push('html')
@include('admin.components.delete')
@endpush
@endonce
