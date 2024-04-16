<div>
    @section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tanding.css')}}">
    @endsection
    @include('client.penonton.tanding.navbar')
    @if ($jadwal->tahap == 'tanding')
        @include('client.penonton.tanding.persiapan')
    @elseif($jadwal->tahap == 'persiapan')
        @include('client.penonton.tanding.tanding')  
    @elseif($jadwal->tahap == 'hasil')
        @include('client.penonton.tanding.hasil',['pemenang'=>'biru'])
    @endif
</div>
