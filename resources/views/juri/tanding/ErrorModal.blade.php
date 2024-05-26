<div wire:ignore.self class="modal fade" id="error-modal-{{$juri}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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