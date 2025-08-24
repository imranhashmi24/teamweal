@php
    $lang = app()->getLocale() ?? 'en';
@endphp

<div class="row">
    @foreach($forms as $form)

        {{-- TEXT --}}
        @if($form->type == 'text')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input 
                        type="text" 
                        class="form-control rounded-0" 
                        id="{{ Str::slug($form->name, '_') }}" 
                        name="form_data[{{ Str::slug($form->name, '_') }}]" 
                        value="{{ old('form_data.'.Str::slug($form->name, '_')) }}"
                        placeholder="{{ $form->placeholder ? ($lang=='ar' ? $form->placeholder_ar : $form->placeholder) : ($lang=='ar' ? $form->name_ar : $form->name) }}"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>

        {{-- EMAIL --}}
        @elseif($form->type == 'email')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input 
                        type="email" 
                        class="form-control rounded-0" 
                        id="{{ Str::slug($form->name, '_') }}" 
                        name="form_data[{{ Str::slug($form->name, '_') }}]" 
                        value="{{ old('form_data.'.Str::slug($form->name, '_')) }}"
                        placeholder="{{ $form->placeholder ? ($lang=='ar' ? $form->placeholder_ar : $form->placeholder) : ($lang=='ar' ? $form->name_ar : $form->name) }}"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>

        {{-- NUMBER --}}
        @elseif($form->type == 'number')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input 
                        type="number" 
                        class="form-control rounded-0" 
                        id="{{ Str::slug($form->name, '_') }}" 
                        name="form_data[{{ Str::slug($form->name, '_') }}]" 
                        value="{{ old('form_data.'.Str::slug($form->name, '_')) }}"
                        placeholder="{{ $form->placeholder ? ($lang=='ar' ? $form->placeholder_ar : $form->placeholder) : ($lang=='ar' ? $form->name_ar : $form->name) }}"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>

        {{-- SELECT --}}
        @elseif($form->type == 'select')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <select 
                        class="form-control rounded-0" 
                        id="{{ Str::slug($form->name, '_') }}" 
                        name="form_data[{{ Str::slug($form->name, '_') }}]"
                        @if($form->required == 'yes') required @endif
                    >
                        <option value="">{{ $lang == 'ar' ? $form->name_ar : $form->name }}</option>
                        @foreach ($form->options as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        {{-- TEXTAREA --}}
        @elseif($form->type == 'textarea')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <textarea 
                        class="form-control rounded-0" 
                        id="{{ Str::slug($form->name, '_') }}" 
                        name="form_data[{{ Str::slug($form->name, '_') }}]" 
                        @if($form->required == 'yes') required @endif
                    >{{ old('form_data.'.Str::slug($form->name, '_')) }}</textarea>
                </div>
            </div>

        {{-- FILE --}}
        @elseif($form->type == 'file')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input type="file" 
                        class="form-control rounded-0" 
                        id="{{ Str::slug($form->name, '_') }}" 
                        name="form_file[{{ Str::slug($form->name, '_') }}][]" 
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>

        {{-- CHECKBOX --}}
        @elseif($form->type == 'checkbox')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    @foreach($lang=='ar' ? $form->options_ar : $form->options as $option)
                        <div class="form-check">
                            <input type="checkbox" 
                                class="form-check-input rounded-0" 
                                id="{{ Str::slug($form->name, '_').$option }}" 
                                name="form_checkbox[{{ Str::slug($form->name, '_') }}][]" 
                                value="{{ $option }}"
                            >
                            <label for="{{ Str::slug($form->name, '_').$option }}">{{ $option }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

        {{-- RADIO --}}
        @elseif($form->type == 'radio')
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    @foreach($lang=='ar' ? $form->options_ar : $form->options as $option)
                        <div class="form-check">
                            <input type="radio" 
                                class="form-check-input rounded-0" 
                                id="{{ Str::slug($form->name, '_').$option }}" 
                                name="form_radio[{{ Str::slug($form->name, '_') }}]" 
                                value="{{ $option }}"
                            >
                            <label for="{{ Str::slug($form->name, '_').$option }}">{{ $option }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

        {{-- DATE / TIME --}}
        @elseif(in_array($form->type, ['date','datetime','time']))
            <div class="col-{{ $form->col }}">
                <div class="form-group my-2">
                    <label for="{{ Str::slug($form->name, '_') }}" class="form-label">
                        {{ $lang == 'ar' ? $form->name_ar : $form->name }}
                        @if($form->required == 'yes') <span class="text-danger">*</span> @endif
                    </label>
                    <input 
                        type="{{ $form->type }}" 
                        class="form-control rounded-0" 
                        id="{{ Str::slug($form->name, '_') }}" 
                        name="form_data[{{ Str::slug($form->name, '_') }}]" 
                        value="{{ old('form_data.'.Str::slug($form->name, '_')) }}"
                        placeholder="{{ $form->placeholder ? ($lang=='ar' ? $form->placeholder_ar : $form->placeholder) : ($lang=='ar' ? $form->name_ar : $form->name) }}"
                        @if($form->required == 'yes') required @endif
                    >
                </div>
            </div>
        @endif

    @endforeach
</div>
