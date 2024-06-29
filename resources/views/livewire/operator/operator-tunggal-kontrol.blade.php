    <div>
        
   @php
    if(count($penilaian_tunggal_juri_merah)%2==0){
        $length = count($penilaian_tunggal_juri_merah)/2;
    }else{
        $length = (count($penilaian_tunggal_juri_merah)+1)/2;
    }

    if($penalty_tunggal_merah){
        $penalty_merah = $penalty_tunggal_merah->toleransi_waktu+$penalty_tunggal_merah->keluar_arena+$penalty_tunggal_merah->menyentuh_lantai+$penalty_tunggal_merah->pakaian+$penalty_tunggal_merah->tidak_bergerak;
    }else{
        $penalty_merah = 0;
    }
    $total_merah = 0;
    foreach ($penilaian_tunggal_juri_merah as $penilaian_juri) {
        $total_merah += $penilaian_juri->skor;
    }
    // Mengurutkan array berdasarkan skor
    $sorted_nilai_merah = json_decode($penilaian_tunggal_juri_merah);
    usort($sorted_nilai_merah, function($a, $b) {
        return $a->skor <=> $b->skor;
    });

    // Menghitung median
    $count_merah = count($sorted_nilai_merah);
    if ($count_merah % 2 == 0 && $count_merah !==0) {
        // Jika jumlah data genap, median adalah rata-rata dari dua nilai tengah
        $median_merah = ($sorted_nilai_merah[$count_merah / 2 - 1]->skor + $sorted_nilai_merah[$count_merah / 2]->skor) / 2;
    } else if($count_merah % 2 == 1 && $count_merah !==0) {
        // Jika jumlah data ganjil, median adalah nilai tengah
        $median_merah = $sorted_nilai_merah[floor($count_merah / 2)]->skor;
    }else{
        $median_merah = 0;
    }

    // Menghitung selisih kuadrat dari setiap nilai dengan median
    $total_diff_squared_merah = 0;
    foreach ($penilaian_tunggal_juri_merah as $penilaian_juri) {
        $total_diff_squared_merah += pow($penilaian_juri->skor - $median_merah, 2);
    }

    // Menghitung standar deviasi
    if (count($penilaian_tunggal_juri_merah) !== 0) {
        $standard_deviation_merah = sqrt($total_diff_squared_merah / $count_merah);
    } else {
        $standard_deviation_merah = 0;
    }

    if(count($penilaian_tunggal_juri_biru)%2==0){
        $length = count($penilaian_tunggal_juri_biru)/2;
    }else{
        $length = (count($penilaian_tunggal_juri_biru)+1)/2;
    }
    if($penalty_tunggal_biru){
        $penalty_biru = $penalty_tunggal_biru->toleransi_waktu+$penalty_tunggal_biru->keluar_arena+$penalty_tunggal_biru->menyentuh_lantai+$penalty_tunggal_biru->pakaian+$penalty_tunggal_biru->tidak_bergerak;
    }else{
        $penalty_biru = 0;
    }
    $total_biru = 0;
    foreach ($penilaian_tunggal_juri_biru as $penilaian_juri) {
        $total_biru += $penilaian_juri->skor;
    }
    // Mengurutkan array berdasarkan skor
    $sorted_nilai_biru = json_decode($penilaian_tunggal_juri_biru);
    usort($sorted_nilai_biru, function($a, $b) {
        return $a->skor <=> $b->skor;
    });

    // Menghitung median
    $count_biru = count($sorted_nilai_biru);
    if ($count_biru % 2 == 0 && $count_biru !==0) {
        // Jika jumlah data genap, median adalah rata-rata dari dua nilai tengah
        $median_biru = ($sorted_nilai_biru[$count_biru / 2 - 1]->skor + $sorted_nilai_biru[$count_biru / 2]->skor) / 2;
    } else if($count_biru % 2 == 1 && $count_biru !==0) {
        // Jika jumlah data ganjil, median adalah nilai tengah
        $median_biru = $sorted_nilai_biru[floor($count_biru / 2)]->skor;
    }else{
        $median_biru = 0;
    }

    // Menghitung selisih kuadrat dari setiap nilai dengan median
    $total_diff_squared_biru = 0;
    foreach ($penilaian_tunggal_juri_biru as $penilaian_juri) {
        $total_diff_squared_biru += pow($penilaian_juri->skor - $median_biru, 2);
    }

    // Menghitung standar deviasi
    if (count($penilaian_tunggal_juri_biru) !== 0) {
        $standard_deviation_biru = sqrt($total_diff_squared_biru / $count_biru);
    } else {
        $standard_deviation_biru = 0;
    }

