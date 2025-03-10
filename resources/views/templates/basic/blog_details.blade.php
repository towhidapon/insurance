@php
    @$blogContent = getContent('blog.content', true);
    @$blogElements = getContent('blog.element', false, orderById: true);
@endphp


@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="blog-detials my-60">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-xxl-8 col-xl-7">
                    <div class="blog-details">
                        <div class="blog-details__thumb">
                            <img src="{{ frontendImage('blog', @$blog->data_values->image, '855x450') }}" class="fit-image" alt="image">
                        </div>
                        <div class="blog-details__content">
                            <h3 class="blog-details__title"> {{ __(@$blog->data_values->title) }} </h3>
                            <div class="blog-item__bottom">
                                <span class="title"> @lang('Published') </span>
                                <ul class="text-list flex-align">
                                    <li class="text-list__item fs-14"> {{ showDateTime(@$blog->created_at, 'd M Y') }} </li>
                                </ul>
                            </div>
                            <div class="content-wrapper">
                                <p class="blog-details__desc">
                                    @php echo $blog->data_values->description @endphp
                                </p>
                            </div>

                            <div class="blog-details__share mt-4 d-flex align-items-center flex-wrap">
                                <h5 class="social-share__title mb-0 me-sm-3 me-1 d-inline-block">@lang('Share This')</h5>
                                <ul class="social-list">
                                    <ul class="social-list">
                                        <li class="social-list__item">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" class="social-list__link flex-center" target="_blank">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li class="social-list__item">
                                            <a href="https://x.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode(@$blog->data_values->title) }}" class="social-list__link flex-center" target="_blank">
                                                <i class="fab fa-x-twitter"></i>
                                            </a>
                                        </li>

                                        <li class="social-list__item">
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode(@$blog->data_values->title) }}"
                                                class="social-list__link flex-center" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <li class="social-list__item">
                                            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode(frontendImage('blog', @$blog->data_values->image)) }}&description={{ urlencode(@$blog->data_values->title) }}"
                                                class="social-list__link flex-center" target="_blank">
                                                <i class="fab fa-pinterest"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </ul>
                                <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-5">
                    <!-- ============================= Blog Details Sidebar Start ======================== -->
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h4 class="blog-sidebar__title"> @lang('Latest Blog') </h4>
                            @foreach ($blogElements as $blogElement)
                                <div class="latest-blog">
                                    <div class="latest-blog__thumb">
                                        <a href="{{ route('blog.details', $blogElement->slug) }}"> <img src="{{ frontendImage('blog', 'thumb_' . @$blogElement->data_values->image) }}" class="fit-image" alt="image"></a>
                                    </div>
                                    <div class="latest-blog__content">
                                        <h6 class="latest-blog__title"><a href="{{ route('blog.details', @$blogElement->slug) }}"> </a>{{ __($blogElement->data_values->title) }}</h6>
                                        <div class="latest-blog__bottom">
                                            <span class="title"> @lang('Published') </span>
                                            <ul class="text-list flex-align">
                                                <li class="text-list__item fs-14">{{ showDateTime($blogContent->created_at, format: 'M d , Y') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- ============================= Blog Details Sidebar End ======================== -->
                </div>
                <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
            </div>
        </div>
    </section>
@endsection
@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
