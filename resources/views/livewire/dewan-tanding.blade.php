<div>
    @section('style')
        <link rel="stylesheet" href="{{url('assets/css/dewan/tanding.css')}}">
    @endsection
    @section('title')
        Tanding  
    @endsection
    @include('dewan.tanding.header')
    @include('dewan.tanding.body')
    @include('dewan.tanding.tombol')
</div>


