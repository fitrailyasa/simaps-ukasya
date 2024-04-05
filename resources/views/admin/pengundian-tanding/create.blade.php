@if (auth()->user()->roles_id == 1)
    <form method="POST" action="{{ route('admin.pengundian-tanding.store') }}" enctype="multipart/form-data">
    @elseif (auth()->user()->roles_id == 2)
        <form method="POST" action="{{ route('op.pengundian-tanding.store') }}" enctype="multipart/form-data">
@endif
@csrf
<button type="submit" class="btn btn-primary">Shuffle</button>
</form>
