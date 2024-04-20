@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div class="persiapan-container d-flex text-center pt-5 mt-5" style="height: 70vh">
    <div class="pesilat-a " style="height: 100%;width:30%">
        <img src="{{url('/assets/img/tendang.png')}}" alt="" style="height: 40vh">
        <h1 style="color: #0053a6">{{$sudut_biru->nama}}</h1>
        <h1>{{$sudut_biru->kontingen}}</h1>
    </div>
    <div class="tengah  d-flex justify-content-center flex-column" style="height: 100%;width:40%">
        <h1>Partai {{$jadwal->partai}}</h1>
        <h1 class="mt-5 fw-bold">VS</h1>
    </div>
    <div class="pesilat-b " style="height: 100%;width:30%">
        <img src="{{url('/assets/img/tendang.png')}}" alt="" style="height: 40vh;-webkit-transform: scaleX(-1);
        transform: scaleX(-1);">
        <h1 style="color: #db3545">{{$sudut_merah->nama}}</h1>
        <h1>{{$sudut_merah->kontingen}}</h1>
    </div>
</div>