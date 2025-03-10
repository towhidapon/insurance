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
                                    <th>@lang('Topic')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topics as $topic)
                                    <tr>
                                        <td>{{ $topic->topic }}</td>
                                        <td>
                                            @php echo $topic->statusBadge; @endphp
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline--primary editTopicBtn" data-id="{{ $topic->id }}" data-topic="{{ $topic->topic }}">
                                                <i class="las la-edit"></i> @lang('Edit')
                                            </button>
                                            @if ($topic->status == Status::DISABLE)
                                                <button type="button" class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.quote.topic.status', $topic->id) }}"
                                                    data-question="@lang('Are you sure to enable this topic?')">
                                                    <i class="la la-eye"></i> @lang('Enable')
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.quote.topic.status', $topic->id) }}"
                                                    data-question="@lang('Are you sure to disable this topic?')">
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
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($topics->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($topics) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <button type="button" class="btn btn-outline--primary addTopicBtn btn-sm">
        <i class="las la-plus"></i> @lang('Add New')
    </button>
@endpush

<div class="modal fade topic-modal" tabindex="-1" id="topicModal" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add Topic')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form id="topicForm" method="POST">
                @csrf
                <input type="hidden" name="id" id="topicId">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>@lang('Topic')</label>
                                <input type="text" name="topic" id="topicName" class="form-control topic-name" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary w-100 h-45">@lang('Save Topic')</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('script')
    <script>
        (function($) {
            "use strict";

            $('.addTopicBtn').on('click', function() {
                $('#topicModalLabel').text("@lang('Add New Topic')");
                $('#topicForm').attr('action', "{{ route('admin.quote.save.topic') }}");
                $('#topicId').val('');
                $('#topicName').val('');
                $('#topicModal').modal('show');
            });

            $('.editTopicBtn').on('click', function() {
                let id = $(this).data('id');
                let topic = $(this).data('topic');

                $('#topicModalLabel').text("@lang('Edit Topic')");
                $('#topicForm').attr('action', "{{ route('admin.quote.update.topic') }}");
                $('#topicId').val(id);
                $('#topicName').val(topic);
                $('#topicModal').modal('show');
            });
        })(jQuery);
    </script>
@endpush
