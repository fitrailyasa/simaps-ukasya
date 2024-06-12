@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div class="persiapan-container d-flex text-center pt-5 mt-5" style="height: 70vh">
    <div class="pesilat-a " style="height: 100%;width:30%">
<img src="{{ $sudut_biru->img == null ? url('/assets/profile/default.png') : url('/assets/img/'.$sudut_biru->img) }}" 
     class="p-4" 
     alt="Profile Image" 
     style="width: 20vw !important; height: 40vh !important; background-color: #0053a6 !important; border-radius: 50%;">
        <h1 style="color: #0053a6">{{$sudut_biru->nama}}</h1>
        <h1>{{$sudut_biru->kontingen}}</h1>
    </div>
    <div class="tengah  d-flex justify-content-center flex-column" style="height: 100%;width:40%">
        <h1>Partai {{$jadwal->partai}}</h1>
        <h1 class="mt-5 fw-bold">VS</h1>
    </div>
    <div class="pesilat-b " style="height: 100%;width:30%">
<img src="{{ $sudut_merah->img == null ? url('/assets/profile/default.png') :  url('/assets/img/'.$sudut_biru->img) }}" 
     class="p-4" 
     alt="Profile Image" 
     style="width: 20vw !important; height: 40vh !important; background-color: #db3545 !important; border-radius: 50%;">

        <h1 style="color: #db3545">{{$sudut_merah->nama}}</h1>
        <h1>{{$sudut_merah->kontingen}}</h1>
    </div>
</div>

