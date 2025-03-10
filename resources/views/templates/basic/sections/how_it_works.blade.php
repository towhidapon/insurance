@php
    @$howItWorkContent = getContent('how_it_works.content', true);
    @$howItWorkElements = getContent('how_it_works.element', false, orderById: true);
@endphp

<div class="how-work-section py-60">
    <span class="left-bg"></span>
    <span class="right-bg"></span>

    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" data-highlight="2">
                {{ __(@$howItWorkContent->data_values->heading) }}
            </h2>
            <p class="section-heading__desc">
                {{ __(@$howItWorkContent->data_values->subheading) }}
            </p>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($howItWorkElements as $howItWorkElement)
                <div class="col-lg-4 col-sm-6">
                    <div class="how-work-item">
                        <div class="how-work-item__thumb">
                            <img src="{{ frontendImage('how_it_works', @$howItWorkElement->data_values->image, '64x64') }}" alt="image">
                        </div>
                        <h4 class="how-work-item__title">{{ $loop->iteration }}. {{ __(@$howItWorkElement->data_values->title) }} </h4>
                        <p class="how-work-item__desc">
                            {{ __(@$howItWorkElement->data_values->description) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="how-work-section__bottom">
            <a href="#" class="btn btn--base"> @lang('Apply Now') </a>
        </div>
    </div>
</div>
