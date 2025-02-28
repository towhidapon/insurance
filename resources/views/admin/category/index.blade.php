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
                                    <th>@lang('Icon')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb"><img
                                                        src="{{ getImage(getFilePath('categoryImage') . '/' . $category->image, getFileSize('categoryImage')) }}"
                                                        class="plugin_bg">
                                                </div>
                                                <span class="name">{{ __($category->name) }}</span>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="thumb"><img
                                                    src="{{ getImage(getFilePath('categoryIconImage') . '/' . $category->icon, getFileSize('categoryIconImage')) }}"
                                                    id="icon">
                                            </div>
                                        </td>
                                        <td>
                                            @php echo $category->statusBadge; @endphp
                                        </td>

                                        <td class="button--group">
                                            <button type="button" class="btn btn-outline--primary btn-sm edit-category-btn"
                                                data-category='@json($category)'
                                                data-image="{{ getImage(getFilePath('categoryImage') . '/' . $category->image, getFileSize('categoryImage')) }}"
                                                data-icon="{{ getImage(getFilePath('categoryIconImage') . '/' . $category->icon, getFileSize('categoryIconImage')) }}">
                                                <i class="las la-pen"></i>@lang('Edit')
                                            </button>

                                            @if ($category->status == Status::DISABLE)
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--success confirmationBtn"
                                                    data-action="{{ route('admin.category.status', $category->id) }}"
                                                    data-question="@lang('Are you sure to enable this category?')">
                                                    <i class="la la-eye"></i> @lang('Enable')
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--danger confirmationBtn"
                                                    data-action="{{ route('admin.category.status', $category->id) }}"
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

    <div class="modal fade category-modal" tabindex="-1" id="category-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Category')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="category-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>@lang('Category image')</label>
                                <x-image-uploader class="category-image-uploader w-100" type="categoryImage" :required=false
                                    :image="''" />
                            </div>
                            <div class="col-md-6">
                                <label>@lang('Icon image')</label>
                                <x-image-uploader id="icon-image" class="category-icon-image-uploader w-100"
                                    type="categoryIconImage" :required=false name="icon" :image="''" />
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control category-name" name="name" required />
                                </div>

                                <div class="form-group col-md-12">
                                    <label>@lang('Benefit')</label>
                                    <div>
                                        <button type="button" class="btn btn--primary add-benefit-btn mb-2 float-end">
                                            @lang('Add Benefit')
                                        </button>
                                    </div>

                                    <div class="benefit-container">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="benefit[]" required />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button type="button" class="btn btn-outline--primary add-category-btn">
        <i class="las la-plus"></i> @lang('Add Category')
    </button>
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

            const maxBenefit = 5;
            const minBenefit = 1;
            const $categoryModal = $("#category-modal");

            // Add Benefit Button Click
            $('.add-benefit-btn').on('click', function() {
                const container = $('.benefit-container');
                if (container.children().length < maxBenefit) {
                    container.append(`
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="benefit[]" required />
                    <button type="button" class="btn btn-danger remove-benefit-btn">@lang('Remove')</button>
                </div>`);
                }
                if (container.children().length >= maxBenefit) {
                    $(this).prop('disabled', true);
                }
            });

            // Remove Benefit Button Click
            $(document).on('click', '.remove-benefit-btn', function() {
                const container = $('.benefit-container');
                if (container.children().length <= minBenefit) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).closest('.input-group').remove();
                    $('.add-benefit-btn').prop('disabled', false);
                }
            });

            // Open Add Category Modal
            $('.add-category-btn').on('click', function() {
                $categoryModal.find("form").trigger('reset').attr('action',
                    "{{ route('admin.category.save') }}");
                $('.category-image-uploader .image-upload-preview, .category-icon-image-uploader .image-upload-preview')
                    .css('background-image', 'none');
                $('.benefit-container').html(`
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="benefit[]" required />
                <button type="button" class="btn btn-danger remove-benefit-btn">@lang('Remove')</button>
            </div>`);
                $categoryModal.modal('show');
            });

            // Open Edit Category Modal
            $('.edit-category-btn').on('click', function() {
                const category = $(this).data('category');
                const image = $(this).data('image');
                const icon = $(this).data('icon');

                $categoryModal.find(".modal-title").text("@lang('Edit Category')");
                $categoryModal.find("form").attr('action', "{{ route('admin.category.save', '') }}/" + category
                    .id);
                $categoryModal.find("input[name=name]").val(category.name);
                $('.category-image-uploader .image-upload-preview').css('background-image', `url(${image})`);
                $('.category-icon-image-uploader .image-upload-preview').css('background-image',
                    `url(${icon})`);

                const container = $categoryModal.find('.benefit-container');
                container.empty();

                if (category.benefit.length > 0) {
                    category.benefit.forEach((benefit) => {
                        container.append(`
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="benefit[]" value="${benefit}" required />
                        <button type="button" class="btn btn-danger remove-benefit-btn">@lang('Remove')</button>
                    </div>`);
                    });
                } else {
                    container.html(`
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="benefit[]" required />
                    <button type="button" class="btn btn-danger remove-benefit-btn">@lang('Remove')</button>
                </div>`);
                }

                $('.add-benefit-btn').prop('disabled', container.children().length >= maxBenefit);
                $categoryModal.modal('show');
            });

        })(jQuery);
    </script>
