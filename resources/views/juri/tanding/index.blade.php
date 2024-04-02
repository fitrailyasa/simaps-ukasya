@extends('layouts.juri.app') 
@section('title', 'Tanding')
@section('content')
    <div
    class="p-3 "
    style="
        position: relative;
        margin-top: -48px;
    "
>
    <img class="juri-bg" src="{{url("/assets/img/ipsi.png")}} " style="position: absolute;
    height:100%;width:50%; opacity:20%; left: 0; right: 0; top: 0; bottom: 0;
    margin: auto" alt="">
    <div class="row justify-content-md-center m-2">
        <div class="col-md-4 d-flex justify-content-center">
            <h3 class="fw-bold">Juri 1</h3>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-between  p-1 m-1 " style="width:100%">
        <div class="ml-4">
            <h5 class="fw-bold bg-danger p-3 rounded kontingen">Kontingen A</h5>
        </div>
        <div class="mr-4">
            <h5 class="fw-bold  p-3 rounded text-white kontingen" style="background-color: #0053a6;">Kontingen B</h5>
        </div>
    </div>
    <div class="row m-3">
        <div class="row justify-content-md-center">
            <div class="col-md-4 d-flex justify-content-center">
                <h4 class="fw-bold">Arena A</h4>
            </div>
        </div>
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
                            ></td>
                            <td
                                class="text-center babak-1 babak-active"
                                style="border: 2px solid #000; height: 60px"
                            >
                                <img src={{url('/assets/svg/romawi-1.svg')}}
                                alt="">
                            </td>
                            <td
                                class="tabel-1-2 fw-bold fs-5"
                                style="border: 2px solid #000"
                            ></td>
                        </tr>
                        <tr style="border: 2px solid #000">
                            <td
                                class="tabel-2-1 fw-bold fs-5 text-end"
                                style="border: 2px solid #000"
                            ></td>
                            <td
                                class="text-center babak-2"
                                style="border: 2px solid #000; height: 60px"
                            >
                                <img src={{url('/assets/svg/romawi-2.svg')}}
                                alt="">
                            </td>
                            <td
                                class="tabel-2-2 fw-bold fs-5"
                                style="border: 2px solid #000"
                            ></td>
                        </tr>
                        <tr style="border: 2px solid #000">
                            <td
                                class="tabel-3-1 fw-bold fs-5 text-end"
                                style="border: 2px solid #000"
                            ></td>
                            <td
                                class="text-center babak-3"
                                style="border: 2px solid #000; height: 60px"
                            >
                                <img src={{url('/assets/svg/romawi-2.svg')}}
                                alt="">
                            </td>
                            <td
                                class="tabel-3-2 fw-bold fs-5"
                                style="border: 2px solid #000"
                            ></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row m-3">
        <div class="col d-flex justify-content-between">
            <div class="poin p-1 m-1" style="width: 50%"">
                <div class="poin p-1 m-1" style="width: 100%">
                    <button
                        class="btn btn-danger text-white p-3 mb-2 tombol-pukulan-a"
                        style="width: 100%; border-radius: 10px"
                        onclick=""
                    >
                        Pukulan
                    </button>
                </div>
                <div class="poin p-1 m-1" style="width: 100%">
                    <button
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
                        class="btn btn-biru text-white p-3 mb-2 tombol-pukulan-b"
                        style="width: 100%; border-radius: 10px;background-color: #0053a6;"
                    >
                        Pukulan
                    </button>
                </div>
                <div class="" style="width: 100%; height:50%">
                    <button
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
@endsection
@section('script')
<script>
    let babak = 1;
    let nilaiA = "";
    let nilaiB = "";

    $(".ganti-babak").on("click", () => {
        babak++;
        nilaiA = "";
        nilaiB = "";
        if (babak > 3) {
            babak = 1;
            $(`.tabel-1-1`).text("");
            $(`.tabel-2-1`).text("");
            $(`.tabel-3-1`).text("");
            $(`.tabel-1-2`).text("");
            $(`.tabel-2-2`).text("");
            $(`.tabel-3-2`).text("");
        }
        $(".babak-active").removeClass("babak-active");
        $(`.babak-${babak}`).addClass("babak-active");
    });

    //tambah poin pukulan a
    $(".tombol-pukulan-a").on("click", (e) => {
        nilaiA = "1" + nilaiA;
        $(`.tabel-${babak}-1`).text(nilaiA);
    });
    //tambah poin tendangan a
    $(".tombol-tendangan-a").on("click", (e) => {
        nilaiA = "2" + nilaiA;
        $(`.tabel-${babak}-1`).text(nilaiA);
    });

    //tambah poin pukulan b
    $(".tombol-pukulan-b").on("click", (e) => {
        nilaiB += "1";
        $(`.tabel-${babak}-2`).text(nilaiB);
    });
    //tambah poin tendangan b
    $(".tombol-tendangan-b").on("click", (e) => {
        if ((nilaiB.length + 1)%5 != 0){
            nilaiB += "2";
            $(`.tabel-${babak}-2`).text(nilaiB);
        }else{
            nilaiB += `2 \n`;
            $(`.tabel-${babak}-2`).text(nilaiB);
        } 
    });

    $(".tombol-hapus-a").on("click", (e) => {
        nilaiA = nilaiA.slice(1, nilaiA.length);
        $(`.tabel-${babak}-1`).text(nilaiA);
    });
    $(".tombol-hapus-b").on("click", (e) => {
        nilaiB = nilaiB.slice(0, -1);
        $(`.tabel-${babak}-2`).text(nilaiB);
    });

   setTimeout(()=>{
       $('#verifyModal').modal('show');
       setTimeout(()=>{
            $('.waiting').text('invalid')
       },3000)
 }, 5000);
</script>
@endsection