@endphp
    @section('title')
        kontrol-tunggal
    @endsection
    @section('style')
       @vite('resources/js/layout.js') 
    @endsection
   <div id="jadwal" data-id="{{ $jadwal_tunggal->id }}" gelanggang-id={{$gelanggang->id}} class="d-flex justify-content-between align-items-center p-2">
    <a {{$user->roles_id != 1 ? "href=/op/kontrol-tgr" : "href=/admin/kontrol-tgr"}} class="btn" style="border: none;">
        <i class="fa-solid fa-arrow-left bg-dark p-3" style="color: white; font-size: 2rem;"></i>
    </a>
    <h4 class="fw-bold text-center flex-grow-1 m-0" >
        BABAK {{$jadwal_tunggal->babak}} {{$jadwal_tunggal->class}} {{$sudut_biru->kelas}} {{$sudut_biru->golongan}} {{$sudut_biru->jenis_kelamin == 'L' ? "Laki-Laki" : "Perempuan"}}
        <br/>
        {{$gelanggang->nama}} Partai {{$jadwal_tunggal->partai}}
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
            <img src="{{ $sudut_biru->img == null ? url('/assets/profile/default.webp') : url('/assets/img/'.$sudut_biru->img) }}" height="200" width="200">
        </div>
        <div class="sudut">
            <h4 class="fw-bold" style="color: #0053a6">{{$sudut_biru->nama}}</h4>
            <h4 class="fw-bold" style="color: #000">{{$sudut_biru->kontingen}}</h4>
        </div>
        <div class="poin">
            <h1 class="fw-bold" style="color: #0053a6;font-size: 4rem">{{number_format($median_biru - $penalty_biru * 0.5,3)}}</h1>
        </div>
    </div>
    <div class="tombol" style="width: 50%">
        <div class="row-1 d-flex flex-row justify-content-between">
            <button wire:click='gantiTahap("tampil",{{$jadwal_tunggal->TampilTGR->id == $sudut_merah->id ? "'merah'" : "'biru'" }},"")' class="mulai" style="background-color: #000; width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Mulai</button>
            <button wire:click='gantiTahap("tampil nilai" ,{{$jadwal_tunggal->TampilTGR->id == $sudut_merah->id ? "'merah'" : "'biru'" }},"")' class="nilai" style="background-color: #000; width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Tampil Nilai</button>
            <button wire:click='gantiTahap("pause",{{$jadwal_tunggal->TampilTGR->id == $sudut_merah->id ? "'merah'" : "'biru'" }},"")' class="stop" style="background-color: #000; width: 30%;color: #fff;border-radius: 20px;font-size: 2rem">Stop</button>
        </div>
        <div class="row-2 d-flex flex-row justify-content-center mt-3">
            <button wire:click='gantiTahap("persiapan",{{$jadwal_tunggal->TampilTGR->id == $sudut_merah->id ? "'merah'" : "'biru'" }},"")' class="mulai" style="border:#9BB8CD ;{{$active == "persiapan" ? "background-color: #26e615;" : "background-color: #9BB8CD;"}} width: 50%;color: #fff;border-radius: 20px;font-size: 2rem">Persiapan</button>
        </div>
        <div class="row-3 d-flex flex-row justify-content-center  mt-3">
            <button wire:click='gantiTampil("biru")' class="mulai" style="border:#9BB8CD ;{{$active == "sudutbiru" ? "background-color: #26e615;" : "background-color: #9BB8CD;"}} width: 50%;color: #fff;border-radius: 20px;font-size: 2rem">Penampilan Sudut Biru</button>
        </div>
        <div class="row-4 d-flex flex-row justify-content-center  mt-3">
            <button wire:click='gantiTampil("merah")' class="mulai" style="border:#9BB8CD ;{{$active == "sudutmerah" ? "background-color: #26e615;" : "background-color: #9BB8CD;"}} width: 50%;color: #fff;border-radius: 20px;font-size: 2rem">Penampilan Sudut Merah</button>
        </div>
        <div class="row-5 d-flex flex-row justify-content-center  mt-3">
            <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#keputusan-modal" class="keputusan" style="border:#9BB8CD ;{{$active == "keputusan" ? "background-color: #26e615;" : "background-color: #9BB8CD;"}} width: 50%;color: #fff;border-radius: 20px;font-size: 2rem">Keputusan</button>
        </div>
        <div class="row-6 d-flex flex-row justify-content-between gap-2 mt-3">
            <button class="btn" wire:click='hapus()' style="background-color: #000; width: 25%;color: #fff;border-radius: 20px;font-size: 1.5rem">Hapus Nilai</button>
            <button {{$total_merah == $total_biru ? "disabled" : ""}} class="btn" wire:click='gantiTahap("keputusan","biru","Menang Angka")' style="border:none;background-color: #0053a6; width: 25%;color: #fff;border-radius: 20px;font-size: 1.5rem">Biru</button>
            <button {{$total_merah == $total_biru ? "disabled" : ""}} class="btn" wire:click='gantiTahap("keputusan","merah","Menang Angka")' style="border:none;background-color: #db3545; width: 25%;color: #fff;border-radius: 20px;font-size: 1.5rem">Merah</button>
            <button wire:click='nextPartai()' class="btn" style="background-color: #000; width: 25%;color: #fff;border-radius: 20px;font-size: 1.5rem">Next</button>
        </div>
    </div>
    <div class="sudut-merah text-center" style="width: 25%">
        <div class="lambang-kontingen">
            <img src="{{ $sudut_merah->img == null ? url('/assets/profile/default.webp') : url('/assets/img/'.$sudut_merah->img) }}" height="200" width="200">
        </div>
        <div class="sudut">
            <h4 class="fw-bold" style="color: #db3545">{{$sudut_merah->nama}}</h4>
            <h4 class="fw-bold" style="color: #000">{{$sudut_merah->kontingen}}</h4>
        </div>
        <div class="poin">
            <h1 class="fw-bold" style="color: #db3545;font-size: 4rem">{{number_format($median_merah - $penalty_merah * 0.5,3)}}</h1>
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
        <div class="d-flex justify-content-center mb-3 text-center">
            <div class="p-2 bg-primary text-white" style="width: 40%">{{$sudut_biru->kontingen}}</div>
            <div class="p-2 text-dark" style="width: 10%"> </div>
            <div class="p-2 bg-danger text-white" style="width: 40%">{{$sudut_merah->kontingen}}</div>
        </div>
        <div class="mb-3">
          <label for="keputusanPemenang" class="form-label">Keputusan Pemenang</label>
          <select class="form-select" id="keputusanPemenang" wire:model.change='keputusan_pemenang'>
            <option value="" selected>Pilih Keputusan</option>
            <option value="Menang Teknik">Menang Teknik</option>
            <option value="Diskualifikasi">Diskualifikasi</option>
            <option value="Undur Diri">Undur Diri</option>
            <option value="Menang Mutlak">Menang Mutlak</option>
            <option value="Wasit Telah Menghentikan Pertandingan">Wasit Telah Menghentikan Pertandingan</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="pemenang" class="form-label">Pemenang</label>
          <select class="form-select" id="pemenang" wire:model.change='pemenang'>
            <option value="" selected>Pilih Sudut</option>
            <option value="merah">Sudut Merah</option>
            <option value="biru">Sudut Biru</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="catatan" class="form-label">Jika Ada Mendali</label>
          <input type="text" class="form-control" id="catatan" placeholder="Catatan">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" wire:click='gantiTahap("keputusan", "{{$pemenang}}","{{$keputusan_pemenang}}")' data-bs-dismiss="modal">Simpan</button>
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
        }, 1600);
    </script>
@endsection
</div>
