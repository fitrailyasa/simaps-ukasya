<div>
    @section('title')
        Regu
    @endsection
    @include('dewan.regu.header')
    @include('dewan.regu.body')
    @include('dewan.regu.footer')
    @section('script')
        <script>
            setInterval(() => {
                @this.call('kurangiWaktu')
            }, 1000);
        </script>
    @endsection
</div>
