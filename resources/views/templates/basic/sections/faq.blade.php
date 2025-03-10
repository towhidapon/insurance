@php
    @$faqContent = getContent('faq.content', true);
    @$faqElements = getContent('faq.element', false, orderById: true);
    $faqCount = $faqElements->count();
    $half = ceil($faqCount / 2);
    $leftFaqElements = $faqElements->slice(0, $half);
    $rightFaqElements = $faqElements->slice($half);
@endphp

<div class="faq-section py-60">
    <span class="right-bg"></span>
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title">
                {{ __(@$faqContent->data_values->heading) }}
            </h2>
            <p class="section-heading__desc">
                {{ __(@$faqContent->data_values->subheading) }}
            </p>
        </div>
        <div class="accordion custom--accordion" id="accordionExample">
            <div class="row gy-4">
                <div class="col-lg-6">
                    @foreach ($leftFaqElements as $index => $faqElement)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                    {{ __($faqElement->data_values->question) }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="text">
                                        {{ __($faqElement->data_values->answer) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-lg-6">
                    @foreach ($rightFaqElements as $index => $faqElement)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index + $half }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index + $half }}" aria-expanded="false"
                                    aria-controls="collapse{{ $index + $half }}">
                                    {{ __($faqElement->data_values->question) }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index + $half }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index + $half }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="text">
                                        {{ __($faqElement->data_values->answer) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="faq-section__bottom">
            <h4 class="title"> {{ __(@$faqContent->data_values->button_heading) }} </h4>
            <p class="desc"> {{ __(@$faqContent->data_values->button_subheading) }} </p>
            <div class="faq-section__btn">
                <a href="{{ @$faqContent->data_values->button_url }}" class="btn btn--base"> {{ __(@$faqContent->data_values->button_text) }} </a>
            </div>
        </div>
    </div>
</div>
