<div>
    @section('title')
        Solo
    @endsection
    @include('dewan.solo.header')
    @include('dewan.solo.body')
    @include('dewan.solo.footer')
    @section('script')
        <script>
            setInterval(() => {
                @this.call('kurangiWaktu')
            }, 1000);
        </script>
    @endsection
</div>
