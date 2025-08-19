<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-gear"></i>
        </div>
        <div class="menu-title">@lang('Category')</div>
    </a>
    <ul>
        <li>
            <a href="{{ route('admin.category.index') }}?type=EMAIL"><i class="bi bi-circle"></i>@lang('Mail Category')</a>
        </li>
        {{-- <li>
            <a href="{{ route('admin.category.index') }}?type=SMS"><i class="bi bi-circle"></i>@lang('SMS Category')</a>
        </li> --}}

    </ul>
</li>

<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-chat"></i>
        </div>
        <div class="menu-title">@lang('Contacts')</div>
    </a>
    <ul>
        {{-- <li>
            <a href="{{ route('admin.contacts.sms.index') }}"><i class="bi bi-circle"></i>@lang('SMS Contacts')</a>
        </li> --}}
        <li>
            <a href="{{ route('admin.contacts.email.index') }}"><i class="bi bi-circle"></i>@lang('Email Contacts')</a>
        </li>
    </ul>
</li>

{{-- <li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-chat"></i>
        </div>
        <div class="menu-title">@lang('Messaging') </div>
    </a>
    <ul>
        <li>
            <a href="{{ route('admin.general-messaging.sendmessage') }}"><i class="bi bi-circle"></i>@lang('General SMS Send')</a>
        </li>
        <li>
            <a href="{{ route('admin.messaging.sendmessage') }}"><i class="bi bi-circle"></i>@lang('SMS Send')</a>
        </li>
        <li>
            <a href="{{ route('admin.group.messaging.sendmessage') }}"><i class="bi bi-circle"></i>@lang('Group SMS')</a>
        </li>
        <li>
            <a href="{{ route('admin.sms.history') }}"><i class="bi bi-circle"></i>@lang('SMS History')</a>
        </li>
    </ul>
</li> --}}

<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-envelope"></i>
        </div>
        <div class="menu-title">@lang('Mailing')</div>
    </a>
    <ul>
        <li>
            <a href="{{ route('admin.send-mail.index') }}"><i class="bi bi-circle"></i>@lang('Send Mail')</a>
        </li>
        <li>
            <a href="{{ route('admin.send-mail.group') }}"><i class="bi bi-circle"></i>@lang('Group Send Mail')</a>
        </li>
        <li>
            <a href="{{ route('admin.send-mail.mail.history') }}"><i class="bi bi-circle"></i>@lang('Mail History')</a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-gear"></i>
        </div>
        <div class="menu-title">@lang('CRM Config')</div>
    </a>
    <ul>
        {{-- <li>
            <a href="{{ route('admin.setting.sms') }}"><i class="bi bi-circle"></i>@lang('SMS setting')</a>
        </li> --}}
        <li>
            <a href="{{ route('admin.setting.email') }}"><i class="bi bi-circle"></i>@lang('Mail Setting')</a>
        </li>
    </ul>
</li>
