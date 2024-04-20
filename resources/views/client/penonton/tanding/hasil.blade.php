<div class="hasil-container d-flex text-center p-3" style="height: 80vh">
     <div class="pesilat-a d-flex justify-content-center flex-column text-center" style="height: 100%;width:30%">
        <div class="image d-flex justify-content-center" style="height: 20%;width: 100%" >
            <img src="{{url('/assets/img/ipsi.png')}}" alt="" style="height: 100%;width: 40%" >
        </div>
        <h1 style="color: #0053a6">{{$sudut[0]['nama']}}</h1>
        <h1>{{$sudut[0]['perguruan']}}</h1>
        <div class="score d-flex justify-content-center flex-column" style="height: 50%;width:100%;border: solid 3px #0053a6">
            <p class="text-hasil" style="font-size: 10rem;color: #0053a6">20</p>
        </div>
    </div>
    <div class="hasil  d-flex justify-content-center flex-column text-center" style="height: 100%;width:40%">
        <p class="text-hasil fw-bold" style="font-size: 3rem;">PEMENANG</p>
        <div class="score d-flex justify-content-center" style="height: 20%;width:100%;">
            <div class="button"  style="height: 90%;width:60%">
                <div class="" style="height: 100%;width:100%;border: solid 3px #0053a6;background-color: #0053a6; border-radius: 20px">
                    <p class="text-hasil" style="font-size: 4rem;color: #fff">BIRU</p>
                </div>
            </div>
        </div>
        <p class="text-hasil fw-bold" style="font-size: 4rem;">SCORE</p>
    </div>
    <div class="pesilat-b d-flex justify-content-center flex-column" style="height: 100%;width:30%">
         <div class="image d-flex justify-content-center" style="height: 20%;width: 100%" >
            <img src="{{url('/assets/img/ipsi.png')}}" alt="" style="height: 100%;width: 40%;" >
        </div>
        <h1 style="color: #db3545">{{$sudut[1]['nama']}}</h1>
        <h1>{{$sudut[1]['perguruan']}}</h1>
        <div class="score d-flex justify-content-center flex-column" style="height: 50%;width:100%;border: solid 3px #db3545">
            <p class="text-hasil" style="font-size: 10rem;color: #db3545">15</p>
        </div>
    </div>
</div>
