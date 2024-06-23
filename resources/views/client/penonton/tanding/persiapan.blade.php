@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div class="persiapan-container d-flex text-center mt-5" style="height: 70vh ">
    <div class="pesilat-a " style="height: 100%;width:40%">
    <img src="{{ $sudut_biru->img == null ? url('/assets/profile/default.webp') : url('/assets/img/'.$sudut_biru->img) }}" 
     class="p-4" 
     alt="Profile Image" 
     style="width: 30vw !important; height: 50vh !important; background-color: #0053a6 !important; border-radius: 50%;">
        <h1 style="color: #0053a6 ;font-weight: 900;font-size: 3rem">{{$sudut_biru->nama}}</h1>
        <h1 style="font-weight: 900;font-size: 3rem">{{$sudut_biru->kontingen}}</h1>
    </div>
    <div class="tengah  d-flex justify-content-center flex-column text-center" style="height: 100%;width:20%">
        <h1 style="font-weight: 600;font-size: 5rem">Partai <br> {{$jadwal->partai}}</h1>
        <h1 style="font-weight: 600;font-size: 5rem" class="mt-5 fw-bold">VS</h1>
    </div>
    <div class="pesilat-b " style="height: 100%;width:40%">
<img src="{{ $sudut_merah->img == null ? url('/assets/profile/default.webp') :  url('/assets/img/'.$sudut_biru->img) }}" 
     class="p-4" 
     alt="Profile Image" 
     style="width: 30vw !important; height: 50vh  !important; background-color: #db3545 !important; border-radius: 50%;">

        <h1 style="color: #db3545;font-weight: 900;font-size: 3rem">{{$sudut_merah->nama}}</h1>
        <h1 style="font-weight: 900;font-size: 3rem">{{$sudut_merah->kontingen}}</h1>
    </div>
</div>

