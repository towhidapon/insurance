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
                                    <th>@lang('Image')</th>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Subtitle')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($features as $feature)
                                    <tr>
                                        <td><img src="{{ getImage(getFilePath('featureImage') . '/' . $feature->image, getFileSize('featureImage')) }}" width="50" alt="@lang('Feature Image')"></td>
                                        <td>{{ __($feature->title) }}</td>
                                        <td>{{ __($feature->subtitle) }}</td>
                                        <td class="button--group">
                                            <button type="button" class="btn btn-outline--primary btn-sm edit-feature-btn" data-feature='@json($feature)'>
                                                <i class="las la-pen"></i>@lang('Edit')
                                            </button>
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
                @if ($features->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($features) @endphp
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-confirmation-modal />

    <div class="modal fade feature-modal" tabindex="-1" id="feature-modal" data-bs-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Feature')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form class="feature-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label>@lang('Title')</label>
                                <input type="text" class="form-control" name="title" required />
                            </div>
                            <div class="form-group">
                                <label>@lang('Subtitle')</label>
                                <input type="text" class="form-control" name="subtitle" required />
                            </div>
                            <div class="form-group">
                                <label>@lang('Image')</label>
                                <input type="file" class="form-control" name="image" required />
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
    <button type="button" class="btn btn-outline--primary add-feature-btn btn-sm">
        <i class="las la-plus"></i> @lang('Add New')
    </button>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            const featureModal = $("#feature-modal");
            const featureForm = $('.feature-form');

            $('.add-feature-btn').on('click', function() {
                featureModal.find('.modal-title').text('@lang('Add Feature')');
                featureForm.attr('action', '{{ route('admin.feature.save') }}');
                featureForm.trigger('reset');
                featureModal.modal('show');
            });

            $('.edit-feature-btn').on('click', function() {
                const feature = $(this).data('feature');
                featureModal.find('.modal-title').text('Edit Feature');
                featureForm.attr('action', "{{ route('admin.feature.save', '') }}/" + feature.id);
                featureModal.find('input[name=title]').val(feature.title);
                featureModal.find('input[name=subtitle]').val(feature.subtitle);
                featureModal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
