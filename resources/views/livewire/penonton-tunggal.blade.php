<div>
    @section('style')
        @vite('resources/js/layout.js')
    @endsection
    @include('client.penonton.tgr.navbar')
    @if ($tahap == 'persiapan')
        @include('client.penonton.tgr.persiapan')
    @elseif($tahap == 'tampil' || $tahap == 'pause' || $tahap == 'tampil nilai')
        @include('client.penonton.tgr.tanding')  
    @elseif($tahap == 'keputusan')
        @include('client.penonton.tgr.hasil')
    @endif
</div>
