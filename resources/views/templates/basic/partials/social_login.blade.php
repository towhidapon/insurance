@php
    $text = isset($register) ? 'Register' : 'Login';
@endphp
<div class="social-login-wrapper">
    <ul class="social-login-list">
        @if (@gs('socialite_credentials')->google->status == Status::ENABLE)
            <li class="social-login-list__item flex-grow-1">
                <a href="{{ route('user.social.login', 'google') }}" class="w-100 social-login-btn">
                    <span class="social-login-btn__icon">
                        <img src="{{ asset($activeTemplateTrue . 'images/google.svg') }}" alt="Google">
                    </span>
                    @lang("$text with Google")
                </a>
            </li>
        @endif
        @if (@gs('socialite_credentials')->facebook->status == Status::ENABLE)
            <li class="social-login-list__item flex-grow-1">
                <a href="{{ route('user.social.login', 'facebook') }}" class="w-100 social-login-btn">
                    <span class="social-login-btn__icon">
                        <img src="{{ asset($activeTemplateTrue . 'images/facebook.svg') }}" alt="Facebook">
                    </span>
                    @lang("$text with Facebook")
                </a>
            </li>
        @endif
        @if (@gs('socialite_credentials')->linkedin->status == Status::ENABLE)
            <li class="social-login-list__item flex-grow-1">
                <a href="{{ route('user.social.login', 'linkedin') }}" class="w-100 social-login-btn">
                    <span class="social-login-btn__icon">
                        <img src="{{ asset($activeTemplateTrue . 'images/linkdin.svg') }}" alt="LinkedIn">
                    </span>
                    @lang("$text with LinkedIn")
                </a>
            </li>
        @endif

        @if (@gs('socialite_credentials')->linkedin->status || @gs('socialite_credentials')->facebook->status == Status::ENABLE || @gs('socialite_credentials')->google->status == Status::ENABLE)
            <div class="text-center">
                <span>@lang('OR')</span>
            </div>
        @endif
        @push('style')
            <style>
                .social-login-btn {
                    border: 1px solid #cbc4c4;
                }
            </style>
        @endpush
