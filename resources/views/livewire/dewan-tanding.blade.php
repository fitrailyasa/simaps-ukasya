<div>
    @section('style')
        <link rel="stylesheet" href="{{url('assets/css/dewan/tanding.css')}}">
    @endsection
    @section('title')
        Tanding  
    @endsection
    @include('dewan.tanding.header',['kelas_penyisihan'=>$jadwal->kelas,'gelombang'=>$jadwal->gelombang,'partai'=>$jadwal->babak])
    @include('dewan.tanding.body',['sudut_merah'=>$sudut_merah,'sudut_biru'=>$sudut_biru])
    @include('dewan.tanding.tombol',['sudut_merah'=>$sudut_merah,'sudut_biru'=>$sudut_biru])
</div>


