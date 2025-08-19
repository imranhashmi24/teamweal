@php
$aboutSectionContent = getContent('about_section.content', true);
@endphp

<!-- About section start -->
<section class="py-5 about-section">
    <div class="container">
        <div class="row">
            <div class="text-center col-12 header-content">
              <h2>{{ @$aboutSectionContent->lang('title') }}</h2>
                <div class="small-line"></div>
            </div>
        </div>
        <div class="py-5 row">
            <div class="col-12 col-md-6  content">
                <p>{!! @$aboutSectionContent->lang('description') !!}</p>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center">
                <img src="{{ getImage('assets/images/frontend/about_section/' . @$aboutSectionContent->data_values->image) }}" class="img-fluid" alt="About us">
            </div>
        </div>
    </div>
</section>
<!-- About section end -->




@push('style')

<style>
  /* About Section CSS */
    .about-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 70px 0;
        font-family: 'Roboto', sans-serif;
    }
    
    .about-section .header-content {
        margin-bottom: 40px;
    }
    
    .about-section .header-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        text-transform: uppercase;
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .about-section .header-content h2::after {
        content: '';
        width: 80px;
        height: 4px;
        background-color: #ff6600;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: -10px;
    }
    
    .about-section .header-content .small-line {
        display: none;
    }
    
    .about-section .content {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.8;
        animation: fadeInLeft 1s ease-in-out;
    }
    
    .about-section .content p {
        margin-bottom: 20px;
    }
    
    .about-section img {
        width: 100%;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        animation: fadeInRight 1s ease-in-out;
    }
    
    .about-section img:hover {
        transform: scale(1.05);
    }
    
    /* Animations */
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .about-section {
            padding: 40px 0;
        }
        
        .about-section .header-content h2 {
            font-size: 2.5rem;
        }
        
        .about-section .content {
            font-size: 1rem;
        }
    }


</style>

@endpush