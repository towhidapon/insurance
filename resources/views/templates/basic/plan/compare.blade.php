@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="container">
        <h3 class="text-center">@lang('Compare Health Insurance Plans')</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>@lang('Plan Name')</th>
                        @foreach ($plans as $plan)
                            <th>{{ $plan->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>@lang('Premium')</strong></td>
                        @foreach ($plans as $plan)
                            <td>{{ showAmount($plan->price) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>@lang('Policy Duration')</strong></td>
                        @foreach ($plans as $plan)
                            <td>{{ $plan->validity }} @lang('Year')</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>@lang('Coverage Amount')</strong></td>
                        @foreach ($plans as $plan)
                            <td>{{ showAmount($plan->coverage_amount) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>@lang('Spouse Coverage')</strong></td>
                        @foreach ($plans as $plan)
                            <td>{{ $plan->spouse_coverage ? 'Yes' : 'No' }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>@lang('Children Coverage')</strong></td>
                        @foreach ($plans as $plan)
                            <td>{{ $plan->children_coverage ? 'Yes' : 'No' }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
