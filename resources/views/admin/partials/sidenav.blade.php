<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <div>
                <img src="{{ siteLogo() }}" alt="" style="width:60%">
            </div>
        </div>
        <div class="toggle-icon ms-auto">
            <i class="bi bi-list"></i>
        </div>
    </div>
    <ul class="metismenu sidebar__menu-main" id="menu">
        <li class="sidebar--menu {{ menuActive('admin.dashboard') }}">
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class="bi bi-speedometer2"></i>
                </div>
                <div class="menu-title">@lang('Dashboard')</div>
            </a>
        </li>


        <li class="menu-label">@lang('Request')</li>
        <li class="sidebar--menu sidebar--dropdown {{ menuActive(['admin.request_order*']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-globe-asia-australia"></i>
                </div>
                <div class="menu-title">@lang('Request')</div>
            </a>
            <ul>
                @foreach (requestTypes() as $type)
                    <li class="{{ menuActive('admin.request_order*') }}">
                        <a href="{{ route('admin.request_order.index', ['type' => $type['model']]) }}"><i
                                class="bi bi-record-circle"></i>
                            {{ app()->getLocale() == 'ar' ? $type['name_ar'] : $type['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        

        <li class="menu-label">@lang('Services')</li>
        <li
            class="sidebar--menu sidebar--dropdown {{ menuActive(['admin.our_service*']) }}">

            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-globe-asia-australia"></i>
                </div>
                <div class="menu-title">@lang('Our Services')</div>
            </a>

            <ul>
                <li class="{{ menuActive('admin.our_service*') }}">
                    <a href="{{ route('admin.our_service.index') }}"><i
                            class="bi bi-record-circle"></i>@lang('Our Services')</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar--menu sidebar--dropdown {{ menuActive(['admin.private_sectors*']) }}">

            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-globe-asia-australia"></i>
                </div>
                <div class="menu-title">@lang('Private Sectors')</div>
            </a>

            <ul>
                <li class="{{ menuActive('admin.private_sectors*') }}">
                    <a href="{{ route('admin.private_sectors.index') }}"><i
                            class="bi bi-record-circle"></i>@lang('Private Sectors')</a>
                </li>
            </ul>
        </li>


        <li
            class="sidebar--menu sidebar--dropdown {{ menuActive(['admin.sectors*']) }}">

            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-globe-asia-australia"></i>
                </div>
                <div class="menu-title">@lang('Sectors')</div>
            </a>

            <ul>
                <li class="{{ menuActive('admin.sectors*') }}">
                    <a href="{{ route('admin.sectors.index') }}"><i
                            class="bi bi-record-circle"></i>@lang('Sectors')</a>
                </li>
            </ul>
        </li>


        <li
            class="sidebar--menu sidebar--dropdown {{ menuActive(['admin.financial_investments*']) }}">

            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-globe-asia-australia"></i>
                </div>
                <div class="menu-title">@lang('Financial Investments')</div>
            </a>

            <ul>
                <li class="{{ menuActive('admin.financial_investments*') }}">
                    <a href="{{ route('admin.financial_investments.index') }}"><i
                            class="bi bi-record-circle"></i>@lang('Financial Investments')</a>
                </li>
            </ul>
        </li>


        <li
            class="sidebar--menu sidebar--dropdown {{ menuActive(['admin.investment_opportunities*']) }}">

            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-globe-asia-australia"></i>
                </div>
                <div class="menu-title">@lang('Investment Opportunities')</div>
            </a>

            <ul>
                <li class="{{ menuActive('admin.investment_opportunities*') }}">
                    <a href="{{ route('admin.investment_opportunities.index') }}"><i
                            class="bi bi-record-circle"></i>@lang('Investment Opportunities')</a>
                </li>
                <li class="{{ menuActive('admin.investment_opportunities.categories*') }}">
                    <a href="{{ route('admin.investment_opportunities.categories.index') }}"><i
                            class="bi bi-record-circle"></i>@lang('Categories')</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar--menu sidebar--dropdown {{ menuActive(['admin.country*', 'admin.city*']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-globe-asia-australia"></i>
                </div>
                <div class="menu-title">@lang('Manage Area')</div>
            </a>
            <ul>
                <li class="{{ menuActive('admin.country*') }}">
                    <a href="{{ route('admin.country.index') }}"><i
                            class="bi bi-record-circle"></i>@lang('Countries')</a>
                </li>
                <li class="{{ menuActive('admin.city*') }}">
                    <a href="{{ route('admin.city.index') }}"><i class="bi bi-record-circle"></i>@lang('Cities')</a>
                </li>
            </ul>
        </li>



        <li class="menu-label">@lang('General Setting')</li>
        <li class="sidebar--menu sidebar--dropdown {{ menuActive('admin.users*') }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-people"></i>
                </div>
                <div class="menu-title">@lang('Manage Users')</div>
                @if ($emailUnverifiedUsersCount || $mobileUnverifiedUsersCount)
                    <span class="red__notify"></span>
                @endif
            </a>
            <ul>
                <li class="{{ menuActive('admin.users.active') }}">
                    <a href="{{ route('admin.users.active') }}"><i
                            class="bi bi-record-circle"></i>@lang('Active Users')</a>
                </li>
                <li class="{{ menuActive('admin.users.banned') }}">
                    <a href="{{ route('admin.users.banned') }}"><i
                            class="bi bi-record-circle"></i>@lang('Banned Users')</a>
                </li>
                <li class="{{ menuActive('admin.users.unverified') }}">
                    <a href="{{ route('admin.users.email.unverified') }}"><i
                            class="bi bi-record-circle"></i>@lang('Email Unverified')
                        @if ($emailUnverifiedUsersCount)
                            <span class="red__notify"></span>
                        @endif
                    </a>

                </li>
                <li class="{{ menuActive('admin.users.unverified') }}">
                    <a href="{{ route('admin.users.mobile.unverified') }}">
                        <i class="bi bi-record-circle"></i>@lang('Mobile Unverified')
                        @if ($mobileUnverifiedUsersCount)
                            <span class="red__notify"></span>
                        @endif
                    </a>

                </li>
                <li class="{{ menuActive('admin.users.all') }}">
                    <a href="{{ route('admin.users.all') }}"><i
                            class="bi bi-record-circle"></i>@lang('All Users')</a>
                </li>
                {{-- <li> <a href="{{ route('admin.users.notification.all') }}"><i
                            class="bi bi-record-circle"></i>@lang('Notification to All')</a></li> --}}
            </ul>
        </li>



        <li
            class="sidebar--menu sidebar--dropdown {{ menuActive(['admin.setting.index', 'admin.setting.system*', 'admin.setting.cookie', 'admin.setting.logo.icon', 'admin.extensions', 'admin.language*', 'admin.seo', 'admin.maintenance.mode']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-gear"></i>
                </div>
                <div class="menu-title">@lang('Settings')</div>
            </a>
            <ul>
                <li class="{{ menuActive(['admin.setting.index']) }}">
                    <a href="{{ route('admin.setting.index') }}">
                        <i class="bi bi-record-circle"></i>@lang('General Setting')
                    </a>
                </li>
                <li class="{{ menuActive('admin.setting.system.configuration') }}">
                    <a href="{{ route('admin.setting.system.configuration') }}">
                        <i class="bi bi-record-circle"></i>@lang('System Configuration')
                    </a>
                </li>
                <li class="{{ menuActive('admin.setting.logo.icon') }}">
                    <a href="{{ route('admin.setting.logo.icon') }}">
                        <i class="bi bi-record-circle"></i>@lang('Logo & Favicon')</a>
                </li>
                <li class="{{ menuActive('admin.extensions.index') }}">
                    <a href="{{ route('admin.extensions.index') }}"><i
                            class="bi bi-record-circle"></i>@lang('Extensions')</a>
                </li>
                <li class="{{ menuActive('admin.language.manage') }}">
                    <a href="{{ route('admin.language.manage') }}"><i
                            class="bi bi-record-circle"></i>@lang('Language')</a>
                </li>
                <li class="{{ menuActive('admin.seo') }}">
                    <a href="{{ route('admin.seo') }}"><i class="bi bi-record-circle"></i>@lang('SEO Manager')</a>
                </li>

                <li class="{{ menuActive('admin.maintenance.mode') }}">
                    <a href="{{ route('admin.maintenance.mode') }}"><i
                            class="bi bi-record-circle"></i>@lang('Maintenance Mode')</a>
                </li>
                <li class="{{ menuActive('admin.setting.cookie') }}">
                    <a href="{{ route('admin.setting.cookie') }}"><i
                            class="bi bi-record-circle"></i>@lang('GDPR Cookie')</a>
                </li>
                <li class="{{ menuActive('admin.setting.custom.css') }}">
                    <a href="{{ route('admin.setting.custom.css') }}"><i
                            class="bi bi-record-circle"></i>@lang('Custom CSS')</a>
                </li>
            </ul>
        </li>


        <li class="sidebar--menu sidebar--dropdown {{ menuActive('admin.setting.notification*') }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-bell"></i>
                </div>
                <div class="menu-title">@lang('Notification Setting')</div>
            </a>
            <ul>
                <li class="{{ menuActive('admin.setting.notification.global') }}">
                    <a href="{{ route('admin.setting.notification.global') }}"><i
                            class="bi bi-record-circle"></i>@lang('Global Template')</a>
                </li>
                <li class="{{ menuActive('admin.setting.notification.email') }}">
                    <a href="{{ route('admin.setting.notification.email') }}"><i
                            class="bi bi-record-circle"></i>@lang('Email Setting')</a>
                </li>
                <li class="{{ menuActive('admin.setting.notification.sms') }}">
                    <a href="{{ route('admin.setting.notification.sms') }}"><i
                            class="bi bi-record-circle"></i>@lang('SMS Setting')</a>
                </li>
                <li class="{{ menuActive('admin.setting.notification.templates') }}">
                    <a href="{{ route('admin.setting.notification.templates') }}"><i
                            class="bi bi-record-circle"></i>@lang('Notification Templates')</a>
                </li>
            </ul>
        </li>


        <li class="menu-label">@lang('CRM')</li>

        <li class="sidebar--menu sidebar--dropdown {{ menuActive('admin.setting.notification*') }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-bell"></i>
                </div>
                <div class="menu-title">@lang('CRM Setting')</div>
            </a>
            <ul>
                @include('admin.partials.mail_sidenav')
            </ul>
        </li>

        <li class="sidebar--menu sidebar--dropdown {{ menuActive('admin.support*') }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-chat-right-dots"></i>
                </div>
                <div class="menu-title">@lang('Customer Support')</div>
                @if ($pendingSupportCount)
                    <span class="red__notify"></span>
                @endif
            </a>
            <ul>
                <li class="{{ menuActive('admin.support.pending') }}">
                    <a href="{{ route('admin.support.pending') }}">
                        <i class="bi bi-record-circle"></i>@lang('Pending Support')
                        @if ($pendingSupportCount)
                            <span class="red__notify"></span>
                        @endif
                    </a>
                </li>
                <li class="{{ menuActive('admin.support.closed') }}">
                    <a href="{{ route('admin.support.closed') }}">
                        <i class="bi bi-record-circle"></i>
                        @lang('Closed Support')
                    </a>
                </li>
                <li class="{{ menuActive('admin.support.answered') }}">
                    <a href="{{ route('admin.support.answered') }}"><i
                            class="bi bi-record-circle"></i>@lang('Answered Support')</a>
                </li>
                <li class="{{ menuActive('admin.support.index') }}">
                    <a href="{{ route('admin.support.index') }}"><i
                            class="bi bi-record-circle"></i>@lang('All Support')</a>
                </li>
            </ul>
        </li>
        <li class="sidebar--menu {{ menuActive('admin.subscriber*') }}">
            <a href="{{ route('admin.subscriber.index') }}">
                <div class="parent-icon"><i class="bi bi-bell-slash"></i>
                </div>
                <div class="menu-title">@lang('Subscribers')</div>
            </a>
        </li>

        <li class="menu-label">@lang('Blog')</li>

        <li class="sidebar--menu sidebar--dropdown">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-bookshelf"></i>
                </div>
                <div class="menu-title">@lang('Blog Section')</div>
            </a>
            <ul>
                <li class="">
                    <a href="{{ route('admin.blog.category.index') }}">
                        <i class="bi bi-record-circle"></i>{{ __('Blog Category') }}
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('admin.blog.index') }}">
                        <i class="bi bi-record-circle"></i>{{ __('Blog') }}
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-label">@lang('Pages & Section')</li>
        <li class="sidebar--menu {{ menuActive('admin.frontend.manage.pages*') }}">
            <a href="{{ route('admin.frontend.manage.pages') }}">
                <div class="parent-icon"><i class="bi bi-file-earmark"></i>
                </div>
                <div class="menu-title">@lang('Manage Pages')</div>
            </a>
        </li>

        <li class="sidebar--menu sidebar--dropdown {{ menuActive('admin.frontend.sections*') }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-bookshelf"></i>
                </div>
                <div class="menu-title">@lang('Manage Section')</div>
            </a>
            <ul>
                @php
                    $lastSegment = collect(request()->segments())->last();
                @endphp
                @foreach (getPageSections(true) as $k => $secs)
                    @if ($secs['builder'])
                        <li class="{{ $lastSegment == $k ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.frontend.sections', $k) }}">
                                <i class="bi bi-record-circle"></i>{{ __($secs['name']) }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    </ul>
</aside>
