<div class="dewan-tanding-body" style="width: 100%">
    <div class="dewan-tanding-body-header d-flex" style="width: 100%">
        <div class="kontingen-merah" style="width: 50%">
            <h4 class="fw-bold" style="color: #db3545">
                {{$pesilat_a}}
            </h4>
        </div>
        <div class="kontingen-biru text-end" style="width: 50%">
            <h4 class="fw-bold" style="color: #252c94">
                {{$pesilat_b}}
            </h4>
        </div>
    </div>
    <div class="dewan-tanding-body-content d-flex">
        <div class="pesilat-a d-flex text-center" style="width: 45%; height: 100%;">
            <div class="peringatan" style="width: 23%">
                <div class="peringatan-header border border-dark bg-danger" >
                    <h5 class="fw-bold p-1 text-white">Peringatan</h5>
                </div>
                <div class="peringatan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="peringatan-babak-{{$i}} border border-dark" style="min-height:42px" >
                            <h5 class="fw-bold p-1 peringatan-{{$i}}"></h5>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="teguran" style="width: 23%">
                <div class="teguran-header border border-dark bg-danger" >
                    <h5 class="fw-bold p-1 text-white">Teguran</h5>
                </div>
                <div class="teguran-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="teguran-babak-{{$i}} border border-dark" style="min-height:42px" >
                            <h5 class="fw-bold p-1 teguran-{{$i}}"></h5>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="binaan" style="width: 23%">
                <div class="binaan-header border border-dark bg-danger">
                    <h5 class="fw-bold p-1 text-white">Binaan</h5>
                </div>
                <div class="binaan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="binaan-babak-{{$i}} border border-dark" style="min-height:42px" >
                            <h5 class="fw-bold p-1 binaan-{{$i}}"></h5>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="jatuhan" style="width: 31%">
                <div class="jatuhan-header border border-dark bg-danger">
                    <h5 class="fw-bold p-1 text-white">Jatuhan</h5>
                </div>
                  <div class="jatuhan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="jatuhan-babak-{{$i}} border border-dark" style="min-height:42px" >
                            <h5 class="fw-bold p-1 jatuhan-{{$i}}"></h5>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="babak" style="width: 10%">
            <div class="babak-container text-center">
                <div class="babak-header border border-dark" style="">
                    <h5 class="fw-bold p-1 ">Babak</h5>
                </div>
                <div class="babak-content">
                    <div class="babak-1 text-center border border-dark babak-active">
                        <img src={{url('/assets/svg/romawi-1.svg')}} height="40" width="40">
                    </div>
                    <div class="babak-2 text-center border border-dark">
                        <img src={{url('/assets/svg/romawi-2.svg')}} height="40" width="40">
                    </div>
                    <div class="babak-3 text-center border border-dark">
                        <img src={{url('/assets/svg/romawi-3.svg')}} height="40" width="40">
                    </div>
                </div>
            </div>
        </div>
        <div class="pesilat-b d-flex text-center" style="width: 45%">
            <div class="jatuhan" style="width: 31%">
                <div class="jatuhan-header border border-dark" style="background-color: #0053a6">
                    <h5 class="fw-bold p-1 text-white">Jatuhan</h5>
                </div>
                  <div class="jatuhan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="jatuhan-babak-{{$i}} border border-dark" style="min-height:42px" >
                            <h5 class="fw-bold p-1 jatuhan-{{$i}}"></h5>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="binaan" style="width: 23%">
                <div class="binaan-header border border-dark " style="background-color: #0053a6">
                    <h5 class="fw-bold p-1 text-white">Binaan</h5>
                </div>
                <div class="binaan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="binaan-babak-{{$i}} border border-dark" style="min-height:42px" >
                            <h5 class="fw-bold p-1 binaan-{{$i}}"></h5>
                        </div>
                    @endfor
                </div>
            </div>
             <div class="teguran" style="width: 23%">
                <div class="teguran-header border border-dark " style="background-color: #0053a6" >
                    <h5 class="fw-bold p-1 text-white">Teguran</h5>
                </div>
                <div class="teguran-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="teguran-babak-{{$i}} border border-dark" style="min-height:42px" >
                            <h5 class="fw-bold p-1 teguran-{{$i}}"></h5>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="peringatan" style="width: 23%">
                <div class="peringatan-header border border-dark " style="background-color: #0053a6">
                    <h5 class="fw-bold p-1 text-white">Peringatan</h5>
                </div>
                <div class="peringatan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="peringatan-babak-{{$i}} border border-dark" style="min-height:42px" >
                            <h5 class="fw-bold p-1 peringatan-{{$i}}"></h5>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>