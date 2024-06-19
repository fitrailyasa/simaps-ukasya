<div>
    @section('title')
    Jadwal Tanding
    @endsection
    @section('table-kontrol-tanding')
    active
    @endsection
    @section('tanding')
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
                    @foreach ($jadwaltandings as $jadwaltanding)
                        @if (auth()->user()->Gelanggang->jenis == $jadwaltanding->Gelanggang->jenis)
                        @php
                            $waitingPartaiMerah = $jadwaltandings
                                ->where('next_sudut', 2)
                                ->where('next_partai', $jadwaltanding->partai)
                                ->first();
                            $waitingPartaiBiru = $jadwaltandings
                                ->where('next_sudut', 1)
                                ->where('next_partai', $jadwaltanding->partai)
                                ->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwaltanding->partai ?? '-' }}</td>
                            <td>{{ $jadwaltanding->Gelanggang->nama ?? '-' }}</td>
                            <td>{{ $jadwaltanding->babak ?? '-' }}</td>
                            <td>
                                {{ $jadwaltanding->PengundianTandingBiru->Tanding->kelas ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->kelas ?? '-') }}
                                {{ $jadwaltanding->PengundianTandingBiru->Tanding->jenis_kelamin ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->jenis_kelamin ?? '-') }}
                                {{ $jadwaltanding->PengundianTandingBiru->Tanding->golongan ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->golongan ?? '-') }}
                            </td>
                            <td class="bg-primary">
                                @if ($jadwaltanding->sudut_biru)
                                    <b>{{ $jadwaltanding->PengundianTandingBiru->Tanding->nama ?? '-' }}
                                        ({{ $jadwaltanding->PengundianTandingBiru->Tanding->kontingen ?? '-' }})
                                    </b><br>({{ $jadwaltanding->status_biru ?? 'Belum Ditimbang Ulang' }})
                                @else
                                    Pemenang Partai ke-{{ $waitingPartaiBiru ? $waitingPartaiBiru->partai : '1' }}
                                @endif
                            </td>
                            <td class="bg-danger">
                                @if ($jadwaltanding->sudut_merah)
                                    <b>{{ $jadwaltanding->PengundianTandingMerah->Tanding->nama ?? '-' }}
                                        ({{ $jadwaltanding->PengundianTandingMerah->Tanding->kontingen ?? '-' }})
                                    </b><br>({{ $jadwaltanding->status_merah ?? 'Belum Ditimbang Ulang' }})
                                @else
                                    Pemenang Partai ke-{{ $waitingPartaiMerah ? $waitingPartaiMerah->partai : '1' }}
                                @endif
                            </td>
                            <td>{{ $jadwaltanding->PemenangTanding->Tanding->nama ?? '' }}
                                ({{ $jadwaltanding->PemenangTanding->Tanding->kontingen ?? 'Belum Bertanding' }})
                            </td>
                            <td>{{ $jadwaltanding->skor_biru ?? '0' }} -
                                {{ $jadwaltanding->skor_merah ?? '0' }}</td>
                            <td class="manage-row justify-content-center d-flex flex-row">
                                @if ($gelanggang_operator->Jadwal_Tanding && $jadwaltanding->partai == $gelanggang_operator->Jadwal_Tanding->partai &&  ($jadwaltanding->tahap == "persiapan" || $jadwaltanding->tahap == "tanding" )  && $gelanggang_operator->jenis == "Tanding")
                                    <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tanding/{{$jadwaltanding->id}}">
                                        <i class="fa fa-tv"></i>
                                    </a>
                                    <form method="POST" action="stop/{{$jadwaltanding->id}}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-danger">
                                            <i class=" fa fa-stop"></i>
                                        </button>
                                    </form>
                                @elseif ($jadwaltanding->tahap == "menunggu")
                                    <form method="POST" action="ubah/{{$jadwaltanding->id}}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-primary mr-2">
                                            <i class="fa fa-play"></i>
                                        </button>
                                    </form>
                                    @else
                                    <form method="POST" action="reset/{{$jadwaltanding->id}}" style="display:inline;">
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
