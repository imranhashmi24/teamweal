@php
    $submissionContent = getContent('submission_criteria.content', true);
    $submissionElements = getContent('submission_criteria.element', null, false, true);
@endphp

<!--    Submission SECTION-->
<section class="submission-section py-5">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="after-line text-capitalize"> {{ $submissionContent->lang('heading') }} </h2>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <div class="submission-image">
                    <img src="{{ getImage('assets/images/frontend/submission_criteria/' . @$submissionContent->data_values->image) }}"
                        alt="image">
                </div>
            </div>
            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <div class="submission-text">
                    <div class="acq-list">
                        <ul class="">
                            @foreach ($submissionElements as $submissionElement)
                                <li>
                                    <img src="{{ getImage('assets/images/frontend/submission_criteria/' . @$submissionContent->data_values->icon) }}"
                                        alt="icon">
                                    {{ $submissionElement->lang('title') }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <a href="{{ @$submissionContent->data_values->button_link }}" target="_blank">
                        {{ $submissionContent->lang('button') }} </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--    Submission SECTION END-->

@push('style')
    <style>
        .submission-image img {
            width: 100%;
        }

        .submission-text a {
            font-weight: 600;
            font-size: 24px;
            line-height: 35px;
            background: #00A550;
            color: #ffffff;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 2px;
            margin-top: 30px;
            display: inline-block;
        }
    </style>
@endpush
