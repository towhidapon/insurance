@php
    use App\Models\Category;
    @$categories = Category::where('status', 1)->take(3)->get();
    @$popularContent = getContent('popular.content', true);
@endphp

<div class="popular-section py-60">
    <span class="left-bg"></span>
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" data-highlight="[3]">
                {{ __(@$popularContent->data_values->heading) }}
            </h2>
            <p class="section-heading__desc"> {{ __(@$popularContent->data_values->subheading) }} </p>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($categories as $category)
                <div class="col-lg-4 col-sm-6">
                    <div class="popular-item">
                        <div class="popular-item__thumb">
                            <a href="#" class="popular-item__thumb-link">
                                <img class="image1" src="{{ getImage(getFilePath('categoryImage') . '/' . $category->image, getFileSize('categoryImage')) }}" alt="img1">
                                <img class="image2" src="{{ getImage(getFilePath('categoryImage') . '/' . $category->image, getFileSize('categoryImage')) }}" alt="img2">
                            </a>
                        </div>
                        <div class="popular-item__content">
                            <h4 class="popular-item__title">
                                <a href="{{ route('category.details', $category->id) }}" class="popular-item__title-link border-effect"> {{ __($category->name) }} </a>
                            </h4>
                            <div class="advantage-wrapper">
                                <p class="advantage-wrapper__title"> @lang('Benefits:') </p>
                                <ul class="value-list">
                                    @if (!empty($category->benefit) && is_array($category->benefit))
                                        @foreach ($category->benefit as $benefit)
                                            <li class="value-list__item">
                                                <span class="value-list__icon">
                                                    <i class="las la-check-circle"></i>
                                                </span>
                                                {{ __($benefit) }}
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="value-list__item">@lang('No benefits available.')</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="popular-item__bottom">
                                <a href="{{ route('category.details', $category->id) }}" class="btn--white btn w-100">
                                    @lang('Get Your Insurance Now')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
