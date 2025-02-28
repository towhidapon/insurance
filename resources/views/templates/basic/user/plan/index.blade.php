@php

    $coverageAmountOptions = [];
    $incrementAmount = 200000;

    for ($i = $incrementAmount; $i <= $coverageAmount; $i += $incrementAmount) {
        $coverageAmountOptions[$i] = $i;
    }

@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="row col-lg-4">
        <h5 class="card-title">@lang('Health Plan')</h5>
        <div class="user">
            <div class="thumb"><img src="" class="plugin_bg">
            </div>
            <span class="name"></span>
        </div>
        <form method="POST" action="">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="full_name" class="form-label fw-bold">@lang('Your Full Name')</label>
                        <input type="text" class="form-control form-control-lg" id="full_name" name="full_name" placeholder="@lang('Enter your name')" required>
                        <div class="invalid-feedback">@lang('Please enter your full name.')</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone_number" class="form-label fw-bold">@lang('Phone Number')</label>
                        <div class="input-group">
                            <select class="form-select form-select-sm" id="phone_country" name="phone_country" style="max-width: 100px;" required>
                                <option value="US">US +1</option>
                                <option value="IN">IN +91</option>
                                <option value="UK">UK +44</option>
                            </select>
                            <input type="tel" class="form-control form-control-lg" id="phone_number" name="phone_number" placeholder="(555) 000-0000" required>
                        </div>
                        <div class="invalid-feedback">@lang('Please enter a valid phone number.')</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="member_name" class="form-label fw-bold">@lang('Members')</label>
                        <select class="form-select form-select-lg" id="member" name="member" required>
                            <option value="">@lang('Select member')</option>
                        </select>
                        <div class="invalid-feedback">@lang('Please select member')</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="your_age" class="form-label fw-bold">@lang('Your Age')</label>
                        <select class="form-select form-select-lg" id="your_age" name="your_age" required>
                            <option value="">@lang('Select your age')</option>
                        </select>
                        <div class="invalid-feedback">@lang('Please select your age.')</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="spouse_age" class="form-label fw-bold">@lang('Spouse Age')</label>
                        <select class="form-select form-select-lg" id="spouse_age" name="spouse_age">
                            <option value="">@lang('Select spouse age')</option>
                        </select>
                        <div class="invalid-feedback">@lang('Please select spouse age.')</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label fw-bold">@lang('Number of Child (Below 18 years)')</label>
                        <div class="d-flex gap-3">
                            @for ($i = 1; $i <= $maxChildren; $i++)
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="children_{{ $i }}" name="children_count" value="{{ $i }}" required>
                                    <label class="form-check-label" for="children_{{ $i }}">@lang(':count Child', ['count' => $i])</label>
                                </div>
                            @endfor
                        </div>
                        <div class="invalid-feedback">@lang('Please select the number of children.')</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label fw-bold">@lang('Health Coverage Amount')</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="coverage_all" name="coverage_amount" value="all" checked required>
                                <label class="form-check-label" for="coverage_all">@lang('All Plans')</label>
                            </div>
                            @foreach ($coverageAmountOptions as $coverageAmount)
                                <input type="radio" class="form-check-input" id="coverage_{{ $coverageAmount }}" name="coverage_amount" value="{{ $coverageAmount }}" checked required>
                                <label class="form-check-label" for="coverage_{{ $coverageAmount }}">@lang('Up to :coverage', ['coverage' => number_format($coverageAmount)])</label>
                            @endforeach
                        </div>
                        <div class="invalid-feedback">@lang('Please select a coverage amount.')</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">@lang('I agree with the Terms of Service')</label>
                        <div class="invalid-feedback">@lang('You must agree to the terms of service.')</div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">@lang('See Plans')</button>
                </div>
            </div>
        </form>
    </div>
@endsection
