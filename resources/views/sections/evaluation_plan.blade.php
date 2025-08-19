@php
    $evaluationPlanElements = getContent('evaluation_plan.element', null, false, true);
@endphp


<section class="py-5">
    <div class="container">
        <div class="row">
            @foreach ($evaluationPlanElements as $evaluationPlanElement)
                <div class="col-12 col-sm-6 col-md-3 mb-3">
                    <div class="card custom-card">
                        <img src="{{ getImage('assets/images/frontend/evaluation_plan/' . @$evaluationPlanElement->data_values->image, '80x80') }}"
                            class="w-25 mt-2 mt-md-3 mx-auto" alt="Plan">
                        <div class="card-body">
                            <h5> {{ __(@$evaluationPlanElement->lang('title')) }} </h5>
                            <p>
                                @php echo @$evaluationPlanElement->lang('description') @endphp
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
