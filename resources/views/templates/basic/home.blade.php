@extends($activeTemplate . 'layouts.frontend')
@section('content')

    <main>
        @include($activeTemplate . 'sections.banner')
    </main>

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif

@endsection
