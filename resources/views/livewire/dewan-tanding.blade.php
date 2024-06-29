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
    @section('script')
        <script>
            setInterval(() => {
                @this.call('kurangiWaktu')
            }, 1600);
        </script>
    @endsection
</div>


