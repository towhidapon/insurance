@php
    @$whyChooseContent = getContent('why_choose.content', true);
    @$whyChooseElements = getContent('why_choose.element', false);
@endphp

<div class="choose-us-section py-60">
    <span class="left-bg"></span>
    <span class="right-bg"></span>
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" data-highlight="[2]">
                {{ @$whyChooseContent->data_values->heading }}
            </h2>
            <p class="section-heading__desc"> {{ @$whyChooseContent->data_values->subheading }} </p>
        </div>
        <div class="choose-us-wrapper">
            <div class="choose-us-slider">
                @foreach ($whyChooseElements as $item)
                    <div class="choose-us-card">
                        <div class="choose-us-card__thumb">
                            <div class="choose-us-card__thumb-inner">
                                <img class="image1" src="{{ frontendImage('why_choose', @$item->data_values->image) }}" alt="image">
                                <img class="image2" src="{{ frontendImage('why_choose', @$item->data_values->image) }}" alt="image">
                            </div>
                        </div>
                        <div class="choose-us-card__content">
                            <h4 class="choose-us-card__title">
                                {{ __($item->data_values->title) }}
                            </h4>
                            <p class="choose-us-card__desc">
                                {{ __($item->data_values->details) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="choose-us-wrapper__bottom">
                <h4 class="title"> {{ @$whyChooseContent->data_values->button_heading }} </h4>
                <a href="#" class="btn btn--base"> @lang('Contact With Us') </a>
            </div>
        </div>
    </div>
</div>

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
@endpush
