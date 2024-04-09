@if (auth()->user()->roles_id == 1)
    <form method="POST" action="{{ route('admin.pengundian-tgr.store') }}" enctype="multipart/form-data">
    @elseif (auth()->user()->roles_id == 2)
        <form method="POST" action="{{ route('op.pengundian-tgr.store') }}" enctype="multipart/form-data">
@endif
@csrf
<div class="d-flex justify-content-center align-items-center">
    <div class="form-group ml-0">
        <select name="golongan" id="golongan" class="form-select @error('golongan') is-invalid @enderror" required>
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
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror"
            required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="L">Putra</option>
            <option value="P">Putri</option>
        </select>
    </div>
    <div class="form-group ml-2">
        <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
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

@if (auth()->user()->roles_id == 1)
    <script>
        function shuffleAndSubmit() {
            var golongan = document.getElementById('golongan').value;
            var jenis_kelamin = document.getElementById('jenis_kelamin').value;
            var kategori = document.getElementById('kategori').value;

            // Kirim data filter bersamaan dengan permintaan pengacakan
            fetch('{{ route('admin.pengundian-tanding.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        golongan: golongan,
                        jenis_kelamin: jenis_kelamin,
                        kategori: kategori
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Handle response if needed
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }
    </script>
@elseif (auth()->user()->roles_id == 2)
    <script>
        function shuffleAndSubmit() {
            var golongan = document.getElementById('golongan').value;
            var jenis_kelamin = document.getElementById('jenis_kelamin').value;
            var kategori = document.getElementById('kategori').value;

            // Kirim data filter bersamaan dengan permintaan pengacakan
            fetch('{{ route('op.pengundian-tanding.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        golongan: golongan,
                        jenis_kelamin: jenis_kelamin,
                        kategori: kategori
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Handle response if needed
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }
    </script>
@endif
