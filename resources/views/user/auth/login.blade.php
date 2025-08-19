@extends('web.layouts.frontend', ['title' => 'Sign In'])
@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card custom-card">
                    <div class="card-header">
                        <h5 class="text-center card-title">@lang('Sign In')</h5>
                    </div>
                    <div class="px-4 card-body">
                        <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                            @csrf

                            <div class="mb-3 form-group">
                                <label for="username" class="form-label">@lang('Username or Email')</label>
                                <input type="text" id="username" name="username" value="{{ old('username') }}"
                                    class="form-control " required>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="password" class="form-label">@lang('Password')</label>
                                <input id="password" type="password" class="form-control " name="password" required>
                            </div>

                            <x-captcha />

                            <div class="flex-wrap gap-3 mb-3 d-flex justify-content-between">
                                <div>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        @lang('Remember Me')
                                    </label>
                                </div>

                                <div>
                                    <a class="fw-bold forgot-pass" href="{{ route('user.password.request') }}">
                                        @lang('Forgot your password?')
                                    </a>
                                </div>
                            </div>

                            <div class="mb-3 form-group">
                                <button type="submit" id="recaptcha" class="btn btn-base w-100">
                                    @lang('Sign In')
                                </button>
                            </div>
                            <p class="mb-0 text-center">@lang('Don\'t have any account?') <a
                                    href="{{ route('user.register') }}">@lang('Sign Up')</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('form').on('submit', function() {
        if ($(this).valid()) {
            $(':submit', this).attr('disabled', 'disabled');
        }
    });
</script>
@endpush
