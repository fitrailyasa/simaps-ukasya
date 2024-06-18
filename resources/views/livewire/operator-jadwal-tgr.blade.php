<div>
    
    

    @section('script')
        <script>
            setInterval(() => {
                console.log(window.Livewire.find('gKD8SoX2R3fsGz0VY1e9'));
            }, 1000);
        </script>
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
