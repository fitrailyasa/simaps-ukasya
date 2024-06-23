<div class="header d-flex justify-content-between p-2" style="width: 100%">
    <div class="left" style="width: 50%">
        <h5 class="fw-bold">{{$tampil->kontingen}},<span class="fw-bold" style="{{$tampil->id == $sudut_biru->id ? "color: #0053a6 !important" : "color:  red!important"}}"> {{$tampil->nama}}</span></h5>
    </div>
    <div class="text-end" style="width: 50%">
        <h5 class="fw-bold gap-2 d-flex justify-content-end"><span>{{$gelanggang->nama}},</span> <span>Partai {{$jadwal->partai}},</span> <span>{{$juri->permissions}}</span> SOLO</h5>
    </div>
</div>