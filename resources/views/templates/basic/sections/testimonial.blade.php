@php
    @$testimonialContent = getContent('testimonial.content', true);
    @$testimonialElements = getContent('testimonial.element', false, orderById: true);
@endphp

<section class="testimonials py-60">
    <span class="right-bg"></span>
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" data-highlight="[3]">
                {{ __(@$testimonialContent->data_values->heading) }}

            </h2>
            <p class="section-heading__desc">
                {{ __(@$testimonialContent->data_values->subheading) }}
            </p>
        </div>
        <div class="testimonial-slider">
            @foreach ($testimonialElements as $testimonialElement)
                <div class="testimonails-card">
                    <div class="testimonial-item">
                        <div class="testimonial-item__rating">
                            <ul class="rating-list">
                                @for ($i = 0; $i < $testimonialElement->data_values->rating; $i++)
                                    <li class="rating-list__item"><i class="fas fa-star"></i></li>
                                @endfor
                            </ul>
                        </div>
                        <div class="testimonial-item__content">
                            <p class="testimonial-item__title"> </p>
                            <p class="testimonial-item__desc">
                                {{ __($testimonialElement->data_values->description) }}
                            </p>
                        </div>
                        <div class="testimonial-item__info">

                            <div class="testimonial-item__thumb">
                                <img src="{{ frontendImage('testimonial', $testimonialElement->data_values->customer_image, '30x30') }}" class="fit-image" alt="image">
                            </div>
                            <div class="testimonial-item__details">
                                <p class="testimonial-item__name"> {{ __($testimonialElement->data_values->customer_name) }}</p>
                                <span class="testimonial-item__designation">{{ __($testimonialElement->data_values->customer_designation) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
