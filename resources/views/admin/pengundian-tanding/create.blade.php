@if (auth()->user()->roles_id == 1)
    <form method="POST" action="{{ route('admin.pengundian-tanding.store') }}" enctype="multipart/form-data">
    @elseif (auth()->user()->roles_id == 2)
        <form method="POST" action="{{ route('op.pengundian-tanding.store') }}" enctype="multipart/form-data">
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
        <select name="kelas" id="kelas" class="form-select @error('kelas') is-invalid @enderror">
            <option value="">-- Pilih Kelas Tanding --</option>
            <option value="A">Kelas A</option>
            <option value="B">Kelas B</option>
            <option value="C">Kelas C</option>
            <option value="D">Kelas D</option>
            <option value="E">Kelas E</option>
            <option value="F">Kelas F</option>
            <option value="G">Kelas G</option>
            <option value="H">Kelas H</option>
            <option value="I">Kelas I</option>
            <option value="J">Kelas J</option>
            <option value="K">Kelas K</option>
            <option value="L">Kelas L</option>
            <option value="M">Kelas M</option>
            <option value="N">Kelas N</option>
            <option value="O">Kelas O</option>
            <option value="P">Kelas P</option>
            <option value="Q">Kelas Q</option>
            <option value="R">Kelas R</option>
            <option value="S">Kelas S</option>
            <option value="Open 1">Open 1</option>
            <option value="Open 2">Open 2</option>
        </select>
    </div>
    <div class="form-group ml-2">
        <button type="submit" class="btn btn-primary">Shuffle</button>
    </div>
</div>
</form>
