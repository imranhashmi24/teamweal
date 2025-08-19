@props([
    'route' => 'search'
])

<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-top custom-search-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">{{ __('Search') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="{{ __('Search') }} {{ __('Services') }} ..."
                        autocomplete="off">
                </div>
                <div id="suggestions" class="list-group"></div>
                <div id="recentSearches" class="mt-3">
                    <h6>@lang('Recent Searches')</h6>
                    <ul class="list-group"></ul>

                    <div class="text-center mt-3">
                        <span class="clear-recent-searches">@lang('Clear all')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('style')
    <style>


        .search-area {
            display: flex;
            align-items: center;
        }

        .search-area .btn {
            margin-right: 10px;
        }

        .custom-search-modal {
            min-width: 300px;
            max-width: 400px;
            margin-top: 120px;
            z-index: 1055;
        }

        .list-group{
            max-height: 200px;
            overflow-y: auto;
        }

        .clear-recent-searches {
            cursor: pointer;
            color: #d34e10;
        }
    </style>
@endpush

@push('script')
    <script>

        $(document).ready(function() {
            var recentSearches = JSON.parse(localStorage.getItem('recentSearches')) || [];

            $('#recentSearches ul').html('');

            if (recentSearches.length > 0) {
                $('#recentSearches').show();
            } else {
                $('#recentSearches').hide();
            }

            recentSearches.forEach(element => {
                if (!element || typeof element.title !== 'string' || element.title.trim() === '') {
                    return;
                }

                $('#recentSearches ul').append(`
                    <li class="list-group-item d-flex justify-content-between align-items-center clickable"  data-title="${element.title}" data-url="${element.url}">
                        ${element.title}
                        <span><i class="fa-solid fa-arrow-right"></i></span>
                    </li>
                `);
            });
        });


        $('#searchInput').on('input', function() {
            var search = $(this).val();
            if (search.length > 0) {
                $.ajax({
                    url: "{{ route($route) }}",
                    data: {
                        search: search
                    },
                    success: function(data) {

                        $('#suggestions').html('');
                        if (data.services.length > 0) {
                            data.services.forEach(element => {
                                $('#suggestions').append(`
                                <a href="${element.url}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center clickable" data-title="${element.title}" data-url="${element.url}">
                                    ${element.title}
                                    <span><i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            `);
                            });
                        } else {
                            $('#suggestions').html(`
                            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                @lang('No result found')
                            </div>
                        `);
                        }
                    }
                });
            } else {
                $('#suggestions').html('');
            }
        });

        $(document).on('click', '.clickable', function() {
            var recentSearches = JSON.parse(localStorage.getItem('recentSearches')) || [];
            var title = $(this).data('title');
            
             if (recentSearches.length > 0) {
                var index = recentSearches.findIndex(x => x.title === title);
                if (index !== -1) {
                    recentSearches.splice(index, 1);
                }
            }
            
            var url = $(this).data('url');
            recentSearches.push({
                title: title,
                url: url
            });

            localStorage.setItem('recentSearches', JSON.stringify(recentSearches));
            $('#searchModal').modal('hide');
            window.location.href = url;
        });

        $(document).on('click', '.clear-recent-searches', function() {
            localStorage.removeItem('recentSearches');
            $('#recentSearches ul').html('');
            $('#recentSearches').hide();
        });

        $(document).ready(function() {
            $recentSearches = JSON.parse(localStorage.getItem('recentSearches')) || [];
            if ($recentSearches.length > 0) {
                $('#recentSearches').show();
            } else {
                $('#recentSearches').hide();
            }
        });
    </script>
@endpush
