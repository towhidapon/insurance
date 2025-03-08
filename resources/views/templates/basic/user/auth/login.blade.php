@php
    $loginContent = getContent('login_register.content', true);
@endphp
@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <section class="account bg-img" data-background-image="{{ frontendImage('login_register', @$loginContent->data_values->background_image) }}">

        <div class="container">
            <div class="account-inner">
                <div class="account-form-wrapper">
                    <div class="account-form-wrapper__top">
                        <h4 class="account-form-wrapper__title"> {{ __(@$loginContent->data_values->login_page_title) }} </h4>
                        <p class="account-form-wrapper__text"> {{ __(@$loginContent->data_values->login_page_subtitle) }} </p>
                    </div>
                    <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                        <div class="account-form">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-sm-12">
                                    <label for="mail" class="form--label"> @lang('Email') </label>
                                    <input type="email" name="username" value="{{ old('username') }}" class="form-control form--control" placeholder="olivia@untitledui.com" id="mail" required>
                                </div>

                                <div class="col-sm-12">
                                    <label for="your-password" class="form--label"> @lang('Password') </label>
                                    <div class="position-relative">
                                        <input id="your-password" type="password" class="form-control form--control form-two" value="Password" name="password" required>
                                        <span class="password-show-hide fa-solid fa-eye-slash toggle-password" id="#your-password"></span>
                                    </div>
                                </div>
                                <x-captcha />
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn--base btn--lg w-100"> @lang('Log In') </button>
                                </div>
                            </div>

                            @include($activeTemplate . 'partials.social_login')
                            <p class="text-center">
                                <a href="{{ route('user.password.request') }}" class="forgot-password"> @lang('Forgot password?') </a>
                            </p>
                            <p class="account-form__text"> @lang('Don\'t have on account yet?')
                                <a href="{{ route('user.register') }}" class="text--base"> @lang('Signing up is quick and easy.') </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
