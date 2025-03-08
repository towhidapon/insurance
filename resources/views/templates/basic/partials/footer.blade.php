@php
    @$footerContent = getContent('footer.content', true);
    @$footerIcons = getContent('social_icon.element', false, orderById: true);
    @$contactContent = getContent('contact_us.content', true);
@endphp

<footer class="footer-area">
    <div class="pt-60">
        <div class="container">
            <div class="top-footer newsletter-content">
                <div class="top-footer__left">
                    <h6 class="top-footer__title"> {{ __($footerContent->data_values->newsletter_title) }} </h6>
                    <p class="top-footer__desc"> {{ __($footerContent->data_values->newsletter_subtitle) }} </p>
                </div>
                <div class="top-footer__right">
                    <form method="POST" action="{{ route('subscribe') }}" class="newsletter-form">
                        @csrf
                        <div class="top-footer__mail">
                            <input type="email" name="email" id="email" class="form--control"
                                placeholder="Enter email">
                            <button type="submit" class="btn--white btn"> @lang('Subscribe') </button>
                        </div>
                    </form>
                    <p class="top-footer__text"> @lang('Stay up to date with the latest news, announcements, and articles.') </p>
                </div>
            </div>
            <div class="row justify-content-center gy-5">
                <div class="col-xl-5 col-sm-6 col-xsm-6 pe-xl-5">
                    <div class="footer-item">
                        <div class="footer-item__logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ siteLogo() }}" alt="logo">
                            </a>
                        </div>
                        <h6 class="title"> {{ __($footerContent->data_values->title) }} </h6>
                        <p class="footer-item__desc">
                            {{ __($footerContent->data_values->short_details) }}
                        </p>
                        <div class="social-list-wrapper">
                            <h6 class="social-list-wrapper__title"> @lang('Stay Connected') </h6>
                            <ul class="social-list">
                                @foreach ($footerIcons as $footerIcon)
                                    <li class="social-list__item">
                                        <a href="{{ @$footerIcon->data_values->url }}"
                                            class="social-list__link flex-center">
                                            @php
                                                echo @$footerIcon->data_values->social_icon;
                                            @endphp
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h6 class="footer-item__title"> @lang('Quick Links') </h6>
                        <ul class="footer-menu">
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link"> @lang('Our Insurances')
                                </a></li>
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link"> @lang('Claims Process')
                                </a></li>
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link"> @lang('Blog')
                                </a></li>
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link"> @lang('FAQs')
                                </a></li>
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link"> @lang('Contact Us')
                                </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h6 class="footer-item__title"> @lang('Popular Policies') </h6>
                        <ul class="footer-menu">
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link">
                                    @lang('Life Insurance')</a></li>
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link">
                                    @lang('Health Insurance') </a></li>
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link">
                                    @lang('Car Insurance') </a></li>
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link">
                                    @lang('Home Insurance') </a></li>
                            <li class="footer-menu__item"><a href="#" class="footer-menu__link">
                                    @lang('Travel Insurance') </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h6 class="footer-item__title"> @lang('Support') </h6>
                        <ul class="footer-contact-menu">
                            <li class="footer-contact-menu__item">
                                <p class="text"> @lang('Address'): </p>
                                <div class="footer-contact-menu__item-content">
                                    <p> {{ __($contactContent->data_values->address) }} </p>
                                </div>
                            </li>
                            <li class="footer-contact-menu__item">
                                <p class="text"> @lang('Email'):</p>
                                <div class="footer-contact-menu__item-content">
                                    <p> {{ __($contactContent->data_values->email) }} </p>
                                </div>
                            </li>
                            <li class="footer-contact-menu__item">
                                <p class="text"> @lang('Phone'): </p>
                                <div class="footer-contact-menu__item-content">
                                    <p> {{ __($contactContent->data_values->contact_number) }} </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- bottom Footer -->
            <div class="bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p class="bottom-footer-text text-white"> &copy; @lang('Copyright') @php echo date('Y') @endphp .
                                @lang('All rights reserved').</p>
                            <p class="bottom-footer__desc"> @lang('Your trusted partner in protection.') </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Top End-->

</footer>


@push('script')
    <script>
        "use strict";
        (function($) {
            $('.newsletter-form').on("submit", function(e) {
                e.preventDefault();
                var email = $('#email').val();
                const formData = new FormData($(this)[0]);

                $.ajax({
                    type: "post",
                    url: "{{ route('subscribe') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('.newsletter-form').trigger('reset');
                        if (response.status == 'success') {
                            notify('success', response.message);
                            $('.newsletter-content').html(response.html);
                        } else {
                            notify('error', response.message);
                        }
                    }
                });
            })
        })(jQuery);
    </script>
@endpush
