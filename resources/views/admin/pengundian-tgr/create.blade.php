<form method="POST" action="{{ route('admin.pengundian-tgr.store') }}" enctype="multipart/form-data">
    @csrf
    <button type="submit" class="btn btn-primary">Shuffle</button>
</form>
