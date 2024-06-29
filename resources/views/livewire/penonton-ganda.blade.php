<div>
    @include('client.penonton.tgr.navbar')
    @section('style')
        @vite('resources/js/layout.js')
    @endsection
    @if ($tahap == 'persiapan')
        @include('client.penonton.tgr.persiapan')
    @elseif($tahap == 'tampil' || $tahap == 'pause' || $tahap == 'tampil nilai')
        @include('client.penonton.tgr.tanding')  
    @elseif($tahap == 'keputusan')
        @include('client.penonton.tgr.hasil')
    @endif
    @section('script')
        <script>
            setInterval(() => {
                @this.call('check_gelanggang')
            }, 1500);
        </script>
    @endsection
</div>
