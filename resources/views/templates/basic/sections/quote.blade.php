@php
    @$quoteContent = getContent('quote.content', true);
    $quoteTopics = App\Models\QuoteTopic::active()->with('quote')->orderBy('id', 'desc')->get();

@endphp

<div class="area-section py-60 bg-img" data-background-image="{{ frontendImage('quote', @$quoteContent->data_values->quote_bg, '1905x450') }}" alt="image">
    <div class="left-bg"></div>
    <div class="right-bg"></div>
    <div class="container">
        <div class="section-heading style-left">
            <h2 class="section-heading__title"> {{ __(@$quoteContent->data_values->heading) }} </h2>
            <p class="section-heading__desc"> {{ __(@$quoteContent->data_values->subheading) }} </p>
        </div>
        <form action="{{ route('quote.update') }}" method="POST" class="area-form">
            @csrf
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
                    <select class="form-select form--control select2" name="topic_id" required>
                        <@foreach ($quoteTopics as $quoteTopic)
                            <option value="{{ $quoteTopic->id }}">{{ $quoteTopic->topic }}</option>
                            @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-4">
                    <button type="submit" class="btn--white btn w-100"> @lang('Submit') </button>
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
