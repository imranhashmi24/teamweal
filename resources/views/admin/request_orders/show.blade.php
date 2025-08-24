@extends('admin.layouts.app')

@section('panel')
    <h5 class="mb-4">Order #{{ $order->id }}</h5>

    <div class="card mb-3">
        <div class="card-body">
            <h5>@lang('Details:')</h5>
            <ul>
                <li><strong>@lang('Service'):</strong> {{ $order?->service($order->type, $order->service_id)?->title }}</li>
            </ul>
            <ul>
                @if($order->form_data)
                @foreach(json_decode($order->form_data, true) ?? [] as $key => $value)
                    <li><strong>{{ ucfirst(str_replace('_',' ',$key)) }}:</strong> {{ $value }}</li>
                @endforeach
                @endif
            </ul>

            <ul>
                @if($order->form_checkbox)
                @foreach(json_decode($order->form_checkbox, true) ?? [] as $key => $values)
                    <li><strong>{{ ucfirst($key) }}:</strong> {{ implode(', ', $values) }}</li>
                @endforeach
                @endif
            </ul>

            <ul>
                @if($order->form_radio)
                @foreach(json_decode($order->form_radio, true) ?? [] as $key => $value)
                    <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                @endforeach
                @endif
            </ul>

            <h5>@lang('Files:')</h5>
            <ul>
                @if($order->form_file)
                @foreach(json_decode($order->form_file, true) ?? [] as $key => $files)
                    <li>
                        <strong>{{ ucfirst($key) }}:</strong>
                        @foreach($files as $file)
                            <a href="{{ asset('storage/'.$file) }}" target="_blank">@lang('Download')</a><br>
                        @endforeach
                    </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>

    <form action="{{ route('admin.request_order.update', $order->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>@lang('Update Status')</label>
            <select name="status" class="form-control">
                <option value="pending" @if($order->status=='pending') selected @endif>@lang('Pending')</option>
                <option value="approved" @if($order->status=='approved') selected @endif>@lang('Approved')</option>
                <option value="rejected" @if($order->status=='rejected') selected @endif>@lang('Rejected')</option>
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success mt-2">@lang('Update')</button>
            <a href="{{ route('admin.request_order.index', ['type' => $order->type]) }}" class="btn btn-secondary mt-2">@lang('Back To List')</a>
        </div>
    </form>

    
@endsection
