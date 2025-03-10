@php
    @$verifyInsuranceContent = getContent('verify_insurance.content', true);
    @$verifyInsuranceElements = getContent('verify_insurance.element', false);
@endphp

<div class="step-section py-60">
    <span class="left-bg"></span>
    <span class="right-bg"></span>
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title"> {{ __(@$verifyInsuranceContent->data_values->heading) }} </h2>
            <p class="section-heading__desc">
                {{ __(@$verifyInsuranceContent->data_values->sub_heading) }}
            </p>
        </div>
        <div class="step-wrapper">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-6">
                    <ul class="step-list">
                        @foreach ($verifyInsuranceElements as $verifyInsuranceElement)
                            <li class="step-list__item">
                                <span class="step-list__number"></span>
                                <div class="step-list__content">
                                    <h4 class="step-list__title"> {{ __(@$verifyInsuranceElement->data_values->title) }} </h4>
                                    <p class="step-list__desc"> {{ __(@$verifyInsuranceElement->data_values->short_description) }} </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="step-wrapper__right">
                        <label class="form--label"> @lang('Enter Your User ID') </label>
                        <div class="step-wrapper__verify">
                            <input type="text" class="form--control" placeholder="Enter">
                            <button type="button" class="btn btn--base">@lang('Verify Now') </button>
                        </div>
                        <div class="insurance-details">
                            <span class="insurance-details__title"> @lang('Insurance Details') </span>
                            <p class="insurance-details__item"> Insurance Holder Name: <span class="text"> John Ro </span></p>
                            <p class="insurance-details__item"> Insurance Number: <span class="text"> 45345 </span></p>
                            <p class="insurance-details__item"> Insurance Holder Name: <span class="text"> John Ro </span></p>
                            <p class="insurance-details__item"> Insurance Number: <span class="text"> 45345 </span></p>
                            <p class="insurance-details__item"> Insurance Holder Name: <span class="text"> John Ro </span></p>
                            <p class="insurance-details__item"> Insurance Number: <span class="text"> 45345 </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
