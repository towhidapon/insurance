@php
    @$counterContent = getContent('counter.content', true);
    @$counterElements = getContent('counter.element', false, orderById: true);
@endphp

<div class="counter-section">
    <div class="counter-section__shape">
        <img src="{{ frontendImage('counter', @$counterContent->data_values->bg_image) }}" alt="image">
    </div>
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" data-highlight="[5]">{{ __(@$counterContent->data_values->heading) }}</h2>
        </div>
        <div class="row gy-5 justify-content-center">
            @foreach ($counterElements as $counterElement)
                <div class="col-md-4 col-sm-6">
                    <div class="counter-item">
                        <div class="counter-item__number">
                            <span class="odometer" data-odometer-final="{{ $counterElement->data_values->number }}"></span>{{ $counterElement->data_values->sign }}
                        </div>
                        <h4 class="counter-item__title"> {{ $counterElement->data_values->title }} </h4>
                        <p class="counter-item__desc">
                            {{ $counterElement->data_values->short_decription }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>


@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/odometer.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/odometer.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/viewport.jquery.js') }}"></script>
@endpush
