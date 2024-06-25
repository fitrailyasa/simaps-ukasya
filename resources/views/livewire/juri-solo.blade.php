<div>
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/juri-ganda.css') }}">
    @vite('resources/js/layout.js')
@endsection
@section('title')
    Solo
@endsection
@include('juri.solo.header')
@include('juri.solo.content')
</div>
