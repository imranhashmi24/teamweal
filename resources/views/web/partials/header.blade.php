@php
    $pages = App\Models\Page::where('is_default', Status::NO)->get();
    $lang = Session::get('lang');
@endphp

<section class="py-2 header-top">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-end">
                <div class="menubar">
                    <ul>
                        @if (gs('multi_language'))

                            <li>
                                @if (@$lang == 'en')
                                    <button class="no-border head-lang-button langSel" data-lang="ar"> <img
                                            class="lang-flag"
                                            src="{{ asset('assets/images/frontend/uploads/saudi-arabia.png') }}">
                                        @lang('Arabic')</button>
                                @endif

                                @if (@$lang == 'ar')
                                    <button class="no-border head-lang-button langSel" data-lang="en"> <img
                                            class="lang-flag"
                                            src="{{ asset('assets/images/frontend/uploads/english.jpg') }}">
                                        @lang('English')</button>
                                @endif
                            </li>
                        @endif
                         <li class="sub-btn button1">
                            @guest
                                <a href="#">
                                    <i class="fa fa-user-circle"></i> @lang('Accounts') <i class="fa-solid fa-angle-down"></i>
                                </a>
                                <div class="sub-menu">
                                    <a href="{{ route('user.login') }}">
                                        <i class="fa-solid fa-arrow-right-to-bracket"></i> @lang('Sign In')
                                    </a>
                                    <a href="{{ route('user.register') }}">
                                        <i class="fa-solid fa-arrow-right-to-bracket"></i> @lang('Service providers registration')
                                    </a>
                                </div>
                            @endguest
                            
                            @auth
                                <a href="#">
                                    <i class="fa fa-user-circle"></i> {{ Auth::user()->username }} <i class="fa-solid fa-angle-down"></i>
                                </a>
                                <div class="sub-menu">
                                    <a href="{{ route('user.home') }}">
                                        <i class="bi bi-speedometer2"></i> @lang('Dashboard')
                                    </a>
                                    <a href="{{ route('user.profile.setting') }}">
                                        <i class="fa fa-user"></i> @lang('Profile')
                                    </a>
                                    <a href="{{ route('user.logout') }}">
                                        <i class="fa fa-sign-out"></i> @lang('Logout')
                                    </a>
                                </div>
                            @endauth
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</section>

<header class="py-2 d-flex align-items-center scrolled">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-xl-2">
                <div class="logo d-flex justify-content-between align-items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ siteLogo() }}" alt="Logo">
                    </a>
                    <div class="d-xl-none d-flex align-items-center gap-2 justify-content-end">
                        <div data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="bi bi-search mt-2"></i>
                        </div>

                        <i class="fa fa-bars d-xl-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                            aria-controls="offcanvasExample" onclick="mobileClick()" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-10 d-none d-xl-block">
                <div class="menubar">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}"> @lang('Home') </a>
                        </li>
                        @foreach ($pages as $page)
                            <li>
                                <a href="{{ route('pages', [$page->slug]) }}"> {{ __($page->name) }} </a>
                            </li>
                        @endforeach
                         
{{--                         
                        @php 
                            $catsss = App\Models\Category::where('parent_id',0)->get();
                            
                        @endphp
                            
                        <li class="sub-btn">
                            <a href="javascript:void(0)">
                                @lang('Services')
                                
                                <i class="fa-solid fa-angle-down"></i>
                            </a> --}}
                            {{-- <div class="sub-menu">
                                 
                                <a href="{{ route('services') }}"> @lang('All Services')</a>
                                 
                                @foreach($catsss as $catss)
                                <a href="{{ route('categorywiseservices',$catss->id) }}">
                                    {{ app()->getLocale() == 'en' ? $catss->name : $catss->name_ar }}
                                 </a>
                                @endforeach
                            </div> --}}
                        </li>
                            
                        {{-- <li>
                            <a href="{{ route('blogs') }}"> @lang('Blogs') </a>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                                <i class="bi bi-search"></i>
                            </button>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="offcanvas offcanvas-mobile-menu {{ $lang == 'ar' ? 'offcanvas-end' : 'offcanvas-start' }}" tabindex="-1"
    id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">
            <a href="{{ route('home') }}" class="mobile-logo">
                <img src="{{ siteLogo() }}" alt="Logo">
            </a>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="canvas-mobile-menu">

            <a href="{{ route('home') }}"> <i class="bi bi-chevron-right"></i> @lang('Homepage') </a>

            @foreach ($pages as $page)
                <a href="{{ route('pages', [$page->slug]) }}">
                  <i class="bi bi-chevron-right"></i>  {{ __($page->name) }} </a>
            @endforeach
            
            
            {{-- <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                     <i class="bi bi-chevron-right"></i> @lang('Services')
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                       <a href="{{ route('services') }}"> @lang('All Services')</a>
                       @foreach($catsss as $catss)
                        <a href="{{ route('categorywiseservices',$catss->id) }}">
                            {{ app()->getLocale() == 'en' ? $catss->name : $catss->name_ar }}
                        </a>
                       @endforeach
                  </div>
                </div>
              </div>
            </div>
            
            <a href="{{ route('blogs') }}"><i class="bi bi-chevron-right"></i> @lang('Blogs') </a> --}}
        </div>
    </div>
</div>
