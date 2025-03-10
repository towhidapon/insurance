@php
    @$coverageContent = getContent('coverage.content', true);
    @$coverageElements = getContent('coverage.element', false, orderById: true);
@endphp


<div class="brand-section py-60 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-heading style-three">
                    <h2 class="section-heading__title"> {{ __(@$coverageContent->data_values->title) }}</h2>
                    <p class="section-heading__desc">{{ __(@$coverageContent->data_values->subtitle) }}</p>
                </div>
            </div>
        </div>
        <div class="client-logos brand-slider">
            @foreach ($coverageElements as $coverageElement)
                <img src="{{ frontendImage('coverage', @$coverageElement->data_values->image, '160X45') }}" alt="image">
            @endforeach
        </div>
    </div>
</div>


@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
@endpush
