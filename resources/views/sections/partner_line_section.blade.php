@php
$partnerLineElements = getContent('partner_line_section.element',  null, false, true);
@endphp

<section class="py-4 partner-line-section">
    <div class="container">
        <div class="row">
            @foreach ($partnerLineElements as $element)
            <div class="col-6">
                <div class="partner-line d-flex">
                    <img data-src="{{ getImage('assets/images/frontend/partner_line_section/' . @$element->data_values->image, '34x34') }}" alt="Not found">
                    <p>
                        {{ @$element->lang('title') }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
