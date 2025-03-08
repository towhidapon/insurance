@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        @$blogContent = getContent('blog.content', true);
        @$blogElements = getContent('blog.element', false, orderById: true);
    @endphp

    <div class="blog-section mt-60 mb-60">
        <div class="container">
            <div class="section-heading">
                <h2 class="section-heading__title" data-highlight="[4]">{{ __(@$blogContent->data_values->blog_page_title) }}</h2>
                <p class="section-heading__desc">{{ __(@$blogContent->data_values->blog_page_subtitle) }}</p>
            </div>
            <div class="row gy-4 justify-content-center">
                @foreach ($blogElements as $blogElement)
                    <div class="col-xl-4 col-sm-6">
                        <div class="blog-item item-two">
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
        </div>
    </div>
    @include($activeTemplate . 'sections.cta')
@endsection
