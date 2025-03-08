@php
    use App\Models\Category;
    $categories = Category::where('status', 1)->get();
@endphp

<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-xl navbar-light">
            <a class="navbar-brand logo" href="{{ route('home') }}">
                <img src="{{ siteLogo('dark') }}" alt="logo">
            </a>
            <button class="navbar-toggler header-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>
            <div class="offcanvas border-0 offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar">
                <div class="offcanvas-header">
                    <a class="logo navbar-brand" href="{{ route('home') }}">
                        <img src="{{ siteLogo() }}" alt="logo">
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    </button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-menu align-items-xl-center w-100">

                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}">@lang('Home')</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                @lang('Our Services') <span class="nav-item__icon"><i class="las la-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu header-dropdown">

                                @foreach ($categories as $category)
                                    <li class="dropdown-menu__list">
                                        <a class="dropdown-item dropdown-menu__link" href="{{ route('category.details', $category->id) }}">{{ __($category->name) }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"> @lang('Claims') </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blogs') }}"> @lang('Blog') </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}"> @lang('Contact Us') </a>
                        </li>
                        <li class="nav-item d-xl-none d-block">
                            <div class="account-btn-groups d-flex justify-content-between gap-2 align-items-center">
                                <a href="{{ route('user.login') }}" class="btn btn--white"> @lang('Log In') </a>
                                <a href="{{ route('user.register') }}" class="btn btn--base">
                                    @lang('Register Now')
                                </a>
                                <div class="dropdown lang-box">
                                    @if (gs('multi_language'))
                                        @php
                                            $language = App\Models\Language::all();
                                        @endphp
                                        <button class="lang-box-btn" data-bs-toggle="dropdown">
                                            @php
                                                $selectedLang = $language->where('code', session('lang'))->first() ?? $language->first();
                                            @endphp
                                            <span class="thumb">
                                                <img class="fit-image" src="{{ getImage(getFilePath('language') . '/' . $selectedLang->image) }}" alt="flag">
                                            </span>
                                            <span class="text">{{ strtoupper(__($selectedLang->name)) }}</span>
                                            <span class="icon">
                                                <i class="fas fa-angle-down"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach ($language as $item)
                                                <li class="lang-box-item" data-code="en">
                                                    <a href="{{ route('lang', $item->code) }}" class="lang-box-link">
                                                        <div class="thumb">
                                                            <img class="fit-image" src="{{ getImage(getFilePath('language') . '/' . $item->image) }}" alt="flag">
                                                        </div>
                                                        <span class="text">{{ strtoupper(__($item->name)) }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="header-right d-none d-xl-flex">
                <div class="dropdown lang-box">

                    @if (gs('multi_language'))
                        @php
                            $language = App\Models\Language::all();
                        @endphp

                        <button class="lang-box-btn" data-bs-toggle="dropdown">
                            @php
                                $selectedLang = $language->where('code', session('lang'))->first() ?? $language->first();
                            @endphp
                            <span class="thumb">
                                <img class="fit-image" src="{{ getImage(getFilePath('language') . '/' . $selectedLang->image) }}" alt="flag">
                            </span>
                            <span class="text">{{ __($selectedLang->name) }}</span>
                            <span class="icon">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($language as $item)
                                <li class="lang-box-item" data-code="en">
                                    <a href="{{ route('lang', $item->code) }}" class="lang-box-link">
                                        <div class="thumb">
                                            <img class="fit-image" src="{{ getImage(getFilePath('language') . '/' . $item->image) }}" alt="flag">
                                        </div>
                                        <span class="text">{{ strtoupper(__($item->name)) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <a href="{{ route('user.login') }}" class="btn btn--white"> @lang('Log In') </a>
                <a href="{{ route('user.register') }}" class="btn btn--base">
                    @lang('Register Now')
                </a>
            </div>
        </nav>
    </div>
</header>
