<ul class="nav nav-tabs mb-4 topTap breadcrumb-nav" role="tablist">
    <button class="breadcrumb-nav-close"><i class="las la-times"></i></button>
    <li class="nav-item {{ menuActive('admin.custom.form', param: 'user') }}" role="presentation">
        <a href="{{ route('admin.custom.form', 'user') }}" class="nav-link text-dark" type="button">
            <i class="las la-user"></i> @lang('User Information Form')
        </a>
    </li>
    <li class="nav-item {{ menuActive('admin.custom.form', param: 'nominee') }}" role="presentation">
        <a href="{{ route('admin.custom.form', 'nominee') }}" class="nav-link text-dark" type="button">
            <i class="las la-user-check"></i> @lang('Nominee Information Form')
        </a>
    </li>
    <li class="nav-item {{ menuActive('admin.custom.form', param: 'spouse') }}" role="presentation">
        <a href="{{ route('admin.custom.form', 'spouse') }}" class="nav-link text-dark" type="button">
            <i class="las la-female"></i> @lang('Spouse Information Form')
        </a>
    </li>

    <li class="nav-item {{ menuActive('admin.custom.form', param: 'children') }}" role="presentation">
        <a href="{{ route('admin.custom.form', 'children') }}" class="nav-link text-dark" type="button">
            <i class="las la-child"></i> @lang('Children Information Form')
        </a>
    </li>
    <li class="nav-item {{ menuActive('admin.custom.form', param: 'claim') }}" role="presentation">
        <a href="{{ route('admin.custom.form', 'claim') }}" class="nav-link text-dark" type="button">
            <i class="las la-money-check-alt"></i> @lang('Claim Information Form')
        </a>
    </li>
</ul>
