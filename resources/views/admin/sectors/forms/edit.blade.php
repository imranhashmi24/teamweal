@extends('admin.layouts.app', ['title' => $title])
@section('panel')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-capitalize">@lang('Edit Our Service Form')
                <a href="{{ route($route.'.index', $service_id) }}" class="btn btn-primary float-end">@lang('Back')</a>
            </h4>
        </div>
        <div class="card-body">
                <form action="{{ route($route.'.update', ['service_id' => $service_id , 'id' => $form->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="name">@lang('Name') ({{__('english')}})</label>
                                <input id="name" type="text" placeholder="Name english"
                                       name="name" class="form-control" value="{{ $form->name }}" required>
                                <div class="invalid-feedback">
                                    @lang('Name(en) field is required')
                                </div>
                            </div>
                        </div>
                       <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="name_ar">@lang('Name') ({{__('arabic')}})</label>
                                <input id="name_ar" type="text" placeholder="Name (arabic)"
                                       name="name_ar" class="form-control" value="{{ $form->name_ar }}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="type">@lang('Type')</label>
                                <select class="form-select" name="type" id="type" onchange="typeChange()">
                                    <option value="title" {{ $form->type == 'title' ? 'selected' : '' }}>
                                        @lang('Title')
                                    </option>
                                    <option value="text" {{ $form->type == 'text' ? 'selected' : '' }}>
                                        @lang('Text')
                                    </option>
                                    <option value="number" {{ $form->type == 'number' ? 'selected' : '' }}>
                                        @lang('Number')
                                    </option>
                                    <option value="email" {{ $form->type == 'email' ? 'selected' : '' }}>
                                        @lang('Email')
                                    </option>
                                    <option value="select" {{ $form->type == 'select' ? 'selected' : '' }}>
                                        @lang('Select')
                                    </option>
                                    <option value="textarea" {{ $form->type == 'textarea' ? 'selected' : '' }}>
                                        @lang('Textarea')
                                    </option>
                                    <option value="file" {{ $form->type == 'file' ? 'selected' : '' }}>
                                        @lang('File')
                                    </option>
                                    <option value="checkbox" {{ $form->type == 'checkbox' ? 'selected' : '' }}>
                                        @lang('Checkbox')
                                    </option>
                                    <option value="radio" {{ $form->type == 'radio' ? 'selected' : '' }}>
                                        @lang('Radio')
                                    </option>
                                    <option value="date" {{ $form->type == 'date' ? 'selected' : '' }}>
                                        @lang('Date')
                                    </option>
                                    <option value="datetime" {{ $form->type == 'datetime' ? 'selected' : '' }}>
                                        @lang('Datetime')
                                    </option>
                                    <option value="time" {{ $form->type == 'time' ? 'selected' : '' }}>
                                        @lang('Time')
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="required">@lang('Required')</label>
                                <select class="form-select" name="required" required>
                                    <option value="yes" {{ $form->required == 'yes' ? 'selected' : '' }}>
                                        @lang('Yes')
                                    </option>
                                    <option value="no" {{ $form->required == 'no' ? 'selected' : '' }}>
                                        @lang('No')
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="col">@lang('Columns')</label>
                                <input id="col" type="number" placeholder="{{  __('Columns') }}"
                                       name="col" class="form-control" required value="{{ $form->col }}" onkeyup="invalidNum()">
                            </div>
                        </div>


                        @if ($form->type == 'select' || $form->type == 'checkbox' || $form->type == 'radio')
                        <div class="col-12 col-md-6 mb-3" id="placeholderField" style="display: none;">
                            <div class="mb-1">
                                <label for="placeholder">@lang('Placeholder')</label>
                                <input id="placeholder" type="text" placeholder="{{  __('Placeholder') }}"
                                       name="placeholder" class="form-control" value="{{ $form->placeholder }}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3" id="placeholderArField" style="display: none;">
                            <div class="mb-1">
                                <label for="placeholder_ar">@lang('Placeholder') ({{__('arabic')}})</label>
                                <input id="placeholder_ar" type="text" placeholder="{{  __('Placeholder') }}"
                                       name="placeholder_ar" class="form-control" value="{{ $form->placeholder_ar }}">
                            </div>
                        </div>
                        @endif

                        @if ($form->type == 'select' || $form->type == 'checkbox' || $form->type == 'radio')

                        
                            <div class="col-12 col-md-6 mb-3" style="display: block;" id="optionsField">
                                <div class="mb-1">
                                    <label for="options">@lang('Options')</label>
                                    @foreach ($form->options as $option)
                                    <div id="options">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="options[]" value="{{ $option }}" placeholder="Option">
                                            @if($loop->first)
                                            <button class="btn btn-primary" type="button" onclick="addOption()">+</button>
                                            @else
                                            <button class="btn btn-danger" type="button" onclick="removeOption(this)">-</button>
                                            <button class="btn btn-primary" type="button" onclick="addOption()">+</button>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        
                            <div class="col-12 col-md-6 mb-3" style="display: block;" id="optionsArField">
                                <div class="mb-1">
                                    <label for="options_ar">@lang('Options') ({{__('arabic')}})</label>
                                    @foreach ($form->options_ar as $option)
                                    <div id="options_ar">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="options_ar[]" value="{{ $option }}" placeholder="Option">
                                            @if($loop->first)
                                            <button class="btn btn-primary" type="button" onclick="addOptionAr()">+</button>
                                            @else
                                            <button class="btn btn-danger" type="button" onclick="removeOptionAr(this)">-</button>
                                            <button class="btn btn-primary" type="button" onclick="addOptionAr()">+</button>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                       
                        <div class="col-12 col-md-6 mb-3">
                            <div class="mb-1">
                                <label for="status">@lang('Status')</label>
                                <select class="form-select" name="status" required>
                                    <option value="active" {{ $form->status == 'active' ? 'selected' : '' }}>
                                        @lang('Active')
                                    </option>
                                    <option value="inactive" {{ $form->status == 'inactive' ? 'selected' : '' }}>
                                        @lang('Inactive')
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-2 text-center col-12">
                            <a href="{{ route($route.'.index', $service_id) }}" class="btn btn-danger">@lang('Cancel')</a>
                            <button type="submit" class="mx-2 btn btn-success">@lang('Save')</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
