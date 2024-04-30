<div class="dewan-tanding-header d-flex pt-5" style="width: 100%">
    <div class="" style="width: 50%">
        <h5 class="fw-bold ml-3" style="margin-bottom: -4px">
            @if ($tampil == $sudut_merah->id)
                {{$sudut_merah->kontingen}}
            @else
                {{$sudut_biru->kontingen}}
            @endif
        </h5>
        <h4 class="fw-bold" style="color: #db3545">
            @if ($tampil == $sudut_merah->id)
                {{$sudut_merah->nama}}
            @else
                {{$sudut_biru->nama}}
            @endif    
        </h4>
    </div>
    <div class="kontingen-biru text-end d-flex flex-column justify-content-center" style="width: 50%">
        <h5 class="fw-bold" style="margin-bottom: -4px">
            {{$gelanggang->nama}}, Match {{$jadwal->partai}}
        </h5>
        <h4 class="fw-bold">
            Tunggal
        </h4>
    </div>
</div>