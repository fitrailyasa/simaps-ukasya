<div class="header d-flex justify-content-between p-3" style="width: 100%">
    <div class="left" style="width: 50%">
        <span class="ml-5 fw-bold">{{$tampil->kontingen}}</span>
        <h5 class="fw-bold" style="{{$tampil->id == $sudut_biru->id ? "color: #0053a6 !important" : "color:  red!important"}}">
            {{$tampil->nama}}
        </h5>
    </div>
    <div class="right  text-end mt-3" style="width: 50%">
        <span class="fw-normal gap-2 d-flex justify-content-end"><span>{{$gelanggang->nama}},</span> <span>Match {{$jadwal->partai}},</span> <span>{{$juri->name}}</span></span>
        <h5 class="fw-bold" style="">
            GANDA (GANDA)
        </h5>
    </div>
</div>