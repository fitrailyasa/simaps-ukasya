<div class="tunggal-body d-flex gap-1 border text-center" style="width: 100%;height: 60vh;">
    <div class="penalty" style="width: 50%">
        <div class="penalty-header border border-dark" style="background-color: #ececec;height: 10%;">
            <h5 class="fw-bold">Penalty</h5>
        </div>
        <div class="penalty-body" style="height: 90%;">
            <div class="row-1 border border-dark d-flex justify-content-center flex-column" style="height: 16.67%">
             <h5 class="">Performance Melewati Toleransi Waktu</h5>               
            </div>
            <div class="row-2 border border-dark d-flex justify-content-center flex-column" style="height: 16.67%">
                <h5 class="">Performance Keluar Arena</h5>
            </div>
            <div class="row-3 border border-dark d-flex justify-content-center flex-column" style="height: 16.67%">
                <h5 class="">Senjata Jatuh di Luar Gelanggan Saat Tim <br> Masih Harus Menggunakan</h5>
            </div>
            <div class="row-4 border border-dark d-flex justify-content-center flex-column" style="height: 16.67%">
                <h5 class="">Pakaian Tidak Sesuai Aturan</h5>
            </div>
            <div class="row-5 border border-dark d-flex justify-content-center flex-column" style="height: 16.67%">
                <h5 class="">Atlit Tidak Bergerak Selama 5 Detik</h5>
            </div>
            <div class="row-5 border border-dark d-flex justify-content-center flex-column" style="height: 16.67%">
                <h5 class="">Senjata Jatuh Tidak Sesuai Sinopsis</h5>
            </div>
        </div>
    </div>
    <div class="score" style="width: 50%">
        <div class="score-header border border-dark" style="background-color: #ececec;height: 10%;">
            <h5 class="fw-bold">Score</h5>
        </div>
        <div class="score-body" style="height: 90%;">
            <div class="row-1 d-flex" style="height:16.67% ">
                <div class="button d-flex justify-content-center gap-2 border border-dark" style="width: 80%">
                    <button wire:click='hapusPenaltyTrigger("toleransi_waktu")' class="btn btn-biru mt-1" style="height: 80%;width: 40%"><h5 class="text-white">Hapus</h5></button>
                    <button wire:click='penaltyTrigger("toleransi_waktu")' class="btn btn-danger mt-1" style="height: 80%;width: 40%"><h5 class="text-white">-0.50</h5></button>
                </div>
                <div class="score-value border border-dark d-flex justify-content-center flex-column" style="width: 20%">
                    <h5 class="fw-bold">{{$penalty_ganda->toleransi_waktu == 0 ? "0" : $penalty_ganda->toleransi_waktu * -0.5}}</h5>
                </div>
            </div>
            <div class="row-2 d-flex" style="height:16.67% ">
                <div class="button d-flex justify-content-center gap-2 border border-dark" style="width: 80%">
                    <button wire:click='hapusPenaltyTrigger("keluar_arena")' class="btn btn-biru mt-1" style="height: 80%;width: 40%"><h5 class="text-white">Hapus</h5></button>
                    <button wire:click='penaltyTrigger("keluar_arena")' class="btn btn-danger mt-1" style="height: 80%;width: 40%"><h5 class="text-white">-0.50</h5></button>
                </div>
                <div class="score-value border border-dark  d-flex justify-content-center flex-column" style="width: 20%">
                    <h5 class="fw-bold">{{$penalty_ganda->keluar_arena == 0 ? "0" : $penalty_ganda->keluar_arena * -0.5}}</h5>
                </div>
            </div>
            <div class="row-3 d-flex" style="height:16.67% ">
                <div class="button d-flex justify-content-center gap-2 border border-dark" style="width: 80%">
                    <button wire:click='hapusPenaltyTrigger("menyentuh_lantai")' class="btn btn-biru mt-1" style="height: 80%;width: 40%"><h5 class="text-white">Hapus</h5></button>
                    <button wire:click='penaltyTrigger("menyentuh_lantai")' class="btn btn-danger mt-1" style="height: 80%;width: 40%"><h5 class="text-white">-0.50</h5></button>
                </div>
                <div class="score-value border border-dark d-flex justify-content-center flex-column" style="width: 20%">
                    <h5 class="fw-bold">{{$penalty_ganda->menyentuh_lantai == 0 ? "0" : $penalty_ganda->menyentuh_lantai * -0.5}}</h5>
                </div>
            </div>
            <div class="row-4 d-flex" style="height:16.67% ">
                <div class="button d-flex justify-content-center gap-2 border border-dark" style="width: 80%">
                    <button wire:click='hapusPenaltyTrigger("pakaian")' class="btn btn-biru mt-1" style="height: 80%;width: 40%"><h5 class="text-white">Hapus</h5></button>
                    <button wire:click='penaltyTrigger("pakaian")' class="btn btn-danger mt-1" style="height: 80%;width: 40%"><h5 class="text-white">-0.50</h5></button>
                </div>
                <div class="score-value border border-dark d-flex justify-content-center flex-column" style="width: 20%">
                    <h5 class="fw-bold">{{$penalty_ganda->pakaian == 0 ? "0" : $penalty_ganda->pakaian * -0.5}}</h5>
                </div>
            </div>
            <div class="row-5 d-flex" style="height:16.67% ">
                <div class="button d-flex justify-content-center gap-2 border border-dark" style="width: 80%">
                    <button wire:click='hapusPenaltyTrigger("tidak_bergerak")' class="btn btn-biru mt-1" style="height: 80%;width: 40%"><h5 class="text-white">Hapus</h5></button>
                    <button wire:click='penaltyTrigger("tidak_bergerak")' class="btn btn-danger mt-1" style="height: 80%;width: 40%"><h5 class="text-white">-0.50</h5></button>
                </div>
                 <div class="score-value border border-dark d-flex justify-content-center flex-column" style="width: 20%">
                    <h5 class="fw-bold">{{$penalty_ganda->tidak_bergerak == 0 ? "0" : $penalty_ganda->tidak_bergerak * -0.5}}</h5>
                </div>
            </div>
            <div class="row-6 d-flex" style="height:16.67% ">
                <div class="button d-flex justify-content-center gap-2 border border-dark" style="width: 80%">
                    <button wire:click='hapusPenaltyTrigger("senjata_jatuh")' class="btn btn-biru mt-1" style="height: 80%;width: 40%"><h5 class="text-white">Hapus</h5></button>
                    <button wire:click='penaltyTrigger("senjata_jatuh")' class="btn btn-danger mt-1" style="height: 80%;width: 40%"><h5 class="text-white">-0.50</h5></button>
                </div>
                <div class="score-value border border-dark d-flex justify-content-center flex-column" style="width: 20%">
                    <h5 class="fw-bold">{{$penalty_ganda->senjata_jatuh == 0 ? "0" : $penalty_ganda->senjata_jatuh * -0.5}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>