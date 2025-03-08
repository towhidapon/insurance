@php
    @$quoteContent = getContent('quote.content', true);
@endphp


<div class="area-section py-60 bg-img" data-background-image="{{ frontendImage('quote', @$quoteContent->data_values->quote_shape) }}" alt="">
    <div class="left-bg"></div>
    <div class="right-bg"></div>
    <div class="container">
        <div class="section-heading style-left">
            <h2 class="section-heading__title"> {{ @$quoteContent->data_values->heading }} </h2>
            <p class="section-heading__desc"> {{ @$quoteContent->data_values->subheading }} </p>
        </div>
        <form action="#" class="area-form">
            <div class="row gy-4 align-items-end">
                <div class="col-lg-5 col-md-4">
                    <label class="form--label"> @lang('Phone Number') </label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <select class="form-select form--control country-code">
                                @foreach ($countries as $key => $country)
                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $key }}">
                                        +{{ $country->dial_code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="mobile_code">
                        <input type="hidden" name="country_code">
                        <input type="text" class="form-control form--control phone-number" name="mobile" required>
                    </div>
                </div>


                <div class="col-lg-5 col-md-4">
                    <label class="form--label"> @lang('Select Your Topic') </label>
                    <select class="form-select form--control select2">
                        <option selected> Select team member </option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <button type="button" class="btn--white btn w-100"> @lang('Submit') </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/select2.min.js') }}"></script>
@endpush




@push('script')
    <script>
        "use strict";
        (function($) {
            $('.country-code').on('change', function() {
                let selectedOption = $(this).find(':selected');
                $('input[name=mobile_code]').val(selectedOption.data('mobile_code'));
                $('input[name=country_code]').val(selectedOption.val());
            });

            let defaultOption = $('.country-code :selected');
            $('input[name=mobile_code]').val(defaultOption.data('mobile_code'));
            $('input[name=country_code]').val(defaultOption.val());
        })(jQuery);
    </script>
@endpush
