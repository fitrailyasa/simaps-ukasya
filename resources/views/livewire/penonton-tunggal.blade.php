<div>
    @include('client.penonton.tgr.navbar')
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
            @this.call(`check_gelanggang`)
        }, 1000);
    </script>
@endsection
</div>
