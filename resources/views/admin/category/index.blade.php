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
                                    <th>@lang('Category')</th>
                                    <th>@lang('Icon Image')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Feature')</th>
                                    <th>@lang('Popular')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb"><img src="{{ getImage(getFilePath('categoryImage') . '/' . $category->image, getFileSize('categoryImage')) }}" class="plugin_bg">
                                                </div>
                                                <span class="name">{{ __($category->name) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="thumb"><img src="{{ getImage(getFilePath('categoryIconImage') . '/' . $category->icon, getFileSize('categoryIconImage')) }}" id="icon">
                                            </div>
                                        </td>

                                        <td>
                                            @php echo $category->statusBadge; @endphp
                                        </td>
                                        <td>
                                            <input type="checkbox" class="toggle-feature" data-id="{{ $category->id }}" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger"
                                                data-bs-toggle="toggle" data-height="35" data-on="@lang('Enable')" data-off="@lang('Disable')" {{ $category->is_featured ? 'checked' : '' }}>
                                        </td>

                                        <td>
                                            <input type="checkbox" class="toggle-popular" data-id="{{ $category->id }}" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger"
                                                data-bs-toggle="toggle" data-height="35" data-on="@lang('Enable')" data-off="@lang('Disable')" {{ $category->is_popular ? 'checked' : '' }}>
                                        </td>
                                        <td class="button--group">
                                            <button type="button" class="btn btn-outline--primary btn-sm editCategoryBtn" data-category='@json($category)'
                                                data-image="{{ getImage(getFilePath('categoryImage') . '/' . $category->image, getFileSize('categoryImage')) }}"
                                                data-icon="{{ getImage(getFilePath('categoryIconImage') . '/' . $category->icon, getFileSize('categoryIconImage')) }}">
                                                <i class="las la-pen"></i>@lang('Edit')
                                            </button>

                                            @if ($category->status == Status::DISABLE)
                                                <button type="button" class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.category.status', $category->id) }}"
                                                    data-question="@lang('Are you sure to enable this category?')">
                                                    <i class="la la-eye"></i> @lang('Enable')
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.category.status', $category->id) }}"
                                                    data-question="@lang('Are you sure to disable this category?')">
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
            </div>
        </div>
    </div>
    <x-confirmation-modal />

    <div class="modal fade category-modal" tabindex="-1" id="category-modal" data-bs-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Category')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form class="category-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="d-flex justify-content-center gap-4">
                                    <div>
                                        <label>@lang('Catgeory Image')</label>
                                        <x-image-uploader class="category-image-uploader w-100" type="categoryImage" :required=false :image="''" />
                                    </div>
                                    <div>
                                        <label>@lang('Icon Image')</label>
                                        <x-image-uploader id="icon-image" class="category-icon-image-uploader w-100" type="categoryIconImage" :required=false name="icon" :image="''" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control category-name" name="name" required />
                                </div>

                                <div class="form-group mt-3">
                                    <label>@lang('Benefit')</label>
                                    <button type="button" class="btn btn--primary addBenefitBtn mb-2 btn-sm float-end">
                                        @lang('Add Benefit')
                                    </button>
                                    <div class="benefit-container">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="benefit[]" required />
                                        </div>
                                    </div>
                                </div>
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
    <button type="button" class="btn btn-outline--primary addCategoryBtn btn-sm">
        <i class="las la-plus"></i> @lang('Add New')
    </button>
@endpush
@push('style-lib')
    <link href="{{ asset('assets/admin/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/fontawesome-iconpicker.js') }}"></script>
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


@push('script')
    <script>
        (function($) {
            "use strict";

            const maxBenefits = 5;
            const modal = $("#category-modal");

            function updateButtonState() {
                const benefitCount = $('.benefit-container .input-group').length;
                $('.addBenefitBtn').prop('disabled', benefitCount >= maxBenefits);
                $('.removeBenefitBtn').prop('disabled', benefitCount <= 1);
            }

            $('.addBenefitBtn').on('click', function() {
                if ($('.benefit-container .input-group').length < maxBenefits) {
                    $('.benefit-container').append(`
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="benefit[]" required />
                            <button type="button" class="btn btn-danger removeBenefitBtn">@lang('Remove')</button>
                        </div>
                    `);
                    updateButtonState();
                }
            });

            $(document).on('click', '.removeBenefitBtn', function() {
                if ($('.benefit-container .input-group').length > 1) {
                    $(this).closest('.input-group').remove();
                    updateButtonState();
                }
            });

            $('.addCategoryBtn').on('click', function() {
                modal.find('.modal-title').text("@lang('Add Category')");
                modal.find('form').attr('action', "{{ route('admin.category.save') }}");
                modal.find('form').trigger('reset');
                $('.benefit-container').html(`
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="benefit[]" required />
                            <button type="button" class="btn btn-danger removeBenefitBtn">@lang('Remove')</button>
                        </div>
                    `);
                $('.image-upload-preview').css('background-image', 'none');

                updateButtonState();
                modal.modal('show');
            });

            $('.editCategoryBtn').on('click', function() {
                const category = $(this).data('category');
                modal.find('.modal-title').text("@lang('Edit Category')");
                modal.find('form').attr('action', "{{ route('admin.category.save', '') }}/" + category.id);
                modal.find('input[name=name]').val(category.name);
                const container = $('.benefit-container');
                container.empty();
                if (category.benefit.length > 0) {
                    category.benefit.forEach(benefit => {
                        container.append(`
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="benefit[]" value="${benefit}" required />
                                <button type="button" class="btn btn-danger removeBenefitBtn">@lang('Remove')</button>
                            </div>
                        `);
                    });
                } else {
                    container.html(`
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="benefit[]" required />
                            <button type="button" class="btn btn-danger removeBenefitBtn">@lang('Remove')</button>
                        </div>
                    `);
                }
                $('.category-image-uploader .image-upload-preview').css('background-image', `url(${$(this).data('image')})`);
                $('.category-icon-image-uploader .image-upload-preview').css('background-image', `url(${$(this).data('icon')})`);
                updateButtonState();
                modal.modal('show');
            });

            $('.toggle-feature').on('change', function() {
                let categoryId = $(this).data('id');
                let status = $(this).prop('checked') ? 1 : 0;
                let formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('id', categoryId);
                formData.append('is_featured', status);

                $.ajax({
                    url: "{{ route('admin.category.toggleFeature') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        notify('success', response.message);
                    },
                    error: function() {
                        notify('error', '@lang('Something went wrong!')');
                    }
                });
            });

            $('.toggle-popular').on('change', function() {
                let categoryId = $(this).data('id');
                let status = $(this).prop('checked') ? 1 : 0;
                let formData = new FormData();

                formData.append('_token', "{{ csrf_token() }}");
                formData.append('id', categoryId);
                formData.append('is_popular', status);

                $.ajax({
                    url: "{{ route('admin.category.togglePopular') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        notify('success', response.message);
                    },
                    error: function() {
                        notify('error', '@lang('Something went wrong!')');
                    }
                });
            });


        })(jQuery);
    </script>
@endpush


@push('style')
    <style>
        .category-image {
            max-width: 100px;
        }
    </style>
@endpush
