<div>
    @include('client.penonton.tgr.navbar')
    @if ($tahap == 'persiapan')
        @include('client.penonton.tgr.persiapan')
    @elseif($tahap == 'tampil')
        @include('client.penonton.tgr.tanding')  
    @elseif($tahap == 'hasil')
        @include('client.penonton.tgr.hasil')
    @endif
</div>