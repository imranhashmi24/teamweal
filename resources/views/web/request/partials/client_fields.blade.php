<div class="card mb-4">
    <div class="card-header">
        @lang('Client Information')
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="organization" class="form-label">@lang('Full Name / Organization')</label>
                <input type="text" class="form-control" id="organization" name="organization" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">@lang('Email Address')</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-4">
                <label for="phone" class="form-label">@lang('Phone Number')</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            
            <div class="col-md-4">
                <label for="country_id" class="form-label">@lang('Country')</label>
                <select class="form-select" id="country_id" name="country_id" required>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" data-cities="{{ $country->city }}"
                            @selected(old('country_id' == @$country->id))>
                            @if (app()->getLocale() == 'en')
                                {{ $country->name }}
                            @else
                                {{ $country->name_ar }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="city" class="form-label">@lang('City')</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="col-12">
                <label class="form-label">@lang('Entity Type')</label>
                <div class="d-flex flex-wrap gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="entity_type" id="individual" value="Individual" required>
                        <label class="form-check-label" for="individual">@lang('Individual')</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="entity_type" id="company" value="Company">
                        <label class="form-check-label" for="company">@lang('Company')</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="entity_type" id="government" value="Government">
                        <label class="form-check-label" for="government">@lang('Government')</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="entity_type" id="educational" value="Educational">
                        <label class="form-check-label" for="educational">@lang('Educational')</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="entity_type" id="other" value="Other">
                        <label class="form-check-label" for="other">@lang('Other')</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>