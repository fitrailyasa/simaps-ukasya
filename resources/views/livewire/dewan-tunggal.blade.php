<div>
    @section('title')
        Tunggal
    @endsection
    @include('dewan.tunggal.header')
    @include('dewan.tunggal.body')
    @include('dewan.tunggal.footer')
    @section('script')
        <script>
            setInterval(() => {
                @this.call('kurangiWaktu')
            }, 1000);
        </script>
    @endsection
</div>
