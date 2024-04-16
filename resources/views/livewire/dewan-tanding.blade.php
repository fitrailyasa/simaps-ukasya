<div>
    @section('style')
        <link rel="stylesheet" href="{{url('assets/css/dewan/tanding.css')}}">
    @endsection
    @section('title')
        Tanding  
    @endsection
    @include('dewan.tanding.header',['kelas_penyisihan'=>$jadwal->kelas,'gelombang'=>$jadwal->gelombang,'partai'=>$jadwal->babak])
    @include('dewan.tanding.body',['pesilat_merah'=>$pesilat_merah,'pesilat_biru'=>$pesilat_biru])
    @include('dewan.tanding.tombol',['pesilat_merah'=>$pesilat_merah,'pesilat_biru'=>$pesilat_biru])
</div>


