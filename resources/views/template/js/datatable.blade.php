<script type="text/javascript" src="{{ asset('templates/vali-admin/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('templates/vali-admin/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    let DataTable = (selector) => {
        let datatable = $(selector).DataTable({
            "language": {
                "lengthMenu": "Menampilkan _MENU_ data",
                "zeroRecords": "Data tidak tersedia",
                "info": "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data",
                "infoEmpty": "Data tidak ditemukan",
                "infoFiltered": "(Terfilter dari total _MAX_ data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "previous": "<",
                    "next": ">",
                },
                "processing": "Memproses data..."
            },
            // "fnDrawCallback": configFnDrawCallback,
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Semua"]],
            "pageLength": 25,
            columnDefs: [
                {orderable: false, targets: 0},
                {orderable: false, targets: -1},
            ],
            order: []
        });
        return datatable;
    }
</script>