@php
    @$ctaContent = getContent('cta.content', true);
@endphp

<div class="cta-section">
    <div class="cta-section__shape">
        <img src="{{ frontendImage('cta', @$ctaContent->data_values->background_image, '1905x355') }}" alt="image">
    </div>
    <div class="container">
        <div class="cta-wrapper">
            <div class="cta-wrapper__left">
                <h2 class="cta-wrapper__title">
                    {{ __(@$ctaContent->data_values->heading) }}
                </h2>
                <p class="cta-wrapper__desc"> {{ __(@$ctaContent->data_values->subheading) }} </p>
                <div class="cta-wrapper__btn">
                    <button class="btn--white btn"> @lang('Start Now') </button>
                </div>
            </div>
            <div class="cta-wrapper__right">
                <div class="cta-wrapper__thumb">
                    <img src="{{ frontendImage('cta', @$ctaContent->data_values->cta_image, '475x285') }}" alt="image">
                </div>
            </div>
        </div>
    </div>
</div>
