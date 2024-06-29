<div>
    @section('style')
        @vite('resources/js/layout.js')
        @vite('resources/js/tanding.js')
        <style>
            .btn-custom {
                border-radius: 10px;
                width: 100%;
                margin: 0;
                /* Menghapus margin default */
            }

            .btn-primary {
                background-color: #0053a6;
            }

            .btn-danger {
                background-color: #db3545;
            }

            .flex-container {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                /* Jarak antara tombol */
            }

            .p-1 {
                padding: 0.5rem !important;
            }
        </style>
    @endsection
    @section('title', 'Tanding')
    <div id="jadwal" data-id="{{ $jadwal->id }}" gelanggang-id={{ $gelanggang->id }} class="p-3 "
        style="
        position: relative;
    ">
        <div class="row justify-content-md-between ml-2 mr-2 mt-2">
            <div class=" col-md-3 text-center">
                <h5 class="fw-bold text-white  p-3 rounded kontingen"
                    style="background-color: #0053a6; margin-left: 14px">{{ $sudut_biru->nama }},
                    {{ $sudut_merah->kontingen }}</h5>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <h3 class="fw-bold">{{ $user->permissions }} {{ $gelanggang->nama }}</h3>
            </div>
            <div class="col-md-3 text-center">
                <h5 class="fw-bold p-3 bg-danger rounded text-white kontingen" style="margin-right: 2px">
                    {{ $sudut_merah->nama }}, {{ $sudut_biru->kontingen }}</h5>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-center ml-2 mr-2 row" style="width:100%; margin-top: -24px">
            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <h4 class="fw-bold text-center"></h4>
                    <button id="fullscreen-btn"
                        class="btn btn-primary border d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px;">
                        <i class="fa-solid fa-expand"></i>
                    </button>
                </div>
            </div>

        </div>
        <div class="row ml-1" style="margin-top: 0px !important; width:100%">
            <div class="row mt-1" style=" width:100%">
                <div class="col">
                    <table class="table table-bordered" style="border: 2px solid #000">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center text-white tabel-head mw-40"
                                    style="background-color: #0053a6;border: 2px solid #000; width:40%">
                                    Nilai
                                </th>
                                <th scope="col" class="text-center mw-20" style="border: 2px solid #000; width:20%">
                                    Babak
                                </th>
                                <th scope="col" class="bg-danger text-center text-white tabel-head mw-40"
                                    style="
                                    border: 2px solid #000;
                                    width:40%
                                ">
                                    Nilai
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border: 2px solid #000">
                                <td class="tabel-1-1 fw-bold fs-5 text-right" style="border: 2px solid #000">
                                    <h5 class="fw-bold p-1">
                                        @foreach ($penilaian_tanding_biru as $penilaian)
                                            @if ($penilaian->babak == 1)
                                                {{ $penilaian->$juri }}
                                            @endif
                                        @endforeach
                                    </h5>
                                </td>
                                <td class="text-center babak-1 {{ $jadwal->babak_tanding == 1 ? 'babak-active' : '' }}"
                                    style="border: 2px solid #000; height: 60px">
                                    <img src={{ url('/assets/svg/romawi-1.svg') }} alt="">
                                </td>
                                <td class="tabel-1-2 fw-bold fs-5 " style="border: 2px solid #000">
                                    <h5 class="fw-bold p-1">
                                        @foreach ($penilaian_tanding_merah as $penilaian)
                                            @if ($penilaian->babak == 1)
                                                {{ $penilaian->$juri }}
                                            @endif
                                        @endforeach
                                    </h5>
                                </td>
                            </tr>
                            <tr style="border: 2px solid #000">
                                <td class="tabel-2-1 fw-bold fs-5 text-right" style="border: 2px solid #000">
                                    @foreach ($penilaian_tanding_biru as $penilaian)
                                        @if ($penilaian->babak == 2)
                                            {{ $penilaian->$juri }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center babak-2 {{ $jadwal->babak_tanding == 2 ? 'babak-active' : '' }}"
                                    style="border: 2px solid #000; height: 60px">
                                    <img src={{ url('/assets/svg/romawi-2.svg') }} alt="">
                                </td>
                                <td class="tabel-2-2 fw-bold fs-5" style="border: 2px solid #000">
                                    @foreach ($penilaian_tanding_merah as $penilaian)
                                        @if ($penilaian->babak == 2)
                                            {{ $penilaian->$juri }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr style="border: 2px solid #000">
                                <td class="tabel-3-1 fw-bold fs-5 text-right" style="border: 2px solid #000">
                                    @foreach ($penilaian_tanding_biru as $penilaian)
                                        @if ($penilaian->babak == 3)
                                            {{ $penilaian->$juri }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center babak-3 {{ $jadwal->babak_tanding == 3 ? 'babak-active' : '' }}"
                                    style="border: 2px solid #000; height: 60px">
                                    <img src={{ url('/assets/svg/romawi-3.svg') }} alt="">
                                </td>
                                <td class="tabel-3-2 fw-bold fs-5" style="border: 2px solid #000">
                                    @foreach ($penilaian_tanding_merah as $penilaian)
                                        @if ($penilaian->babak == 3)
                                            {{ $penilaian->$juri }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Kolom Sudut Biru -->
            <div class="col-md-6">
                <div class="d-flex gap-1">
                    <div class="d-flex flex-column" style="width: 50%">
                        <div class="mb-2">
                            <button wire:click="tambahPukulanTrigger({{ $sudut_biru->id }})"
                                class="btn btn-primary text-white btn-custom" style="height: 70px;">
                                Pukulan
                            </button>
                        </div>
                        <div class="mb-2">
                            <button wire:click="tambahTendanganTrigger({{ $sudut_biru->id }})"
                                class="btn btn-primary text-white btn-custom" style="height: 70px;">
                                Tendangan
                            </button>
                        </div>
                    </div>
                    <div class="mb-2 text-right" style="width: 50%">
                        <button wire:click="hapusTrigger({{ $sudut_biru->id }})"
                            class="btn btn-primary text-white btn-custom" style="height: 150px;">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>

            <!-- Kolom Sudut Merah -->
            <div class="col-md-6">
                <div class="d-flex gap-1">
                    <div class="mb-2 text-right" style="width: 50%">
                        <button wire:click="hapusTrigger({{ $sudut_merah->id }})"
                            class="btn btn-danger text-white btn-custom" style="height: 150px;">
                            Hapus
                        </button>
                    </div>
                    <div class="d-flex flex-column" style="width: 50%">
                        <div class="mb-2">
                            <button wire:click="tambahPukulanTrigger({{ $sudut_merah->id }})"
                                class="btn btn-danger text-white btn-custom" style="height: 70px;">
                                Pukulan
                            </button>
                        </div>
                        <div>
                            <button wire:click="tambahTendanganTrigger({{ $sudut_merah->id }})"
                                class="btn btn-danger text-white btn-custom" style="height: 70px;">
                                Tendangan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('juri.tanding.JuriVerivikasiModal')
    @include('juri.tanding.ErrorModal')
</div>


@section('script')
    <script>
        setInterval(() => {
            if (@this.get('error').length > 0) {
                $(`#error-modal-${@this.get('juri')}`).modal("show");
                $('#close').on('click', () => {
                    @this.set('error', "")
                })
            }
            @this.call('batasSkorMasukCek')
        }, 2000);

        // Ambil tombol fullscreen
        const fullscreenButton = document.getElementById('fullscreen-btn');
        const fullscreenIcon = fullscreenButton.querySelector('i');

        // Tambahkan event listener untuk tombol
        fullscreenButton.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                // Masuk ke mode fullscreen
                document.documentElement.requestFullscreen().then(() => {
                    fullscreenIcon.classList.remove('fa-expand');
                    fullscreenIcon.classList.add('fa-compress');
                }).catch((err) => {
                    console.error(
                        `Error attempting to enable fullscreen mode: ${err.message} (${err.name})`);
                });
            } else {
                // Keluar dari mode fullscreen
                if (document.exitFullscreen) {
                    document.exitFullscreen().then(() => {
                        fullscreenIcon.classList.remove('fa-compress');
                        fullscreenIcon.classList.add('fa-expand');
                    }).catch((err) => {
                        console.error(
                            `Error attempting to exit fullscreen mode: ${err.message} (${err.name})`);
                    });
                }
            }
        });
    </script>
@endsection
