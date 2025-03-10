@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Mobile')</th>
                                    <th>@lang('Topic')</th>
                                    <th>@lang('Requested At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quotes as $quote)
                                    <tr>
                                        <td>{{ $quote->mobile_code }}-{{ $quote->mobile }}</td>
                                        <td>{{ $quote->quoteTopic->topic ?? 'N/A' }}</td>
                                        <td>{{ showDateTime($quote->created_at) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline--danger confirmationBtn" data-question="@lang('Are you sure to remove this quote?')" data-action="{{ route('admin.quote.remove', $quote->id) }}">
                                                <i class="las la-trash"></i> @lang('Remove')
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($quotes->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($quotes) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>


    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.quote.topic') }}" class="btn btn-sm btn-outline--primary"><i class="las la-angle-double-right"></i>@lang('Quote Topics')</a>
@endpush