@endpush


{{-- @push('script')
    <script>
        (function($) {
            "use strict";

            const maxBenefit = 5;
            const minBenefit = 1;
            const $categoryModal = $("#category-modal");

            $('.add-benefit-btn').on('click', function() {
                const container = $('.benefit-container');
                const currentCount = container.children().length;

                if (container.children().length >= maxBenefit) {
                    $(this).prop('disabled', true);
                } else {
                    const newField = `
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="benefit[]" required />
                            <button type="button" class="btn btn-danger remove-benefit-btn">@lang('Remove')</button>
                        </div>`;
                    container.append(newField);
                }
            });

            $(document).on('click', '.remove-benefit-btn', function() {
                const container = $('.benefit-container');
                if (container.children().length <= minBenefit) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).closest('.input-group').remove();
                    $('.add-benefit-btn').prop('disabled', false);
                }
            });

            $('.add-category-btn').on('click', function() {
                $categoryModal.find(`form`).trigger('reset');
                $categoryModal.find(`form`).attr('action', "{{ route('admin.category.save') }}");
                $categoryModal.find('.image-upload-preview').css('background-image',
                    `url({{ getImage(null, getFileSize('categoryImage')) }})`);
                const container = $categoryModal.find('.benefit-container');
                container.empty();
                container.html(`
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="benefit[]" required />
                            <button type="button" class="btn btn-danger remove-benefit-btn">@lang('Remove')</button>
                        </div>
                    `);
                $categoryModal.modal('show');
            });

            $('.edit-category-btn').on('click', function() {
                const category = $(this).data('category');
                const icon = $(this).data('icon');
                const image = $(this).data('image');

                $categoryModal.find(".modal-title").text("@lang('Edit Category')");
                $categoryModal.find('form').attr('action', "{{ route('admin.category.save', '') }}/" + category
                    .id);
                $categoryModal.find(`input[name=name]`).val(category.name);
                $categoryModal.find(`input[name=icon]`).val(category.icon);
                $categoryModal.find('.image-upload-preview').css('background-image', `url(${image})`);

                const container = $categoryModal.find('.benefit-container');
                container.empty();

                if (category.benefit.length > 0) {
                    category.benefit.forEach((benefit) => {
                        const newField = `
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="benefit[]" value="${benefit}" required />
                                <button type="button" class="btn btn-danger remove-benefit-btn">@lang('Remove')</button>
                            </div>`;
                        container.append(newField);
                    });
                } else {
                    container.html(`
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="benefit[]" required />
                            <button type="button" class="btn btn-danger remove-benefit-btn">@lang('Remove')</button>
                        </div>
                    `);
                }
                if (container.children().length >= maxBenefit) {
                    $('.add-benefit-btn').prop('disabled', true);
                } else {
                    $('.add-benefit-btn').prop('disabled', false);
                }
                $categoryModal.modal('show');
            });




            $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                $(this).closest('.form-group').find('.iconpicker-input').val(
                    `<i class="${e.iconpickerValue}"></i>`);
            });
        })(jQuery);
    </script>
@endpush --}}

@push('style')
    <style>
        .category-image {
            max-width: 100px;
        }
    </style>
@endpush
