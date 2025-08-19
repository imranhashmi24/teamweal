@extends('admin.layouts.app', ['title' => __('Contact Message Details')])

@section('panel')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="p-0 content-wrapper">
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-capitalize">@lang('Contact Message Details'):</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 card-content collapse show">
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <tr>
                                        <td>@lang('Name'): </td>
                                        <td>{{ $message->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Email'): </td>
                                        <td>{{ $message->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Phone'): </td>
                                        <td>{{ $message->phone }}</td>
                                    </tr>
                                 
                                    <tr>
                                        <td>@lang('Required service'): </td>
                                        <td>{{ $message->capital }}</td>
                                    </tr>

                                </table>
                                <div class="mt-3">

                                    @lang('Message'):
                                    <p class="p-2 border">
                                        {{ $message->message }}
                                    </p>
                                </div>
                                @if ($message->reply)
                                    <div class="mt-3">

                                        @lang('Reply'):
                                        <p class="p-2 border">
                                            {{ $message->reply }}
                                        </p>
                                    </div>
                                @else
                                    <form action="{{ route('admin.messages.update', $message) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="col-12">
                                            <textarea class="form-control" name="reply" placeholder="write your reply here" rows="5">{{ old('message') }}</textarea>
                                            <div class="mt-1 text-center">
                                                <button type="submit" class="px-5 btn btn-success">@lang('Send Message')</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
<div class="flex-wrap gap-3 d-flex">
    <a href="{{ route('admin.messages.index') }}"
    class="mx-2 btn btn-outline-dark"style="border-radius: 30px;">@lang('Back')</i>
 </a>
</div>
@endpush
