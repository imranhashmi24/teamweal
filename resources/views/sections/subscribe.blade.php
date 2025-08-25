@php
    $subscribeContent = getContent('subscribe.content', true);
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- Text + Form -->
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                <div class="p-4 rounded-4 ">
                    <h2 class="fw-bold mb-3" style="font-size:2rem">{{ @$subscribeContent?->lang('heading') }}</h2>
                    <p class="text-muted mb-4">{{ @$subscribeContent?->lang('title') }}</p>
                    
                    <form action="{{ route('subscribe') }}" method="post" class="d-flex flex-column flex-sm-row gap-2">
                        @csrf
                        <input 
                            type="email" 
                            name="email"
                            class="form-control" 
                            placeholder="@lang('Enter your email')"
                            required
                            value="{{ old('email') }}"
                            aria-label="Recipient's email"
                        />
                        
                        <button class="btn btn-primary px-4 py-0 fw-semibold mt-2 shadow-sm" type="submit">
                            @lang('Subscribe')
                        </button>
                    </form>
                    
                    <!-- Optional: Small note below -->
                    <small class="d-block mt-3 text-muted">
                       
                    </small>
                </div>
            </div>
            
            <!-- Image -->
            <div class="col-12 col-md-6 text-center">
                <img 
                    src="{{ getImage('assets/images/frontend/subscribe/' . @$subscribeContent?->data_values?->image, '600x400') }}" 
                    class="img-fluid " 
                    alt="{{ @$subscribeContent?->lang('title') }}">
            </div>
            
        </div>
    </div>
</section>
