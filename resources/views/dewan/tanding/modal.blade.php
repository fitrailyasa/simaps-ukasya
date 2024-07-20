<!-- Modal -->
<div wire:ignore.self class="modal" id="jatuhan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ffeccf;">
                <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Jatuhan Juri</h5>
            </div>
            <div class="modal-body d-flex justify-content-center">
                @if ($verifikasi_jatuhan)
                    @foreach ($juri as $jjuri)
                        <div class="px-3">
                            <h3>{{ $jjuri['name'] }}</h3>
                            @if ($verifikasi_jatuhan_data[$jjuri['name']] == 'biru')
                                <h3 class="bg-primary text-white text-center p-2">
                                    {{ $verifikasi_jatuhan_data[$jjuri['name']] }}</h3>
                            @elseif($verifikasi_jatuhan_data[$jjuri['name']] == 'merah')
                                <h3 class="bg-danger text-white text-center p-2">
                                    {{ $verifikasi_jatuhan_data[$jjuri['name']] }}</h3>
                            @elseif($verifikasi_jatuhan_data[$jjuri['name']] == 'invalid')
                                <h3 class="bg-warning text-white text-center p-2">
                                    {{ $verifikasi_jatuhan_data[$jjuri['name']] }}</h3>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="d-flex justify-content-center pb-2">
                <button wire:click='VerifikasiJatuhanTrigger' type="button"
                    class="btn btn-secondary btn-verif">Verifikasi</button>
            </div>
            <div class="d-flex justify-content-center pb-2">
                <button wire:click='tutupVerifikasiJatuhan' type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div wire:ignore.self class="modal" id="pelanggaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ffeccf;">
                <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Pelanggaran Juri</h5>
            </div>
            <div class="modal-body d-flex justify-content-center">
                @if ($verifikasi_pelanggaran)
                    @foreach ($juri as $jjuri)
                        <div class="px-3">
                            <h3>{{ $jjuri['name'] }}</h3>
                            @if ($verifikasi_pelanggaran_data[$jjuri['name']] == 'biru')
                                <h3 class="bg-primary text-white text-center p-2">
                                    {{ $verifikasi_pelanggaran_data[$jjuri['name']] }}
                                </h3>
                            @elseif($verifikasi_pelanggaran_data[$jjuri['name']] == 'merah')
                                <h3 class="bg-danger text-white text-center p-2">
                                    {{ $verifikasi_pelanggaran_data[$jjuri['name']] }}</h3>
                            @elseif($verifikasi_pelanggaran_data[$jjuri['name']] == 'invalid')
                                <h3 class="bg-warning text-white text-center p-2">
                                    {{ $verifikasi_pelanggaran_data[$jjuri['name']] }}
                                </h3>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="d-flex justify-content-center pb-2">
                <button wire:click='VerifikasiPelanggaranTrigger' type="button"
                    class="btn btn-secondary btn-verif">Verifikasi</button>
            </div>
            <div class="d-flex justify-content-center pb-2">
                <button wire:click='tutupVerifikasiPelanggaran' type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
