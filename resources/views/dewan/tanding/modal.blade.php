<!-- Modal -->
<div class="modal fade" id="jatuhan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Jatuhan Juri</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-verif" >Minta Verifikasi Jatuhan Juri</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pelanggaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Pelanggaran Juri</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-verif" >Minta Verifikasi Pelanggaran Juri</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@section('script')
<script>
    let verif = 0
    $('.btn-verif').on('click',()=>{
        verif += 1;
        if(verif == 1){
            $('.modal-body').append(`<p>JURI 1 : {{$juri_1}}</p>
        <p>JURI 2 : {{$juri_2}}</p>
        <p>JURI 3 : {{$juri_3}}</p>
        <p>Dibuat saat : {{date('Y-m-d H:i:s')}}</p>`)
        }
    })
    $('.btn-jatuhan-a').on('click',()=>{
        $('.jatuhan-1-a').append('3')
    })
     $('.btn-jatuhan-b').on('click',()=>{
        $('.jatuhan-1-b').append('3')
    })
        
</script>
@endsection