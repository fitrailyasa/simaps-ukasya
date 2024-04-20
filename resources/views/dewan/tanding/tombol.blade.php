<div class="tombol-container d-flex mt-3" style="width: 100%;height: 40vh;">
    <div class="tombol-pesilat-a" style="width: 45%; height: 100%">
        <div class="tombol d-flex gap-4 mt-2" style="width: 100%; height: 70%">
            <div class="tombol-1" style="width: 33%;height: 100%;">
                <button wire:click.prevent="tambahJatuhanTrigger({{$sudut_merah->id}})" class="btn btn-danger mb-4 btn-jatuhan-a" style="border-radius: 20px !important ;border: 2px solid black; height: 40%; width: 100%"><h5 class="fw-bold">Jatuhan</h5></button>
                <button wire:click.prevent="tambahBinaanTrigger({{$sudut_merah->id}})" class="btn btn-danger" style=" border-radius: 20px !important ;border: 2px solid black; height: 40%; width: 100%"><h5 class="fw-bold">Binaan</h5></button>
            </div>
            <div class="tombol-2" style="width: 33%;height: 100%;">
                <button wire:click.prevent="tambahTeguranTrigger({{$sudut_merah->id}})" class="btn btn-danger mb-4" style="border-radius: 20px !important ;border: 2px solid black; height: 40%; width: 100%"><h5 class="fw-bold">  Teguran</h5></button>
                <button wire:click.prevent="tambahPeringatanTrigger({{$sudut_merah->id}})" class="btn btn-danger" style=" border-radius: 20px !important ;border: 2px solid black; height: 40%; width: 100%"><h5 class="fw-bold">Peringatan</h5></button>
            </div>
            <div class="tombol-3" style="width: 33%;height: 100%;">
                <button wire:click='hapusTrigger({{$sudut_merah->id}})' class="btn btn-danger mt-3" style="border-radius: 20px !important ;border: 2px solid black; height: 80%; width: 100%"><h5 class="fw-bold">Hapus</h5></button>            
            </div>
        </div>
        <div class="verifikasi" style="width: 100%; height: 30%">
            <button  class="btn text-white" data-bs-toggle="modal" data-bs-target="#jatuhan" style="background-color: #70ad47; ;border-radius: 20px !important ;border: 2px solid black; height: 100%; width: 100%">
                <h5 class="fw-bold">Verifikasi Jatuhan</h5>
            </button>
        </div>
    </div>
    <div class="gap" style="width: 10%"></div>
    <div class="tombol-pesilat-b" style="width: 45%">
      <div class="tombol d-flex gap-4 mt-2" style="width: 100%; height: 70%">
            <div class="tombol-1" style="width: 33%;height: 100%;">
                <button wire:click='hapusTrigger({{$sudut_biru->id}})' class="btn btn-biru mt-3" style="border-radius: 20px !important ;border: 2px solid black; height: 80%; width: 100%"><h5 class="fw-bold">Hapus</h5></button>            
            </div>
            <div class="tombol-2" style="width: 33%;height: 100%;">
                <button wire:click.prevent="tambahTeguranTrigger({{$sudut_biru->id}})" class="btn btn-biru mb-4" style="border-radius: 20px !important ;border: 2px solid black; height: 40%; width: 100%"><h5 class="fw-bold">Teguran</h5></button>
                <button wire:click.prevent="tambahPeringatanTrigger({{$sudut_biru->id}})" class="btn btn-biru" style=" border-radius: 20px !important ;border: 2px solid black; height: 40%; width: 100%"><h5 class="fw-bold">Peringatan</h5></button>
            </div>
            <div class="tombol-3" style="width: 33%;height: 100%;">
                <button wire:click.prevent="tambahJatuhanTrigger({{$sudut_biru->id}})" class="btn btn-biru mb-4 btn-jatuhan-b" style="border-radius: 20px !important ;border: 2px solid black; height: 40%; width: 100%"><h5 class="fw-bold">Jatuhan</h5></button>
                <button wire:click.prevent="tambahBinaanTrigger({{$sudut_biru->id}})" class="btn btn-biru" style=" border-radius: 20px !important ;border: 2px solid black; height: 40%; width: 100%"><h5 class="fw-bold">Binaan</h5></button>
            </div>
        </div>
        <div class="verifikasi" style="width: 100%; height: 30%">
            <button class="btn text-white" data-bs-toggle="modal" data-bs-target="#pelanggaran" style="background-color: #70ad47; ;border-radius: 20px !important ;border: 2px solid black; height: 100%; width: 100%">
                <h5 class="fw-bold">Verifikasi Pelanggaran</h5>
            </button>
        </div>
    </div>
    <button wire:click='GantiBabakTrigger({{$jadwal->id}})'>tes</button>
        @include('dewan.tanding.modal',['juri_1'=>'setuju','juri_2'=>'setuju','juri_3'=>'setuju','PenilaianTanding'=>'1'])
</div>