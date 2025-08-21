@php
    $TargetAudienceElements = getContent('target_audience.element', null, false, true);
@endphp


<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold section-title">
                    @lang('Target Audience')
                </h2>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($TargetAudienceElements as $TargetAudienceElement)
                <div class="col">
                    <div class="solution-card text-center h-100 p-4">
                        <div class="img-wrapper mb-3">
                            <img src="{{ getImage('assets/images/frontend/target_audience/' . $TargetAudienceElement?->data_values->image) }}"
                                alt="Target Audience" class="img-fluid">
                        </div>
                        <h5 class="fw-semibold mb-2">
                            {{ $TargetAudienceElement?->lang('title') }}
                        </h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .section-title {
    color: #A4AF00;
    font-size: 2rem;
    letter-spacing: 0.5px;
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: "";
    display: block;
    width: 60px;
    height: 3px;
    background: #A4AF00;
    margin: 10px auto 0;
    border-radius: 2px;
}

.solution-card {
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 20px;
    transition: all 0.35s ease;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

.solution-card:hover {
    transform: translateY(-10px);
    border-color: #0069CA;
    box-shadow: 0 10px 25px rgba(0, 105, 202, 0.2);
}

.solution-card .img-wrapper {
    width: 80px;
    height: 80px;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: #f8faff;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 10px;
}

.solution-card img {
    max-width: 60%;
    height: auto;
    transition: transform 0.4s ease;
}

.solution-card:hover img {
    transform: scale(1.1);
}

.solution-card h5 {
    color: #333;
    font-size: 18px;
    transition: color 0.3s ease;
}

.solution-card:hover h5 {
    color: #0069CA;
}

.solution-card p {
    font-size: 15px;
    line-height: 1.6;
}

</style>
