<div>
@section('title', 'Tanding')
    <div
    class="p-3 "
    style="
        position: relative;
    "
>
    <div class="row justify-content-md-center m-2">
        <div class="col-md-4 d-flex justify-content-center">
            <h3 class="fw-bold">{{$juri->name}}</h3>
        </div>
    </div>
    
    
    <div class="d-flex flex-row justify-content-between  p-1 m-1 row" style="width:100%; margin-top: 76px !important; margin-bottom: -28px !important">
        <div class=" col-md-3 text-center">
            <h5 class="fw-bold bg-danger p-3 rounded kontingen" style="margin-left: 14px">{{$sudut_merah->kontingen}}</h5>
        </div>
        <div class="col-md-3 d-flex justify-content-center">
            <h4 class="fw-bold">{{$gelanggang->nama}}</h4>
        </div>
        <div class="mr-4 col-md-3 text-center">
            <h5 class="fw-bold p-3 rounded text-white kontingen" style="background-color: #0053a6; margin-right: 12px">{{$sudut_biru->kontingen}}</h5>
        </div>
    </div>
    <div class="row m-3" style="margin-top: 0px !important">
        <div class="row mt-5">
            <div class="col">
                <table
                    class="table table-bordered"
                    style="border: 2px solid #000"
                >
                    <thead>
                        <tr>
                            <th
                                scope="col"
                                class="bg-danger text-center text-white tabel-head mw-40"
                                style="border: 2px solid #000; width:40%"
                            >
                                Nilai
                            </th>
                            <th
                                scope="col"
                                class="text-center mw-20"
                                style="border: 2px solid #000; width:20%"
                            >
                                Babak
                            </th>
                            <th
                                scope="col"
                                class="text-center text-white tabel-head mw-40"
                                style="
                                    background-color: #0053a6;
                                    border: 2px solid #000;
                                    width:40%
                                "
                            >
                                Nilai
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border: 2px solid #000">
                            <td
                                class="tabel-1-1 fw-bold fs-5 text-end"
                                style="border: 2px solid #000"
                            >
                            @if ($jadwal->babak_tanding==1)
                             <h5 class="fw-bold p-1">
                                @for ($i = 0; $i < sizeof($babak_1_sudut_merah); $i++)
                                    
                                {{$babak_1_sudut_merah[$i]}}
                                @endfor
                             </h5>    
                            @endif
                            </td>
                            <td
                                class="text-center babak-1 {{$jadwal->babak_tanding==1 ? "babak-active" : ""}}"
                                style="border: 2px solid #000; height: 60px"
                            >
                                <img src={{url('/assets/svg/romawi-1.svg')}}
                                alt="">
                            </td>
                            <td
                                class="tabel-1-2 fw-bold fs-5 "
                                style="border: 2px solid #000"
                            >
                                @if ($jadwal->babak_tanding==1)
                                <h5 class="fw-bold p-1">
                                   
                                    @for ($i = 0; $i < sizeof($babak_1_sudut_biru); $i++)    
                                        {{$babak_1_sudut_biru[$i]}}
                                    @endfor
                                </h5>    
                                @endif
                            </td>
                        </tr>
                        <tr style="border: 2px solid #000">
                            <td
                                class="tabel-2-1 fw-bold fs-5 text-end"
                                style="border: 2px solid #000"
                            >
                                @if ($jadwal->babak_tanding==2)
                                <h5 class="fw-bold p-1">
                                    @for ($i = 0; $i < sizeof($babak_2_sudut_merah); $i++)      
                                        {{$babak_2_sudut_merah[$i]}}
                                    @endfor
                                </h5>    
                                @endif
                            </td>
                            <td
                                class="text-center babak-2 {{$jadwal->babak_tanding==2 ? "babak-active" : ""}}"
                                style="border: 2px solid #000; height: 60px"
                            >
                                <img src={{url('/assets/svg/romawi-2.svg')}}
                                alt="">
                            </td>
                            <td
                                class="tabel-2-2 fw-bold fs-5"
                                style="border: 2px solid #000"
                            >
                            @if ($jadwal->babak_tanding==2)
                                <h5 class="fw-bold p-1">
                                    @for ($i = 0; $i < sizeof($babak_2_sudut_biru); $i++)                                
                                        {{$babak_2_sudut_biru[$i]}}
                                    @endfor
                                </h5>    
                                @endif
                            </td>
                        </tr>
                        <tr style="border: 2px solid #000">
                            <td
                                class="tabel-3-1 fw-bold fs-5 text-end"
                                style="border: 2px solid #000"
                            >
                            @if ($jadwal->babak_tanding==3)
                                <h5 class="fw-bold p-1">
                                    @for ($i = 0; $i < sizeof($babak_3_sudut_merah); $i++)
                                        
                                    {{$babak_3_sudut_merah[$i]}}
                                    @endfor
                                </h5>    
                            @endif
                            </td>
                            <td
                                class="text-center babak-3 {{$jadwal->babak_tanding==3 ? "babak-active" : ""}}"
                                style="border: 2px solid #000; height: 60px"
                            >
                                <img src={{url('/assets/svg/romawi-3.svg')}}
                                alt="">
                            </td>
                            <td
                                class="tabel-3-2 fw-bold fs-5"
                                style="border: 2px solid #000"
                            >
                                @if ($jadwal->babak_tanding==3)
                                <h5 class="fw-bold p-1">
                                    @for ($i = 0; $i < sizeof($babak_3_sudut_biru); $i++)                                        
                                    {{$babak_3_sudut_biru[$i]}}
                                    @endfor
                                </h5>    
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row m-3 ">
        <div class="col d-flex justify-content-between" style="margin-left: -8px">
            <div class="poin p-1 m-1" style="width: 50%">
                <div class="poin p-1 m-1" style="width: 100%">
                    <button
                        wire:click = "tambahPukulanTrigger({{$sudut_merah->id}})"
                        class="btn btn-danger text-white p-3 mb-2 tombol-pukulan-a"
                        style="width: 100%; border-radius: 10px"
                        onclick=""
                    >
                        Pukulan
                    </button>
                </div>
                <div class="poin p-1 m-1" style="width: 100%">
                    <button
                        wire:click="tambahTendanganTrigger({{$sudut_merah->id}})"
                        class="btn btn-danger text-white p-3 tombol-tendangan-a"
                        style="width: 100%; border-radius: 10px"
                    >
                        Tendangan
                    </button>
                </div>
            </div>
            <div class="hapus-poin d-flex  p-1 m-1 " style="width: 200px;">
                <div class="tombol-hapus-a" style="width: 100%; height:100%">
                    <button
                        wire:click = "hapusTrigger({{$sudut_merah->id}})"
                        class="btn btn-danger text-white "
                        style="border-radius: 10px; width:100% !important; height:100% !important;"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        </div>
        <div class="col d-flex justify-content-between">
            <div class="hapus-poin d-flex justify-content-start p-1 m-1" style="width:200px">
                <div class="tombol-hapus-b" style="margin:0 !important;width: 100%; height:100%">
                    <button
                        wire:click = "hapusTrigger({{$sudut_biru->id}})"
                        class="btn btn-biru text-white"
                        style=" border-radius: 10px; height:100% ;width:100% ;background-color: #0053a6;"
                    >
                        Hapus
                    </button>
                </div>
            </div>
            <div class="poin p-1 m-1" style="width: 50%">
                <div class="" style="width: 100%; height:50%">
                    <button
                        wire:click = "tambahPukulanTrigger({{$sudut_biru->id}})"
                        class="btn btn-biru text-white p-3 mb-2 tombol-pukulan-b"
                        style="width: 100%; border-radius: 10px;background-color: #0053a6;"
                    >
                        Pukulan
                    </button>
                </div>
                <div class="" style="width: 100%; height:50%">
                    <button
                        wire:click = "tambahTendanganTrigger({{$sudut_biru->id}})"
                        class="btn btn-biru text-white p-3 tombol-tendangan-b"
                        style="width: 100%; border-radius: 10px ;background-color: #0053a6;"
                    >
                        Tendangan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('juri.tanding.JuriVerivikasiModal')
</div>
