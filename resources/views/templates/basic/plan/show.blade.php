@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="plan-section py-60">
        <div class="plan-section__shape">
            <img src="assets/images/shapes/bs-1.png" alt="">
        </div>
        <div class="container">
            <div class="plan-section__btn">
                <a href="insurance.html" class="back-btn">
                    <span class="back-btn__icon">
                        <i class="las la-arrow-left"></i>
                    </span> Back
                </a>
            </div>
            <div class="plan-section__top">
                <div class="insurance-info">
                    <p class="insurance-info__title"> Insurance For </p>
                    <p class="insurance-info__text"> {{ $validatedData['member'] }} </p>
                </div>
                <div class="insurance-info">
                    <p class="insurance-info__title"> Insured Info </p>
                    <p class="insurance-info__text"> {{ $validatedData['your_age'] }} Yrs,
                        {{ $validatedData['spouse_age'] ?? 'N/A' }} Yrs,
                        {{ $validatedData['children_count'] == 1 ? '1 child' : $validatedData['children_count'] . ' children' }}
                    </p>
                </div>
                <div class="insurance-info">
                    <p class="insurance-info__title"> Health Coverage Range </p>
                    <p class="insurance-info__text">
                        @if ($validatedData['coverage_amount'] === 'all')
                            All Plans
                        @else
                            Up to {{ showAmount($validatedData['coverage_amount']) }}
                        @endif
                    </p>
                </div>
            </div>
            <div class="plan-container">
                <h3 class="plan-container__title"> Health Insurance Plans List </h3>
                <div class="plan-wrapper">
                    <div class="plan-wrapper__left">
                        @forelse($healthPlans as $plan)
                            <div class="plan-item">
                                <div class="plan-item__content">
                                    <p class="plan-item__title"> Health Coverage </p>
                                    <h6 class="plan-item__number"> {{ showAmount($plan->coverage_amount) }} </h6>
                                </div>
                                <div class="plan-item__content">
                                    <p class="plan-item__title"> Premium </p>
                                    <h6 class="plan-item__number"> {{ showAmount($plan->price) }} </h6>
                                    <p class="plan-item__desc"> Policy Duration: {{ $plan->validity }} Year </p>
                                </div>
                                <div class="plan-item__content">
                                    <button class="btn btn--white"> Buy Now </button>
                                    <div class="form-check form--check">
                                        <input class="form-check-input compare-checkbox" type="checkbox"
                                            data-id="{{ $plan->id }}">
                                        <label class="form-check-label"> Add to Compare </label>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center"> No plans found matching your criteria. </p>
                        @endforelse
                    </div>
                    <div class="mt-3">
                        <button id="compareBtn" class="btn btn-success compareBtn" disabled> Compare Plans </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('script')
        <script>
            "use strict";

            $(document).ready(function() {
                localStorage.removeItem("comparePlans");

                let selectedPlans = [];

                function updateButton() {
                    $('.compareBtn').prop('disabled', selectedPlans.length < 2);
                }

                $('.compare-checkbox').on('change', function() {
                    let planId = $(this).data('id');

                    if ($(this).is(':checked')) {
                        if (selectedPlans.length < 3) {
                            selectedPlans.push(planId);
                        } else {
                            alert("You can compare up to 3 plans.");
                            $(this).prop('checked', false);
                        }
                    } else {
                        selectedPlans = selectedPlans.filter(id => id !== planId);
                    }

                    updateButton();
                });

                $('.compareBtn').on('click', function() {
                    if (selectedPlans.length < 2) {
                        notify("error", "Please select at least two plans to compare!");
                        return;
                    }
                    window.location.href = "{{ route('compare.plan') }}?plans=" + selectedPlans.join(',');
                });

                updateButton();
            });
        </script>
    @endpush
@endsection
