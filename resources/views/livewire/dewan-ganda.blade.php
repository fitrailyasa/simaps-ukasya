<div>
    @section('title')
        Ganda
    @endsection
    @include('dewan.ganda.header')
    @include('dewan.ganda.body')
    @include('dewan.ganda.footer')
    @section('script')
        <script>
            setInterval(() => {
                @this.call('kurangiWaktu')
            }, 1000);
        </script>
    @endsection
</div>
