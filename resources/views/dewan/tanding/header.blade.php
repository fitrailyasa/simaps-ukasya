<div class="dewan-tanding-header d-flex pt-5" style="width: 100%">
    <div class="kontingen-biru d-flex flex-column justify-content-end" style="width: 30%">
        <h4 class="fw-bold">
            {{$sudut_biru->kontingen}}
        </h4>
    </div>
    <div class="jenis text-center" style="width: 40%">
        <div class="row-1">
            <h4 class="fw-bold">
                DEWAN <br/> PERTANDINGAN
            </h4>
        </div>
        <div class="row-2">
            <h4 class="fw-bold">
                {{$jadwal->babak}} - {{$sudut_merah->golongan}} -  {{$sudut_biru->kelas}} <br/> Partai {{$jadwal->partai}}
            </h4>
        </div>
    </div>
    <div class="kontingen-merah text-right d-flex flex-column justify-content-end" style="width: 30%">
        <h4 class="fw-bold">
            {{$sudut_merah->kontingen}}
        </h4>
    </div>
</div>