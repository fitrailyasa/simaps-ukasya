@if (auth()->user()->roles_id == 1)
    <form method="POST" action="{{ route('admin.pengundian-tgr.store') }}" enctype="multipart/form-data">
    @elseif (auth()->user()->roles_id == 2)
        <form method="POST" action="{{ route('op.pengundian-tgr.store') }}" enctype="multipart/form-data">
@endif
@csrf
<div class="d-flex justify-content-center align-items-center">
    <div class="form-group ml-0">
        <select name="golongan" id="golongan" class="form-select @error('golongan') is-invalid @enderror">
            <option value="">-- Pilih Golongan --</option>
            <option value="Usia Dini 1">Usia Dini 1</option>
            <option value="Usia Dini 2">Usia Dini 2</option>
            <option value="Pra Remaja">Pra Remaja</option>
            <option value="Remaja">Remaja</option>
            <option value="Dewasa">Dewasa</option>
            <option value="Master">Master</option>
        </select>
    </div>
    <div class="form-group ml-2">
        <select name="jenis_kelamin" id="jenis_kelamin"
            class="form-select @error('jenis_kelamin') is-invalid @enderror">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="L">Putra</option>
            <option value="P">Putri</option>
        </select>
    </div>
    <div class="form-group ml-2">
        <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
            <option value="">-- Pilih Kategori --</option>
            <option value="Tunggal">Tunggal</option>
            <option value="Ganda">Ganda</option>
            <option value="Regu">Regu</option>
            <option value="Solo Kreatif">Solo Kreatif</option>
        </select>
    </div>
    <div class="form-group ml-2">
        <button type="submit" class="btn btn-primary">Shuffle</button>
    </div>
</div>
</form>
