@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Price')</th>
                                    <th>@lang('Coverage Amount')</th>
                                    <th>@lang('Validity')</th>
                                    <th>@lang('Spouse Coverage')</th>
                                    <th>@lang('Children Coverage')</th>
                                    <th>@lang('No. of Children')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plans as $plan)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ __($plan->name) }}</span>
                                            <br>
                                            <span class="small">
                                                {{ __($plan->category->name) }}
                                            </span>
                                        </td>
                                        <td>{{ showAmount($plan->price, currencyFormat: true) }} /
                                            {{ __($plan->payment_duration) }}<span>@lang(' Days')</span></td>
                                        <td class="fw-bold">{{ showAmount($plan->coverage_amount, currencyFormat: true) }}
                                        </td>
                                        <td class="fw-bold">{{ __($plan->validity) }}<span>@lang(' Months')</span></td>
                                        <td>
                                            @if ($plan->spouse_coverage)
                                                <span class="badge badge--success">@lang('Yes')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('No')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($plan->children_coverage)
                                                <span class="badge badge--success">@lang('Yes')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('No')</span>
                                            @endif
                                        </td>
                                        <td class="fw-bold">{{ $plan->no_children }}</td>
                                        <td>
                                            @php echo $plan->statusBadge; @endphp
                                        </td>

                                        <td class="button--group">
                                            <button type="button" class="btn btn-outline--primary btn-sm edit-plan-btn" data-plan='@json($plan)'>
                                                <i class="las la-pen"></i>@lang('Edit')
                                            </button>

                                            @if ($plan->status == Status::DISABLE)
                                                <button type="button" class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.plan.status', $plan->id) }}" data-question="@lang('Are you sure to enable this plan?')">
                                                    <i class="la la-eye"></i> @lang('Enable')
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.plan.status', $plan->id) }}" data-question="@lang('Are you sure to disable this category?')">
                                                    <i class="la la-eye-slash"></i> @lang('Disable')
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($plans->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($plans) @endphp
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-confirmation-modal />

    <div class="modal fade plan-modal" tabindex="-1" id="plan-modal" data-bs-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Plan')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form class="plan-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label>@lang('Name')</label>
                                <input type="text" class="form-control" name="name" required />
                            </div>
                            <div class="form-group">
                                <label>@lang('Category')</label>
                                <select name="category_id" class="form-control plan-category" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Price')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="price" step="0.01" required />
                                    <span class="input-group-text">@lang('USD')</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Payment Duration')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="payment_duration" required />
                                    <span class="input-group-text">@lang('Days')</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Coverage Amount')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="coverage_amount" step="0.01" required />
                                    <span class="input-group-text">@lang('USD')</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Validity')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="validity" required />
                                    <span class="input-group-text">@lang('Months')</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                        <div class="col-lg-10">
                                            <label>@lang('Spouse Coverage')</label>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="35" data-on="@lang('Enable')"
                                                data-off="@lang('Disable')" class="spouseCoverage" name="spouse_coverage" value="1">
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                        <div class="col-lg-10">
                                            <label>@lang('Children Coverage')</label>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="35"
                                                data-on="@lang('Enable')" data-off="@lang('Disable')" class="childrenCoverage" name="children_coverage" value="1">
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center children-number-field">
                                        <div class="col-lg-10">
                                            <label>@lang('No. of Children')</label>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="number" class="form-control noChildren" name="no_children" min="0" id="noChildren" disabled>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button type="button" class="btn btn-outline--primary add-plan-btn btn-sm">
        <i class="las la-plus"></i> @lang('Add')
    </button>
@endpush

@push('style')
    <style>
        .toggle.btn-lg {
            height: 37px !important;
            min-height: 37px !important;
        }

        .toggle-handle {
            width: 25px !important;
            padding: 0;
        }

        .list-group-item:hover {
            background-color: #F7F7F7;
        }

        .toggle-group label.btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 !important;
        }
    </style>
@endpush


@push('style-lib')
    <link href="{{ asset('assets/admin/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
@endpush


@push('script-lib')
    <script src="{{ asset('assets/admin/js/fontawesome-iconpicker.js') }}"></script>
@endpush



@push('script')
    <script>
        (function($) {
            "use strict";
            const planModal = $("#plan-modal");
            const planForm = $('.plan-form');

            $('.add-plan-btn').on('click', function() {
                planModal.find('.modal-title').text('@lang('Add Plan')');
                planForm.attr('action', '{{ route('admin.plan.save') }}');
                planForm.trigger('reset');
                planModal.find('.spouseCoverage').bootstrapToggle('off');
                planModal.find('.childrenCoverage').bootstrapToggle('off');
                planModal.find('.noChildren').prop('disabled', true).val(0);
                planModal.find('.plan-category').val('');
                planModal.modal('show');
            });

            $('.edit-plan-btn').on('click', function() {
                const plan = $(this).data('plan');
                planModal.find('.modal-title').text('Edit Plan');
                planForm.attr('action', "{{ route('admin.plan.save', '') }}/" + plan.id);
                planModal.find('input[name=name]').val(plan.name);
                planModal.find('.plan-category').val(plan.category_id);
                planModal.find('input[name=price]').val(parseFloat(plan.price).toFixed(2));
                planModal.find('input[name=payment_duration]').val(plan.payment_duration);
                planModal.find('input[name=coverage_amount]').val(parseFloat(plan.coverage_amount).toFixed(2));
                planModal.find('input[name=validity]').val(plan.validity);
                planModal.find('.spouseCoverage').bootstrapToggle(plan.spouse_coverage == 1 ? 'on' : 'off');
                planModal.find('.childrenCoverage').bootstrapToggle(plan.children_coverage == 1 ? 'on' : 'off');
                planModal.find('.noChildren').val(plan.no_children).prop('disabled', plan.children_coverage != 1);
                planModal.modal('show');
            });

            $('.childrenCoverage').on('change', function() {
                const noChildren = $('.noChildren');
                if ($(this).is(':checked')) {
                    noChildren.prop('disabled', false);
                } else {
                    noChildren.prop('disabled', true).val(0);
                }
            });
        })(jQuery);
    </script>
@endpush
