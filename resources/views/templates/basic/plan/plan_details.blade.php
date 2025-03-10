@php
    @$insuranceContent = getContent('insurance_list.content', true);
    @$insuranceElements = getContent('insurance_list.element', false, orderById: true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="plan-details-section py-60">
        <div class="plan-details-section__shape">
            <img src="{{ frontendImage('insurance_list', $insuranceContent->data_values->background_shape) }}" alt="image">
        </div>
        <div class="container">
            <div class="plan-section__btn">
                <a href="javascript:void(0);" class="back-btn">
                    <span class="back-btn__icon">
                        <i class="las la-arrow-left"></i>
                    </span> @lang('Back')
                </a>
            </div>

            <div class="plan-container">
                <div class="plan-wrapper">
                    <div class="plan-wrapper__left">
                        <div class="plan-item">
                            <div class="plan-item__content">
                                <p class="plan-item__title"> @lang('Health Coverage') </p>
                                <h6 class="plan-item__number">{{ showAmount($plan->price) }}</h6>
                                <div class="plan-item__bottom">
                                    <p class="plan-item__desc"> <span class="icon"> <i class="fa-solid fa-circle-info"></i> </span> @lang('Family Floater Plan') </p>
                                </div>
                            </div>
                            <div class="plan-item__content">
                                <p class="plan-item__title"> @lang('Premium') </p>
                                <h6 class="plan-item__number"> {{ showAmount($plan->price) }} </h6>
                                <div class="plan-item__bottom">
                                    <p class="plan-item__desc"> @lang('Policy Duration:') {{ $plan->validity }} @lang('Year') </p>
                                    <p class="plan-item__desc"> @lang('Total Sum Insured') {{ showAmount($plan->coverage_amount) }} </p>
                                </div>
                            </div>
                            <div class="plan-item__content flex-align gap-2">
                                <span class="plan-item__icon">
                                    <img src="{{ frontendImage('insurance_list', @$insuranceContent->data_values->feature_image) }}" alt="image">
                                </span>
                                <div class="plan-item__bottom">
                                    <span class="text"> @lang('Special Features:') </span>
                                    <p class="plan-item__desc"> @lang('Policy Duration:') {{ $plan->validity }} @lang('Year') </p>
                                    <p class="plan-item__desc"> @lang('Total Sum Insured') {{ showAmount($plan->coverage_amount) }} </p>
                                </div>
                            </div>
                            <div class="plan-item__content flex-align gap-2">
                                <span class="plan-item__icon">
                                    <img src="{{ frontendImage('insurance_list', @$insuranceContent->data_values->feature_image) }}" alt="image">
                                </span>
                                <div class="plan-item__bottom">
                                    <span class="text"> @lang('Special Features:') </span>
                                    <p class="plan-item__desc"> @lang('Policy Duration:') {{ $plan->validity }} @lang('Year') </p>
                                    <p class="plan-item__desc"> @lang('Total Sum Insured') {{ showAmount($plan->coverage_amount) }} </p>
                                </div>
                            </div>
                            <div class="plan-item__content">
                                <button class="btn btn--white"> @lang('Buy Now') </button>
                            </div>
                        </div>
                        <div class="plan-details__item">
                            <h3 class="plan-details__title"> What is not covered? </h3>
                            <div class="content-list-wrapper">
                                <div class="content-list-wrapper__left">
                                    <div class="form-check form--check">
                                        <input class="form-check-input" type="checkbox" id="Checkbox1" value="option1">
                                        <label class="form-check-label" for="Checkbox1"> Congenital diseases/birth defects </label>
                                    </div>
                                    <div class="form-check form--check">
                                        <input class="form-check-input" type="checkbox" id="Checkbox2" value="option1">
                                        <label class="form-check-label" for="Checkbox2"> Congenital diseases/birth defects </label>
                                    </div>
                                    <div class="form-check form--check">
                                        <input class="form-check-input" type="checkbox" id="Checkbox3" value="option1">
                                        <label class="form-check-label" for="Checkbox3"> Congenital diseases/birth defects </label>
                                    </div>
                                    <div class="form-check form--check">
                                        <input class="form-check-input" type="checkbox" id="Checkbox4" value="option1">
                                        <label class="form-check-label" for="Checkbox4"> Congenital diseases/birth defects </label>
                                    </div>
                                    <div class="form-check form--check">
                                        <input class="form-check-input" type="checkbox" id="Checkbox5" value="option1">
                                        <label class="form-check-label" for="Checkbox5"> Congenital diseases/birth defects </label>
                                    </div>
                                </div>
                                <div class="compare-list-wrapper__right">
                                    <div class="form-check form--check">
                                        <input class="form-check-input" type="checkbox" id="Checkbox6" value="option1">
                                        <label class="form-check-label" for="Checkbox6"> Congenital diseases/birth defects </label>
                                    </div>
                                    <div class="form-check form--check">
                                        <input class="form-check-input" type="checkbox" id="Checkbox7" value="option1">
                                        <label class="form-check-label" for="Checkbox7"> Congenital diseases/birth defects </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="plan-details__item">
                            <h3 class="plan-details__title"> Features </h3>
                            <div class="feature-list">
                                <div class="feature-item">
                                    <span class="feature-item__icon">
                                        <img src="assets/images/thumbs/f-1.png" alt="">
                                    </span>
                                    <p class="feature-item__text"> Co-payment </p>
                                    <h6 class="feature-item__title"> 500 Tk. per claim </h6>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-item__icon">
                                        <img src="assets/images/thumbs/f-1.png" alt="">
                                    </span>
                                    <p class="feature-item__text"> Co-payment </p>
                                    <h6 class="feature-item__title"> 500 Tk. per claim </h6>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-item__icon">
                                        <img src="assets/images/thumbs/f-2.png" alt="">
                                    </span>
                                    <p class="feature-item__text"> Co-payment </p>
                                    <h6 class="feature-item__title"> 500 Tk. per claim </h6>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-item__icon">
                                        <img src="assets/images/thumbs/f-3.png" alt="">
                                    </span>
                                    <p class="feature-item__text"> Co-payment </p>
                                    <h6 class="feature-item__title"> 500 Tk. per claim </h6>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-item__icon">
                                        <img src="assets/images/thumbs/f-4.png" alt="">
                                    </span>
                                    <p class="feature-item__text"> Co-payment </p>
                                    <h6 class="feature-item__title"> 500 Tk. per claim </h6>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-item__icon">
                                        <img src="assets/images/thumbs/f-5.png" alt="">
                                    </span>
                                    <p class="feature-item__text"> Co-payment </p>
                                    <h6 class="feature-item__title"> 500 Tk. per claim </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="plan-wrapper__right">
                        <div class="plan-sidebar">
                            <div class="plan-sidebar__top">
                                <div class="plan-sidebar__top-left">
                                    <h6 class="plan-sidebar__title">
                                        Tips for selecting the best plan
                                    </h6>
                                </div>
                                <span class="icon">
                                    <img src="assets/images/thumbs/plan-2.png" alt="">
                                </span>
                            </div>
                            <ul class="plan-list">
                                <li class="plan-list__item">
                                    <span class="plan-list__icon"> <i class="fa-regular fa-circle-question"></i> </span>
                                    <div class="plan-list__content">
                                        Look for plans with <span class="plan-list__item-text"> minimum Waiting Periods
                                        </span>
                                    </div>
                                </li>
                                <li class="plan-list__item">
                                    <span class="plan-list__icon"> <i class="fa-regular fa-circle-question"></i> </span>
                                    <div class="plan-list__content">
                                        Look for plans with <span class="plan-list__item-text"> low
                                            co-payment/co-insurance </span>
                                    </div>
                                </li>
                                <li class="plan-list__item">
                                    <span class="plan-list__icon"> <i class="fa-regular fa-circle-question"></i> </span>
                                    <div class="plan-list__content">
                                        Plans with <span class="plan-list__item-text">OPD benefits </span> provide
                                        coverage
                                        for out-door treatments
                                    </div>
                                </li>
                                <li class="plan-list__item">
                                    <span class="plan-list__icon"> <i class="fa-regular fa-circle-question"></i> </span>
                                    <div class="plan-list__content">
                                        Choose plans with <span class="plan-list__item-text"> Cashless/Direct Payment
                                            Facility </span>
                                    </div>
                                </li>
                                <li class="plan-list__item">
                                    <span class="plan-list__icon"> <i class="fa-regular fa-circle-question"></i> </span>
                                    <div class="plan-list__content">
                                        If you worry about critical illnesses then look for plans with <span class="plan-list__item-text"> Critical Illness (CI) benefits </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="plan-sidebar">
                            <div class="plan-sidebar__top">
                                <div class="plan-sidebar__top-left">
                                    <h6 class="plan-sidebar__title">
                                        Need more help?
                                    </h6>
                                    <p class="plan-sidebar__text"> We are always here to assist you! </p>
                                </div>
                                <span class="icon">
                                    <img src="assets/images/thumbs/plan-3.png" alt="">
                                </span>
                            </div>
                            <form action="#" class="plan-form">
                                <div class="row gy-3">
                                    <div class="col-sm-12">
                                        <label class="form--label"> Select Your Topic </label>
                                        <select class="form-select form--control select2">
                                            <option selected>Select</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form--label"> Phone Number </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <select class="form-select form--control">
                                                    <option selected=""> US</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <input type="text" class="form-control form--control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="mes" class="form--label  label-two"> Description </label>
                                        <textarea class="form--control" id="mes" cols="30" rows="10">Type your message..</textarea>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn--base w-100"> Submit Now </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include($activeTemplate . 'sections.cta')
@endsection


@push('script')
    <script>
        "use strict";

        (function($) {

            $('.back-btn').on('click', function(e) {
                e.preventDefault();
                window.history.back();
            });

        })(jQuery);
    </script>
@endpush
