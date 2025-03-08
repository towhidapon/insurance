@php
    @$contactContent = getContent('contact_us.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="contact-section py-60">
        <span class="left-bg"></span>
        <div class="container">
            <div class="section-heading">
                <span class="section-heading__subtitle"> {{ __(@$contactContent->data_values->short_title) }} </span>
                <h2 class="section-heading__title">
                    {{ __(@$contactContent->data_values->heading) }}
                </h2>
                <p class="section-heading__desc">
                    {{ __(@$contactContent->data_values->subheading) }}
                </p>
            </div>
            <div class="contact-wrapper">
                <div class="row gy-4 gx-5">
                    <div class="col-lg-6">
                        <div class="contact-wrapper__map">
                            <iframe src="https://www.google.com/maps?q={{ @$contactContent->data_values->latitude }},{{ @$contactContent->data_values->longitude }}&hl=es&z=14&output=embed" width="600" height="450"
                                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <div class="contact-item">
                                <div class="contact-item__icon"> <i class="fa-solid fa-location-dot"></i> </div>
                                <div class="contact-item__content">
                                    <p class="contact-item__desc"> {{ __(@$contactContent->data_values->address) }} </p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-item__icon"> <i class="fa-solid fa-headset"></i> </div>
                                <div class="contact-item__content">
                                    <p class="contact-item__desc"> <a href="tel:"> {{ __(@$contactContent->data_values->contact_number) }} </a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <h4 class="contact-form__title"> @lang('Contact With Us') </h4>
                            <form method="post" class="verify-gcaptcha">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 col-sm-6 form-group">
                                        <label for="name" class="form--label label-two">@lang('Name') </label>
                                        <input type="text" class="form-control form--control" id="name" name="name" placeholder="@lang('Enter your name')" value="{{ old('name', @$user->fullname) }}"
                                            @if ($user && $user->profile_complete) readonly @endif required>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-sm-6 form-group">
                                        <label for="email" class="form--label  label-two"> @lang('Email') </label>
                                        <input type="email" name="email" class="form-control form--control" id="email" placeholder="olivia@untitledui.com" value="{{ old('email', @$user->email) }}"
                                            @if ($user) readonly @endif required>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label for="sub" class="form--label  label-two"> @lang('Your Subject') </label>
                                        <input type="text" name="subject" class="form-control form--control" id="sub" placeholder="@lang('Enter your subject')" value="{{ old('subject') }}" required>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label for="mes" class="form--label  label-two"> @lang('Message') </label>
                                        <textarea class="form-control form--control" name="message" id="mes" cols="30" rows="10" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <div class="contact-form__btn">
                                    <button type="submit" class="btn btn--base w-100">@lang('Submit Now') <span class="icon"><i class="fa-solid fa-arrow-trend-up"></i></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include($activeTemplate . 'sections.faq')
    @include($activeTemplate . 'sections.cta')


    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection


@push('style')
    <style>
        label.required:after {
            content: '*';
            color: #DC3545 !important;
            margin-left: 2px;
        }
    </style>
@endpush
