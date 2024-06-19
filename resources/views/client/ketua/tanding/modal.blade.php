  <div wire:ignore.self class="modal fade" id="keputusan-ketua" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    @php
        $teguran_1_merah = 0;
        $teguran_2_merah = 0;
        $peringatan_1_merah = 0;
        $peringatan_2_merah = 0;
        $jatuhan_merah = 0;
        $banyak_pukulan_merah = 0;
        $banyak_tendangan_merah = 0;

        $teguran_1_biru = 0;
        $teguran_2_biru = 0;
        $peringatan_1_biru = 0;
        $peringatan_2_biru = 0;
        $jatuhan_biru = 0;
        $banyak_pukulan_biru = 0;
        $banyak_tendangan_biru = 0;

        foreach ($poin_merah->where('status','sah') as $poin) {
            switch ($poin->jenis) {
                case 'jatuhan':
                    $jatuhan_merah += 1;
                    break;
                case 'teguran':
                    if ($poin->dewan == -1) {
                        $teguran_1_merah += 1;
                    }else{
                        $teguran_2_merah += 1;
                    }
                    break;
                case 'peringatan':
                    if ($poin->dewan == -5) {
                        $peringatan_1_merah += 1;
                    }else{
                        $peringatan_2_merah += 1;
                    }
                    break;
                case 'pukulan':
                    $banyak_pukulan_merah += 1;
                    break;
                case 'tendangan':
                    $banyak_tendangan_merah += 1;
                    break;
            }
        }
        
        foreach ($poin_biru->where('status','sah') as $poin) {
            switch ($poin->jenis) {
                case 'jatuhan':
                    $jatuhan_biru += 1;
                    break;
                case 'teguran':
                    if ($poin->dewan == -1) {
                        $teguran_1_biru += 1;
                    }else{
                        $teguran_2_biru += 1;
                    }
                    break;
                case 'peringatan':
                    if ($poin->dewan == -5) {
                        $peringatan_1_biru += 1;
                    }else{
                        $peringatan_2_biru += 1;
                    }
                    break;
                case 'pukulan':
                    $banyak_pukulan_biru += 1;
                    break;
                case 'tendangan':
                    $banyak_tendangan_biru += 1;
                    break;
            }
        }
    @endphp
    <div class="modal-dialog" style="max-width: 50vw !important; margin:0 auto !important">
      <div class="modal-content" style="width: 50vw !important">
        <div class="modal-body text-end" style=" ">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-content-body border border-dark">
                <div class="modal-body-header text-center">
                    <h5 class="fw-bold">Pertandingan Ini Dimenangkan Oleh Pesilat dari Sudut</h5>
                    @if($jadwal->pemenang == $pengundian_merah->id)
                    <h5 class="fw-bold" style="color: #db3545">Merah</h5>
                    @else
                        <h5 class="fw-bold" style="color: #252c94">Biru</h5>
                    @endif
                </div>
                <div class="modal-body-content d-flex gap-1 m-1 pr-2" style="width: 100%">
                    <div class="corner d-flex flex-column gap-1" style="width: 12.5%">
                        <div class="corner-header text-center border border-dark p-1">
                            <h6 class="fw-bold h6-responsive">Corner</h6>
                        </div>
                        <div class="corner-body text-center">
                            <div class="merah p-1 mb-1" style="background-color: #db3545">
                                <h6 class="fw-bold text-white h6-responsive">Merah</h6>
                            </div>
                            <div class="biru p-1 text-center" style="background-color: #375cbf">
                                <h6 class="fw-bold text-white h6-responsive">Biru</h6>
                            </div>
                        </div>
                    </div>
                    <div class="peringatan-2 d-flex flex-column gap-1" style="width: 12.5%">
                        <div class="peringatan-2-header text-center border border-dark p-1">
                            <h6 class="fw-bold h6-responsive">Peringatan 2</h6>
                        </div>
                        <div class="peringatan-2-body text-center">
                            <div class="merah p-1 mb-1" style="background-color: #db3545">
                                <h6 class="fw-bold text-white h6-responsive">{{$peringatan_2_merah}}</h6>
                            </div>
                            <div class="biru p-1 text-center" style="background-color: #375cbf">
                                <h6 class="fw-bold text-white h6-responsive">{{$peringatan_2_biru}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="peringatan-1 d-flex flex-column gap-1" style="width: 12.5%">
                        <div class="peringatan-1-header text-center border border-dark p-1">
                            <h6 class="fw-bold h6-responsive">Peringatan 1</h6>
                        </div>
                        <div class="peringatan-1-body text-center">
                            <div class="merah p-1 mb-1" style="background-color: #db3545">
                                <h6 class="fw-bold text-white h6-responsive">{{$peringatan_1_merah}}</h6>
                            </div>
                            <div class="biru p-1 text-center" style="background-color: #375cbf">
                                <h6 class="fw-bold text-white h6-responsive">{{$peringatan_1_biru}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="teguran-2 d-flex flex-column gap-1" style="width: 12.5%">
                        <div class="teguran-2-header text-center border border-dark p-1">
                            <h6 class="fw-bold h6-responsive">Teguran 2</h6>
                        </div>
                        <div class="teguran-2-body text-center">
                            <div class="merah p-1 mb-1" style="background-color: #db3545">
                                <h6 class="fw-bold text-white h6-responsive">{{$teguran_2_merah}}</h6>
                            </div>
                            <div class="biru p-1 text-center" style="background-color: #375cbf">
                                <h6 class="fw-bold text-white h6-responsive">{{$teguran_2_biru}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="teguran-1 d-flex flex-column gap-1" style="width: 12.5%">
                        <div class="teguran-1-header text-center border border-dark p-1">
                            <h6 class="fw-bold h6-responsive">Teguran 1</h6>
                        </div>
                        <div class="teguran-1-body text-center">
                            <div class="merah p-1 mb-1" style="background-color: #db3545">
                                <h6 class="fw-bold text-white h6-responsive" >{{$teguran_1_merah}}</h6>
                            </div>
                            <div class="biru p-1 text-center" style="background-color: #375cbf">
                                <h6 class="fw-bold text-white h6-responsive">{{$teguran_1_biru}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="jatuhan d-flex flex-column gap-1" style="width: 12.5%">
                        <div class="jatuhan-header text-center border border-dark p-1">
                            <h6 class="fw-bold h6-responsive">Jatuhan</h6>
                        </div>
                        <div class="jatuhan-body text-center">
                            <div class="merah p-1 mb-1" style="background-color: #db3545">
                                <h6 class="fw-bold text-white h6-responsive">{{$jatuhan_merah}}</h6>
                            </div>
                            <div class="biru p-1 text-center" style="background-color: #375cbf">
                                <h6 class="fw-bold text-white h6-responsive">{{$jatuhan_biru}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="tendangan d-flex flex-column gap-1" style="width: 12.5%">
                        <div class="tendangan-header text-center border border-dark p-1">
                            <h6 class="fw-bold h6-responsive">Tendangan</h6>
                        </div>
                        <div class="tendangan-body text-center">
                            <div class="merah p-1 mb-1" style="background-color: #db3545">
                                <h6 class="fw-bold text-white h6-responsive">{{$banyak_tendangan_merah}}</h6>
                            </div>
                            <div class="biru p-1 text-center" style="background-color: #375cbf">
                                <h6 class="fw-bold text-white h6-responsive">{{$banyak_tendangan_biru}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="pukulan d-flex flex-column gap-1" style="width: 12.5%">
                        <div class="pukulan-header text-center border border-dark p-1">
                            <h6 class="fw-bold h6-responsive">Pukulan</h6>
                        </div>
                        <div class="pukulan-body text-center">
                            <div class="merah p-1 mb-1" style="background-color: #db3545">
                                <h6 class="fw-bold text-white h6-responsive">{{$banyak_pukulan_merah}}</h6>
                            </div>
                            <div class="biru p-1 text-center" style="background-color: #375cbf">
                                <h6 class="fw-bold text-white h6-responsive">{{$banyak_pukulan_merah}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body-footer p-1 d-flex gap-1" style="width: 100%">
                    <div class="poin-kemenangan border border-dark text-center d-flex justify-content-center " style="width:50%">
                        <h5 class="fw-bold mt-2">Poin Kemenangan</h5>
                    </div>
                    <div class="hasil p-1 border border-dark text-center d-flex justify-content-center " style="width: 50%">
                        <div class="hasil-merah border border-dark" style="width:40%">
                            <h2 class="fw-bold" style="color: #db3545">{{$total_poin_merah}}</h2>
                        </div>
                        <div class="strip border border-dark" style="width:20%">
                            <h2 class="fw-bold">-</h2>
                        </div>
                        <div class="hasil-biru border border-dark" style="width:40%">
                            <h2 class="fw-bold" style="color: #252c94">{{$total_poin_biru}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  