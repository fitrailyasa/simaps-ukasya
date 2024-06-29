<div>
    @section('style')
    @vite('resources/js/layout.js')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tanding.css')}}">
    @endsection
    @include('client.penonton.tanding.navbar')
    @if ($jadwal->tahap == 'persiapan' || $jadwal->tahap == 'menunggu')
        @include('client.penonton.tanding.persiapan')
    @elseif($jadwal->tahap == 'tanding' || $jadwal->tahap == 'pause')
        @include('client.penonton.tanding.tanding')  
    @elseif($jadwal->tahap == 'hasil')
        @include('client.penonton.tanding.hasil')
    @endif
</div>
