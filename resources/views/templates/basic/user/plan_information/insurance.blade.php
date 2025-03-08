@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0" style="background: #f0f2f5; border-radius: 12px;">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-4" style="color: #2c3e50;">@lang('Secure Your Future with the Right Insurance Plan')</h5>
                        <p class="text-muted mb-4">Customize your coverage and get insured in just a few easy steps!</p>
                        <div class="progress mb-4" style="height: 8px; background: #e9ecef;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 16.67%;" aria-valuenow="16.67" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3" style="color: #7f8c8d;">
                            <span>1. @lang('Insurance Information')</span>
                            <span>2. @lang('Your Information')</span>
                            <span>3. @lang('Spouse Information')</span>
                            <span>4. @lang('Nominee Information')</span>
                            <span>5. @lang('Declaration')</span>
                            <span>6. @lang('Payment')</span>
                        </div>
                        <form method="POST" action="{{ route('user.store.insurance.info') }}" id="insuranceForm">
                            @csrf
                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-bold">@lang('Select Your Insurance')</label>
                                <select class="form-select form-select-lg" id="category_id" name="category_id" required style="border-radius: 8px; border-color: #ced4da;">
                                    <option value="">@lang('Select Insurance Type')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="member_type" class="form-label fw-bold">@lang('Select Members')</label>
                                <select class="form-select form-select-lg" id="member_type" name="member_type" required style="border-radius: 8px; border-color: #ced4da;">
                                    <option value="Single">@lang('Single')</option>
                                    <option value="Couple">@lang('Couple')</option>
                                    <option value="Family">@lang('Family')</option>
                                </select>
                                @error('member_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="coverage_amount" class="form-label fw-bold">@lang('Coverage Amount')</label>
                                <select class="form-select form-select-lg" id="coverage_amount" name="coverage_amount" required style="border-radius: 8px; border-color: #ced4da;">
                                    <option value="all">@lang('All Plans')</option>
                                </select>
                                @error('coverage_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-light" onclick="window.location.href='{{ route('user.home') }}'">@lang('Back')</button>
                                <button type="submit" class="btn btn-primary" style="background: #2c5282; border-color: #2c5282; border-radius: 8px;">@lang('Next Step →')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            const plans = @json($plans);
            const $coverageSelect = $('#coverage_amount');

            $('#category_id').on('change', function() {
                let categoryId = $(this).val();
                $coverageSelect.empty().append('<option value="all">@lang('All Plans')</option>');

                if (categoryId) {
                    let categoryPlans = plans.filter(plan => plan.category_id == categoryId);
                    let uniqueCoverages = [...new Set(categoryPlans.map(plan => plan.coverage_amount))].sort((a, b) => a - b);

                    uniqueCoverages.forEach(coverage => {
                        $coverageSelect.append(`<option value="${coverage}">@lang('Up to') ${coverage}</option>`);
                    });
                }
            }).trigger('change');
        })(jQuery);
    </script>
@endpush



@push('style')
    <style>
        .form-control-lg,
        .form-select-lg {
            border-radius: 8px;
            border-color: #ced4da;
        }

        .btn-primary:hover {
            background-color: #2b4b7a;
            border-color: #2b4b7a;
        }

        .card {
            background: #f0f2f5;
            border-radius: 12px;
        }

        .text-danger {
            color: #dc3545;
            font-size: 0.875rem;
        }
    </style>
@endpush
