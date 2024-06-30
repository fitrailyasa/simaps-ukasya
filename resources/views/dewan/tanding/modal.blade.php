<!-- Modal -->
<div wire:ignore.self class="modal" id="jatuhan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Jatuhan Juri</h5>
      </div>
      <div class="modal-body">
       @if ($verifikasi_jatuhan)   
          @foreach ($juri as $jjuri)
              <div class="juri">
                {{$jjuri['name']}} : {{$verifikasi_jatuhan_data[$jjuri['name']]}}
              </div>
          @endforeach
          <div class="date">
            <p>dibuat saat: {{$created_at}}</p>
          </div>
       @endif
      </div>
      <div class="modal-footer">
        <button wire:click='VerifikasiJatuhanTrigger' type="button" class="btn btn-secondary btn-verif" >Minta Verifikasi Jatuhan Juri</button>
        <button wire:click='tutupVerifikasiJatuhan' type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
      </div>
      <div class="modal-body">
       @if ($verifikasi_pelanggaran)   
          @foreach ($juri as $jjuri)
              <div class="juri">
                {{$jjuri['name']}} : {{$verifikasi_pelanggaran_data[$jjuri['name']]}}
              </div>
          @endforeach
          <div class="date">
            <p>dibuat saat: {{$created_at}}</p>
          </div>
       @endif
      </div>
      <div class="modal-footer">
        <button wire:click='VerifikasiPelanggaranTrigger' type="button" class="btn btn-secondary btn-verif" >Minta Verifikasi Pelanggaran Juri</button>
        <button wire:click='tutupVerifikasiPelanggaran' type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>