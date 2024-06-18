
<!-- Modal Verivikasi Jatuhan-->
<div wire:ignore.self class="modal" id="verifyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="staticBackdropLabel">Jury Verification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="wrapper border border-secondary d-flex flex-column gap-1 p-2" style="height: 20vh;">
           <div class="mt-3 container-fluid">
             <div class="modal-first-line text-center">
                <h5>Drop Verification</h5>
            </div>
            <div class="modal-second-line border border-secondary text-center" style="background-color: #EEEEEE;">
                <h5>Pilihan {{$user->name}}</h5>
            </div>
            <div class="modal-third-line border border-secondary text-center ">
                <h5 class="waiting">{{$pilihan}}</h5>
            </div>
           </div>
        </div>
      </div>
      <div class="modal-body d-flex justify-content-around ">
        <button wire:click='verifikasiJatuhanTrigger("biru")' type="button" class="btn btn-primary p-2" style="width: 40%">Blue Corner</button>
        <button wire:click='verifikasiJatuhanTrigger("merah")' type="button" class="btn btn-danger p-2" style="width: 40%">Red Corner</button>
        <button wire:click='verifikasiJatuhanTrigger("invalid")' type="button" class="btn btn-warning p-2 text-white">Invalid</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Verivikasi Pelanggaran-->
<div wire:ignore.self  class="modal" id="penaltyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="staticBackdropLabel">Jury Verification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="wrapper border border-secondary d-flex flex-column gap-1 p-2" style="height: 20vh;">
           <div class="mt-3 container-fluid">
             <div class="modal-first-line text-center">
                <h5>Penalty Verification</h5>
            </div>
            <div class="modal-second-line border border-secondary text-center" style="background-color: #EEEEEE;">
                <h5>Pilihan {{$user->name}}</h5>
            </div>
            <div class="modal-third-line border border-secondary text-center ">
                <h5 class="waiting">{{$pilihan}}</h5>
            </div>
           </div>
        </div>
      </div>
      <div class="modal-body d-flex justify-content-around ">
        <button wire:click='verifikasiPelanggaranTrigger("biru")' type="button" class="btn btn-primary p-2" style="width: 40%">Blue Corner</button>
        <button wire:click='verifikasiPelanggaranTrigger("merah")' type="button" class="btn btn-danger p-2" style="width: 40%">Red Corner</button>
        <button wire:click='verifikasiPelanggaranTrigger("invalid")' type="button" class="btn btn-warning p-2">Invalid</button>
      </div>
    </div>
  </div>
</div>