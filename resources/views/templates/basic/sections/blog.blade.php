@php
    @$blogContent = getContent('blog.content', true);
    @$blogElements = getContent('blog.element', false, orderById: true)->take(4);
@endphp


<section class="blog py-60">
    <span class="left-bg"></span>
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title">{{ @$blogContent->data_values->heading }}</h2>
            <p class="section-heading__desc">
                {{ @$blogContent->data_values->subheading }}
            </p>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($blogElements as $blogElement)
                <div class="col-md-6">
                    <div class="blog-item">
                        <div class="blog-item__thumb">
                            <a href="{{ route('blog.details', $blogElement->slug) }}" class="blog-item__thumb-link">
                                <img class="image1" src="{{ frontendImage('blog', 'thumb_' . @$blogElement->data_values->image) }}" alt="img1">
                                <img class="image2" src="{{ frontendImage('blog', 'thumb_' . @$blogElement->data_values->image) }}" alt="img2">
                            </a>
                        </div>
                        <div class="blog-item__content">
                            <h4 class="blog-item__title"><a href="{{ route('blog.details', $blogElement->slug) }}" class="blog-item__title-link border-effect">
                                    {{ __(@$blogElement->data_values->title) }}</a>
                            </h4>
                            <p class="blog-item__desc">
                                {{ __(@$blogElement->data_values->short_description) }}
                            </p>
                            <div class="blog-item__bottom">
                                <span class="title"> @lang('Published') </span>
                                <ul class="text-list flex-align">
                                    <li class="text-list__item fs-14"> {{ showDateTime(@$blogElement->created_at, 'd M Y') }} </li>
                                    <li class="text-list__item fs-14"> @lang('5 min read') </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="blog__bottom">
            <button class="btn--base btn"> @lang('View All')</button>
        </div>
    </div>
</section>
