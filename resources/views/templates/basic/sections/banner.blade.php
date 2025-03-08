@php
    use App\Models\Category;
    $categories = Category::where('status', 1)->get();
    @$bannerContent = getContent('banner.content', true);
@endphp

<section class="banner-section">
    <div class="banner-section__shape">
        <img src="{{ frontendImage('banner', @$bannerContent->data_values->banner_shape) }}" alt="image">
    </div>
    <div class="container">
        <div class="banner-container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-7">
                    <div class="banner-content">
                        <span class="banner-content__subtitle"> {{ @$bannerContent->data_values->title }} </span>
                        <h2 class="banner-content__title"> {{ @$bannerContent->data_values->subtitle }} </h2>
                        <p class="banner-content__desc"> {{ @$bannerContent->data_values->short_details }}</p>
                        <div class="banner-content__button flex-wrap d-flex align-items-center gap-3">
                            <button class="btn--base btn btn--lg"> @lang('Get a Free Quote') </button>
                            <a href="{{ route('user.register') }}" class="btn btn--white btn--lg">@lang(' Register Now ')</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 ps-xl-5">
                    <div class="banner-thumb-wrapper">
                        <div class="banner-thumb">
                            <img src="{{ frontendImage('banner', @$bannerContent->data_values->banner_image) }}" alt="image">
                        </div>
                        <div class="banner-thumb-wrapper__client">
                            <h3 class="title"> @lang('25K ')</h3>
                            <p class="text"> @lang('Happy Customer') </p>
                            <img src="{{ frontendImage('banner', @$bannerContent->data_values->mini_image) }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="category-container">
            <div class="row gy-4 justify-content-center">
                @foreach ($categories as $category)
                    <div class="col-xxl-2 col-md-4 col-sm-6">
                        <a href="#" class="category-item">
                            <div class="category-item__thumb">
                                <img src="{{ getImage(getFilePath('categoryIconImage') . '/' . $category->icon, getFileSize('categoryIconImage')) }}" alt="image">
                            </div>
                            <p class="category-item__title"> {{ $category->name }} </p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
