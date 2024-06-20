<div>
    @section('title')
    Jadwal TGR
    @endsection
    @section('table-kontrol-tgr')
    active
    @endsection
    @section('tgr')
    menu-open
    @endsection
    <style>
        .dataTables_filter {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            }
            </style>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4>Kelola Data Jadwal TGR</h4>
                    <div class="d-flex justify-content-end mb-3">
                        @yield('formCreate')
                        @yield('formUpload')
                        @yield('formDeleteAll')
                    </div>
                </div>

                @if (session('sukses'))
                    <div class="alert alert-success" role="alert">
                        {{ session('sukses') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Partai</th>
                    <th>Gelanggang</th>
                    <th>Babak</th>
                    <th>Kelompok</th>
                    <th>Sudut Biru</th>
                    <th>Sudut Merah</th>
                    <th>Pemenang</th>
                    <th>Skor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($jadwaltgrs as $jadwaltgr)
                        @if (auth()->user()->Gelanggang->id == $jadwaltgr->Gelanggang->id && $gelanggang_operator->jenis == $jadwaltgr->jenis)
                            @php
                        $waitingPartaiMerah = $jadwaltgrs
                            ->where('next_sudut', 2)
                            ->where('next_partai', $jadwaltgr->partai)
                            ->first();
                        $waitingPartaiBiru = $jadwaltgrs
                            ->where('next_sudut', 1)
                            ->where('next_partai', $jadwaltgr->partai)
                            ->first();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwaltgr->partai ?? '-' }}</td>
                        <td>{{ $jadwaltgr->Gelanggang->nama ?? '-' }}</td>
                        <td>{{ $jadwaltgr->babak ?? '-' }}</td>
                        <td>
                            {{ $jadwaltgr->PengundianTGRBiru->TGR->kategori ?? ($waitingPartaiBiru->PengundianTGRBiru->TGR->kategori ?? '-') }}
                            {{ $jadwaltgr->PengundianTGRBiru->TGR->jenis_kelamin ?? ($waitingPartaiBiru->PengundianTGRBiru->TGR->jenis_kelamin ?? '-') }}
                            {{ $jadwaltgr->PengundianTGRBiru->TGR->golongan ?? ($waitingPartaiBiru->PengundianTGRBiru->TGR->golongan ?? '-') }}
                        </td>
                        <td class="bg-primary">
                            @if ($jadwaltgr->sudut_biru)
                                <b>{{ $jadwaltgr->PengundianTGRBiru->TGR->nama ?? '-' }}
                                    ({{ $jadwaltgr->PengundianTGRBiru->TGR->kontingen ?? '-' }})
                                </b><br>({{ $jadwaltgr->status_biru ?? 'Belum Ditimbang Ulang' }})
                            @else
                                Pemenang Partai ke-{{ $waitingPartaiBiru ? $waitingPartaiBiru->partai : '1' }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if ($jadwaltgr->sudut_merah)
                                <b>{{ $jadwaltgr->PengundianTGRMerah->TGR->nama ?? '-' }}
                                    ({{ $jadwaltgr->PengundianTGRMerah->TGR->kontingen ?? '-' }})
                                </b><br>({{ $jadwaltgr->status_merah ?? 'Belum Ditimbang Ulang' }})
                            @else
                                Pemenang Partai ke-{{ $waitingPartaiMerah ? $waitingPartaiMerah->partai : '1' }}
                            @endif
                        </td>
                        <td>{{ $jadwaltgr->PemenangTgr->TGR->nama ?? '' }}
                            ({{ $jadwaltgr->PemenangTgr->TGR->kontingen ?? 'Belum Bertanding' }})
                        </td>
                        <td>{{ $jadwaltgr->skor_biru ?? '0' }} -
                            {{ $jadwaltgr->skor_merah ?? '0' }}</td>
                                <td class="manage-row">
                                    @if ($gelanggang_operator->Jadwal_TGR && $jadwaltgr->partai == $gelanggang_operator->Jadwal_TGR->partai  && ($jadwaltgr->tahap == 'persiapan' || $jadwaltgr->tahap == "tampil") && $gelanggang_operator->jenis !== "Tanding")
                                        @switch($jadwaltgr->jenis)
                                            @case("Tunggal")
                                                <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tgr/tunggal/{{$jadwaltgr->id}}">
                                                    <i class="fa fa-tv"></i>
                                                </a>
                                                @break
                                            @case("Ganda")
                                                <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tgr/ganda/{{$jadwaltgr->id}}">
                                                    <i class="fa fa-tv"></i>
                                                </a>
                                                @break
                                            @case("Regu")
                                                <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tgr/regu/{{$jadwaltgr->id}}">
                                                    <i class="fa fa-tv"></i>
                                                </a>
                                                @break
                                            @case("Solo Kreatif")
                                                <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tgr/solo/{{$jadwaltgr->id}}">
                                                    <i class="fa fa-tv"></i>
                                                </a>
                                                @break
                                            @default
                                                
                                        @endswitch
                                        <form method="POST" action="stop-tgr/{{$jadwaltgr->id}}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-danger">
                                                <i class=" fa fa-stop"></i>
                                            </button>
                                        </form>
                                    @elseif($jadwaltgr->tahap == "menunggu")
                                        <form method="POST" action="ubah-tgr/{{$jadwaltgr->id}}/{{$jadwaltgr->jenis}}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-primary mr-2">
                                                <i class=" fa fa-play"></i>
                                            </button>
                                        </form>
                                    @else
                                    <form method="POST" action="reset-tgr/{{$jadwaltgr->id}}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-primary mr-2">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Partai</th>
                    <th>Gelanggang</th>
                    <th>Babak</th>
                    <th>Kelompok</th>
                    <th>Sudut Biru</th>
                    <th>Sudut Merah</th>
                    <th>Pemenang</th>
                    <th>Skor</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        @section('script')
            <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "paging": false,
                    "buttons": [{
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i> Excel',
                            className: 'btn btn-dark mb-3',
                            exportOptions: {
                                columns: [':not(:last-child)']
                            },
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                            className: 'btn btn-dark mb-3',
                            exportOptions: {
                                columns: [':not(:last-child)']
                            },
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> Print',
                            className: 'btn btn-dark mb-3',
                            exportOptions: {
                                columns: [':not(:last-child)']
                            },
                        }
                    ]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        @endsection
</div>
