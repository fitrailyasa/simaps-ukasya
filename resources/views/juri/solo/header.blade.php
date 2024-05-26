<div class="header d-flex justify-content-between p-3" style="width: 100%">
    <div class="left" style="width: 50%">
        <span class="ml-5 fw-bold">{{ $tampil == $jadwal->sudut_merah ? $sudut_merah->region : $sudut_niru->region }}</span>
        <h5 class="fw-bold" style="color:#252c94">
            {{ $tampil == $jadwal->sudut_merah ? $sudut_merah->nama : $sudut_niru->nama }}
        </h5>
    </div>
    <div class="right  text-end mt-3" style="width: 50%">
        <span class="fw-normal gap-2 d-flex justify-content-end"><span>{{ $gelanggang->nama }},</span> <span>Match
                {{ $jadwal->partai }},</span> <span>{{ $juri->name }}</span></span>
        <h5 class="fw-bold" style="">
            SOLO (SOLO)
        </h5>
    </div>
</div>
