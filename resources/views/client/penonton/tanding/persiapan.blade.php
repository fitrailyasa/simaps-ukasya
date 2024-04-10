<div class="persiapan-container d-flex text-center pt-5 mt-5" style="height: 70vh">
    <div class="pesilat-a " style="height: 100%;width:30%">
        <img src="{{url('/assets/img/tendang.png')}}" alt="" style="height: 40vh">
        <h1 style="color: #0053a6">{{$pesilat[0]['nama']}}</h1>
        <h1>{{$pesilat[0]['perguruan']}}</h1>
    </div>
    <div class="tengah  d-flex justify-content-center flex-column" style="height: 100%;width:40%">
        <h1>Partai {{$partai}}</h1>
        <h1 class="mt-5 fw-bold">VS</h1>
    </div>
    <div class="pesilat-b " style="height: 100%;width:30%">
        <img src="{{url('/assets/img/tendang.png')}}" alt="" style="height: 40vh;-webkit-transform: scaleX(-1);
        transform: scaleX(-1);">
        <h1 style="color: #db3545">{{$pesilat[1]['nama']}}</h1>
        <h1>{{$pesilat[1]['perguruan']}}</h1>
    </div>
</div>