<!-- Modal -->
<div wire:ignore.self class="modal" id="jatuhan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Jatuhan Juri</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       @if ($verifikasi_jatuhan && $verifikasi_jatuhan['juri'] && $verifikasi_jatuhan['verifikasi_jatuhan']['status'] == 1)   
          @foreach ($verifikasi_jatuhan['juri'] as $juri)
              <div class="juri">
                {{$juri['name']}} : {{$verifikasi_jatuhan_data[$juri['name']]}}
              </div>
          @endforeach
          <div class="date">
            <p>dibuat saat: {{$created_at}}</p>
          </div>
       @endif
      </div>
      <div class="modal-footer">
        <button wire:click='VerifikasiJatuhanTrigger' type="button" class="btn btn-danger btn-verif" >Minta Verifikasi Jatuhan Juri</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div  wire:ignore.self class="modal" id="pelanggaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Pelanggaran Juri</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if ($verifikasi_pelanggaran && $verifikasi_pelanggaran['juri'] && $verifikasi_pelanggaran['verifikasi_pelanggaran']['status'] == 1)   
          @foreach ($verifikasi_pelanggaran['juri'] as $juri)
              <div class="juri">
                {{$juri['name']}} : {{$verifikasi_pelanggaran_data[$juri['name']]}}
              </div>
          @endforeach
          <div class="date">
            <p>dibuat saat: {{$created_at}}</p>
          </div>
       @endif
      </div>
      <div class="modal-footer">
        <button wire:click='VerifikasiPelanggaranTrigger' type="button" class="btn btn-danger btn-verif" >Minta Verifikasi Pelanggaran Juri</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>