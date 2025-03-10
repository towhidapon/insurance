@php
    $registerContent = getContent('login_register.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @if (gs('registration'))

        <section class="account register bg-img" data-background-image="{{ frontendImage('login_register', @$registerContent->data_values->background_image, '1905x840') }}">
            <div class="container">
                <div class="account-inner">
                    <div class="account-form-wrapper">
                        <div class="account-form-wrapper__top">
                            <h4 class="account-form-wrapper__title"> {{ __(@$registerContent->data_values->register_page_title) }} </h4>
                            <p class="account-form-wrapper__text">
                                {{ __(@$registerContent->data_values->register_page_subtitle) }}
                            </p>
                        </div>
                        <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha disableSubmission">
                            @csrf
                            <div class="account-form">
                                <div class="row gy-4">
                                    <div class="col-sm-6">
                                        <label for="name" class="form-label form--label"> @lang('First Name') </label>
                                        <input type="text" class="form-control form--control form-two" placeholder="Enter Name" id="name" name="firstname" value="{{ old('firstname') }}" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="name" class="form-label form--label"> @lang('last Name') </label>
                                        <input type="text" class="form-control form--control form-two" placeholder="Enter Name" id="name" name="lastname" value="{{ old('lastname') }}" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="email" class="form-label form--label"> @lang('Email') </label>
                                        <input type="email" class="form-control form--control form-two checkUser" placeholder="Email address" id="email" name="email" value="{{ old('email') }}" required>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="form--label"> @lang('Phone Number') </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <select class="form-select form--control country-code">
                                                    @foreach ($countries as $key => $country)
                                                        <option data-mobile_code="{{ $country->dial_code }}" value="{{ $key }}">
                                                            +{{ $country->dial_code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="mobile_code">
                                            <input type="hidden" name="country_code">
                                            <input type="text" class="form-control form--control phone-number" name="mobile" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="your-password" class="form-label form--label">@lang('Password')</label>
                                        <div class="position-relative">
                                            <input id="your-password" type="password" class="form-control form--control form-two @if (gs('secure_password')) secure-password @endif" value="Password" name="password"
                                                required>
                                            <span class="password-show-hide fa-solid fa-eye-slash toggle-password" id="#your-password"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="confirm-password" class="form--label">@lang('Confirm Password')</label>
                                        <div class="position-relative">
                                            <input id="confirm-password" type="password" class="form-control form--control  form-two" value="Confirm Password" name="password_confirmation" required>
                                            <div class="password-show-hide fa-solid fa-eye-slash toggle-password" id="#confirm-password"></div>
                                        </div>
                                    </div>
                                    <x-captcha />
                                    @if (gs('agree'))
                                        @php
                                            $policyPages = getContent('policy_pages.element', false, orderById: true);
                                        @endphp
                                        <div class="col-sm-12">
                                            <div class="flex-between">
                                                <div class="form--check">
                                                    <input class="form-check-input" type="checkbox" id="agree" name="agree" required @checked(old('agree'))>
                                                    <label class="form-check-label" for="agree">
                                                        @lang('I agree to the')
                                                        @foreach ($policyPages as $policy)
                                                            <a href="{{ route('policy.pages', $policy->slug) }}" target="_blank" class="link">
                                                                {{ __($policy->data_values->title) }}
                                                            </a>
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-sm-12 form-group mt-4">
                                        <button type="submit" class="btn btn--base btn--lg w-100"> @lang('Sign Up Account') </button>
                                    </div>
                                </div>
                                @include($activeTemplate . 'partials.social_login')
                                <p class="account-form__text"> @lang('Already have an account?')
                                    <a href="{{ route('user.login') }}">@lang('Login')</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                        <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </span>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                        <a href="{{ route('user.login') }}" class="btn btn--base btn-sm">@lang('Login')</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include($activeTemplate . 'partials.registration_disabled')
    @endif

@endsection
@if (gs('registration'))

    @push('style')
        <style>
            .social-login-btn {
                border: 1px solid #cbc4c4;
            }
        </style>
    @endpush

    @if (gs('secure_password'))
        @push('script-lib')
            <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
        @endpush
    @endif

    @push('script')
        <script>
            "use strict";
            (function($) {

                $('.checkUser').on('focusout', function(e) {
                    var url = '{{ route('user.checkUser') }}';
                    var value = $(this).val();
                    var token = '{{ csrf_token() }}';

                    var data = {
                        email: value,
                        _token: token
                    }

                    $.post(url, data, function(response) {
                        if (response.data != false) {
                            $('#existModalCenter').modal('show');
                        }
                    });
                });
            })(jQuery);
        </script>
    @endpush

@endif
