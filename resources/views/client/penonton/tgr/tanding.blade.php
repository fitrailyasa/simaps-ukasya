@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div class="tanding-container p-3 " style="height: 50vh;">
    <div class="tanding-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex" style="width: 50%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; background-color: #0053a6">
                <img src="{{url('/assets/profile/default.png')}}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">Sheikh Alaudin</p>
                <p class="fw-bold" style="font-size: 2rem;color: #0053a6">INDONESIA</p>
            </div>
        </div>
        <div class="timer d-flex flex-column text-center" style="width: 50%">
            @if ($nilai =='false')
                <div class="timer-text" style="height: 40%">
                    <p class="text-hasil" style="font-size: 2rem;">Timer</p>
                </div>
                <div class="timer-clock">
                    <p class="text-hasil" style="font-size: 3rem;">00:00</p>
                </div>
            @else
                <div class="box-nilai"  style="height: 100%">
                    <div class="up d-flex" style="height: 50%">
                        <div class="median border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success " style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Median</p>
                            </div>
                        </div>
                        <div class="penalty border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Penalty</p>
                            </div>
                        </div>
                        <div class="time-performance border border-dark" style="height: 100%;width: 40%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Time Performance</p>
                            </div>
                        </div>
                        <div class="total border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Total</p>
                            </div>
                        </div>
                    </div>
                    <div class="down" style="height: 50%">
                      <div class="standard border border-dark" style="height: 100%;width: 100%">
                            <div class="header bg-success pb-2" style="height: 30%">
                                <p class="text-hasil fw-bold" style="font-size: 1rem; color: #fff;margin-top: ;">Standard Deviation</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tgr-content mt-5 d-flex text-center" style="width: 100%;height: 40%;">
        @for ($i = 1; $i <= 10; $i++)
        <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: 10%">
            <div class="up-{{$i}} bg-primary" style="height: 50%;width: 100%">
                <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$i}}</p>
            </div>
            <div class="down-{{$i}} bg-primary" style="height: 50%;width: 100%">
                <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">9.90</p>
            </div>
        </div>
        @endfor
    </div>
</div>

@section('script')
    <script>
        let rand = Math.floor(Math.random() * 10) + 1;
        if($(`.box-nilai`)){
            $(`.down-${rand}`).removeClass('bg-primary')
            $(`.up-${rand}`).removeClass('bg-primary')
            $(`.down-${rand}`).addClass('bg-success')
            $(`.up-${rand}`).addClass('bg-success')
        }
    </script>
@endsection