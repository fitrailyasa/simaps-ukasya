<div>
    @php
        $total_poin_merah = 0;
        foreach ($poin_merah->where('status','sah') as $index => $poin) {
            switch ($poin->jenis) {
                case 'jatuhan':
                    $total_poin_merah += $poin->dewan;
                    break;
                case 'binaan':
                    $total_poin_merah += $poin->dewan;
                    break;
                case 'teguran':
                    $total_poin_merah += $poin->dewan;
                    break;
                case 'peringatan':
                    $total_poin_merah += $poin->dewan;
                    break;
                case 'pukulan':
                    $total_poin_merah += 1;
                    break;
                case 'tendangan':
                    $total_poin_merah += 2;
                    break;
            }
        }
        $total_poin_biru = 0;
        foreach ($poin_biru->where('status','sah') as $index => $poin) {
            switch ($poin->jenis) {
                case 'jatuhan':
                    $total_poin_biru += $poin->dewan;
                    break;
                case 'binaan':
                    $total_poin_biru += $poin->dewan;
                    break;
                case 'teguran':
                    $total_poin_biru += $poin->dewan;
                    break;
                case 'peringatan':
                    $total_poin_biru += $poin->dewan;
                    break;
                case 'pukulan':
                    $total_poin_biru += 1;
                    break;
                case 'tendangan':
                    $total_poin_biru += 2;
                    break;
            }
        }
    @endphp
    @section('title')
        kontrol-tanding
    @endsection
    <div class="header d-flex justify-content-between align-items-center m-2 p-2">
        <a href="/op/kontrol-tanding" class="btn" style="border: none;">
            <i class="fa-solid fa-arrow-left bg-dark p-3" style="color: white; font-size: 2rem;"></i>
        </a>
        <h4 class="fw-bold text-center flex-grow-1 m-0">
            BABAK {{$jadwal_tanding->babak}} {{$jadwal_tanding->class}} {{$sudut_biru->kelas}} {{$sudut_biru->golongan}} {{$sudut_biru->jenis_kelamin == 'L' ? "Laki-Laki" : "Perempuan"}}
            <br />
            {{$gelanggang->nama}} Partai {{$jadwal_tanding->partai}}
        </h4>
    </div>

   <hr style="height: 5px; background-color: #000;border: none;">
   <div class="time text-center d-flex justify-content-center" style="width:100%">
        @if ($gelanggang->waktu != 0)
            <div class="d-flex justify-content-center text-center"><h3 class="fw-bold">{{ sprintf("%02d:%02d", floor($waktu), ($waktu*60)%60) }}</span></div>
        @endif    
    </div>
   <br>
   <div class="body d-flex flex-row" style="width: 100%">
    <div class="sudut-biru text-center" style="width: 25%">
        <div class="lambang-kontingen">
            <img src="{{url('assets/img/ipsi.png')}}" alt="" height="200" width="200">
        </div>
        <div class="sudut">
            <h4 class="fw-bold" style="color: #0053a6">{{$sudut_biru->nama}}</h4>
            <h4 class="fw-bold" style="color: #000">{{$sudut_biru->kontingen}}</h4>
        </div>
        <div class="poin">
            <h1 class="fw-bold" style="color: #0053a6;font-size: 4rem">{{$total_poin_biru}}</h1>
        </div>
    </div>
    <div class="tombol" style="width: 50%">
        <div class="row-1 d-flex flex-row justify-content-between">
            <button wire:click='mulaiPertandingan("mulai pertandingan")' class="mulai" style="background-color: #000; width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Mulai</button>
            <button wire:click='mulaiPertandingan("persiapan")' class="persiapan" style="border:#9BB8CD ;{{$active == "persiapan" ? "background-color: #26e615;" : "background-color: #9BB8CD;"}} width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Persiapan</button>
            <button wire:click='pausePertandingan()' class="stop" style="background-color: #000; width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Stop</button>
        </div>
        <div class="row-2 d-flex flex-row justify-content-center mt-3">
            <button wire:click='gantiBabak(1)' class="mulai" style="border:#9BB8CD ;{{$active == "babak_1" ? "background-color: #26e615;" : "background-color: #9BB8CD;"}} width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Round 1</button>
        </div>
        <div class="row-3 d-flex flex-row justify-content-center  mt-3">
            <button wire:click='gantiBabak(2)' class="mulai" style="border:#9BB8CD ;{{$active == "babak_2" ? "background-color: #26e615;" : "background-color: #9BB8CD;"}} width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Round 2</button>
        </div>
        <div class="row-4 d-flex flex-row justify-content-center  mt-3">
            <button wire:click='gantiBabak(3)' class="mulai" style="border:#9BB8CD ;{{$active == "babak_3" ? "background-color: #26e615;" : "background-color: #9BB8CD;"}} width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Round 3</button>
        </div>
        <div class="row-5 d-flex flex-row justify-content-center  mt-3">
            <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#keputusan-modal" class="keputusan" style="border:#9BB8CD ;{{$active == "hasil" ? "background-color: #26e615;" : "background-color: #9BB8CD;"}} width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Keputusan</button>
        </div>
        <div class="row-6 d-flex flex-row justify-content-between gap-2 mt-3">
            <button class="btn" wire:click='Hapus()' style="background-color: #000; width: 25%;color: #fff;border-radius: 20px;font-size: 1.5rem">Hapus Nilai</button>
            <button {{$total_poin_merah == $total_poin_biru ? "disabled" : ""}} class="btn" wire:click='keputusanMenang("Sudut Biru","Menang Angka")' style="border:none;background-color: #0053a6; width: 25%;color: #fff;border-radius: 20px;font-size: 1.5rem">Biru</button>
            <button {{$total_poin_merah == $total_poin_biru ? "disabled" : ""}} class="btn" wire:click='keputusanMenang("Sudut Merah","Menang Angka")' style="border:none;background-color: #db3545; width: 25%;color: #fff;border-radius: 20px;font-size: 1.5rem">Merah</button>
            <a href="/op/kontrol-tanding" class="btn" style="background-color: #000; width: 25%;color: #fff;border-radius: 20px;font-size: 1.5rem">Next</a>
        </div>
    </div>
    <div class="sudut-merah text-center" style="width: 25%">
        <div class="lambang-kontingen">
            <img src="{{url('assets/img/ipsi.png')}}" alt="" height="200" width="200">
        </div>
        <div class="sudut">
            <h4 class="fw-bold" style="color: #db3545">{{$sudut_merah->nama}}</h4>
            <h4 class="fw-bold" style="color: #000">{{$sudut_merah->kontingen}}</h4>
        </div>
        <div class="poin">
            <h1 class="fw-bold" style="color: #db3545;font-size: 4rem">{{$total_poin_merah}}</h1>
        </div>
    </div>
   </div>
   <div class="footer">

   </div>
   <div wire:ignore.self class="modal fade" id="keputusan-modal" tabindex="-1" aria-labelledby="winnerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="winnerModalLabel">Keputusan Pemenang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="perguruan" class="form-label">Perguruan</label>
          <div class="d-flex justify-content-center text-center" style="width: 100%">
            <div class="p-2 bg-primary text-white" style="width: 40%">{{$sudut_biru->nama}}</div>
            <div class="p-2 bg-light text-dark border" style="width: 10%">VS</div>
            <div class="p-2 bg-danger text-white" style="width: 40%">{{$sudut_merah->nama}}</div>
          </div>
        </div>
        <div class="text-center my-3" style="width: 100%"> 
          <img src="https://via.placeholder.com/100" alt="Team 1" style="width: 40%">
          <span class="mx-3 border" style="width: 10%">VS</span>
          <img src="https://via.placeholder.com/100" alt="Team 2" style="width: 40%">
        </div>
        <div class="d-flex justify-content-center mb-3 text-center">
            <div class="p-2 bg-primary text-white" style="width: 40%">{{$sudut_biru->kontingen}}</div>
            <div class="p-2 bg-light text-dark border" style="width: 10%">VS</div>
            <div class="p-2 bg-danger text-white" style="width: 40%">{{$sudut_merah->kontingen}}</div>
        </div>
        <div class="mb-3">
          <label for="keputusan_pemenang" class="form-label">Keputusan Pemenang</label>
          <select class="form-select" id="keputusan_pemenang" wire:model.change='keputusan_pemenang'>
            <option value="" selected>Pilih Keputusan</option>
            <option value="Menang Teknik">Menang Teknik</option>
            <option value="Diskualifikasi">Diskualifikasi</option>
            <option value="Undur Diri">Undur Diri</option>
            <option value="Menang Mutlak">Menang Mutlak</option>
            <option value="Wasit Telah Menghentikan Pertandingan">Wasit Telah Menghentikan Pertandingan</option>
            </select>
        </div>
        <div class="mb-3">
          <label for="pemenang" class="form-label">{{$pemenang}}</label>
          <select class="form-select" id="pemenang" wire:model.change='pemenang'>
            <option value="" selected>Pilih Sudut</option>
            <option value="Sudut Biru">Sudut Biru</option>
            <option value="Sudut Merah">Sudut Merah</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="catatan" class="form-label">Jika Ada Mendali</label>
          <input type="text" class="form-control" id="catatan" placeholder="Catatan">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" wire:click='keputusanMenang("{{$pemenang}}" , "{{$keputusan_pemenang}}")' data-bs-dismiss="modal">
            Simpan
        </button>
      </div>
    </div>
  </div>
</div>

<div wire:ignore.self class="modal fade" id="error-modal-operator-tanding" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        {{$error}}
      </div>
      <div class="modal-footer">
        <button id="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@section('script')

    <script>
        setInterval(() => {
            if(@this.get('mulai') == true){
                @this.call('kurangiWaktu')
            }
            if(@this.get('error').length > 0){
                    $(`#error-modal-operator-tanding`).modal("show");
                    $('#close').on('click', () => {
                        @this.set('error', "")
                    })
                }
        }, 1000);
    </script>
@endsection
</div>