@endsection


@push('script')
    <script>
        function typeChange() {
            const type = $('#type option:selected').val();

            const options = $('#optionsField');
            const optionsAr = $('#optionsArField');
            const placeholder = $('#placeholderField');
            const placeholderAr = $('#placeholderArField');

            if (type === 'select' || type === 'radio' || type === 'checkbox') {
                options.css('display', 'block');
                optionsAr.css('display', 'block');
                placeholder.css('display', 'none');
                placeholderAr.css('display', 'none');
            } else {
                options.css('display', 'none');
                optionsAr.css('display', 'none');
                placeholder.css('display', 'block');
                placeholderAr.css('display', 'block');
            }
        }

        function addOption() {
            const options = $('#options');
            const option = document.createElement('div');
            option.className = 'input-group mb-2';
            option.innerHTML = `
                <input type="text" class="form-control" name="options[]" placeholder="Option">
                <button class="btn btn-danger" type="button" onclick="removeOption(this)">-</button>
                <button class="btn btn-primary" type="button" onclick="addOption()">+</button>
            `;
            options.append(option);
        }


        function removeOption(button) {
            button.parentElement.remove();
        }

        function addOptionAr() {
            const optionsAr = $('#options_ar');
            const optionAr = document.createElement('div');
            optionAr.className = 'input-group mb-2';
            optionAr.innerHTML = `
                <input type="text" class="form-control" name="options_ar[]" placeholder="Option">
                <button class="btn btn-danger" type="button" onclick="removeOptionAr(this)">-</button>
                <button class="btn btn-primary" type="button" onclick="addOptionAr()">+</button>
            `;
            optionsAr.append(optionAr);
        }

        function removeOptionAr(button) {
            button.parentElement.remove();
        }

        function invalidNum() {
            const col = $('#col');

            // check only number other not allow

            col.keyup(function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            if (col.val() < 1 || col.val() > 12) {
                col.addClass('is-invalid');
            } else {
                col.removeClass('is-invalid');
            }
        }
    </script>
@endpush