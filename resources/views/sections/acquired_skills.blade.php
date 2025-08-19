@php
    $skillsContent = getContent('acquired_skills.content', true);
    $skillsElements = getContent('acquired_skills.element', null, false, true);
@endphp

<section class="acquired-skills py-5">
    <div class="container">
        <div class="acquired-title border-bottom pb-3">
            <h2> {{ $skillsContent->lang('header') }} </h2>
        </div>

        <div class="acq-list">
            <ul class="mt-3">
                @foreach ($skillsElements as $skillsElement)
                    <li>
                        <img src="{{ getImage('assets/images/frontend/acquired_skills/' . @$skillsContent->data_values->icon) }}"
                            alt="icon">
                        {{ $skillsElement->lang('title') }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>


@push('style')
    <style>
        .acquired-title h2 {
            font-weight: 700;
            font-size: 35px;
            line-height: 42px;
        }

        .acq-list ul {
            padding: 0;
            margin: 0;
        }
        
        .acq-list ul li {
            list-style: none;
            position: relative;
            padding: 10px 0;
            padding-left: 35px;
            font-weight: 600;
            font-size: 22px;
            line-height: 32px;
            color: #555555;
            max-width: 790px;
        }

        .acq-list ul li img {
            position: absolute;
            left: 0;
            top: 18px;
            width: 18px;
        }
    </style>
@endpush
