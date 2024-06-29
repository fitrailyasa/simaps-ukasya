<div>
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/juri-ganda.css') }}">
    @vite('resources/js/layout.js')
@endsection
@section('title')
    Ganda
@endsection
    @include('juri.ganda.header')
@include('juri.ganda.content')
</div>
