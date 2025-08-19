

@php
    $aboutContent = getContent('app_download.content', true);
@endphp



<section class="py-5 background-color-left">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 min-height">
                <div class="app-image">
                    <img src="{{ getImage('assets/images/frontend/app_download/' . @$aboutContent->data_values->image, '640x465') }}" alt="App Image">
                </div>
            </div>
            <div class="col-12 col-lg-6 min-height d-flex align-items-center">
                <div class="text-center app-text text-lg-start">
                    <h5 class="mb-0"> {{__(@$aboutContent->lang('heading'))}} </h5>
                    <p>  {{__(@$aboutContent->lang('subheading'))}} </p>
                    <p class="mt-4"> {{__(@$aboutContent->lang('description'))}} </p>
                    <div class="mt-5 app-logo">
                        <a href="{{@$aboutContent->data_values->app_store_link}}" target="_blank" class="mb-3 mb-md-none">
                            <img src="{{ getImage('assets/images/frontend/app_download/' . @$aboutContent->data_values->app_store, '180x65') }}" alt="app logo">
                        </a>
                        <a href="{{@$aboutContent->data_values->google_store_link}}" target="_blank">
                            <img src="{{ getImage('assets/images/frontend/app_download/' . @$aboutContent->data_values->google_play, '180x65') }} " alt="app logo">
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
