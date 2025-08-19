<form method="POST" id="deleteForm">
    @csrf
    @method('delete')
</form>

@push('script')
<script>
    function deleteItem(id) {
        let deleteRoute = `{!! request()->url()!!}/delete/${id}`;
        Swal.fire({
            title: 'Are you sure?'
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonText: 'Yes, delete it!'
            , customClass: {
                confirmButton: 'btn btn-primary'
                , cancelButton: 'btn btn-outline-danger ms-1'
            }
            , buttonsStyling: false
        }).then(function(result) {
            console.log(result);
            if (result.value) {
                $('#deleteForm').attr('action', deleteRoute).submit();
            }
        });
    }

</script>
@endpush
