@isset($id)
<a href="{{ route('web.pages.service_requests.create', ['id' => $service->id]) }}" class="btn btn-primary">@lang('Send Request')</a>
@else
<a href="{{ route('web.pages.service_requests.create') }}" class="btn btn-primary">@lang('Send Request')</a>
@endisset
