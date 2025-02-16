$(document).ready(function () {
    $('.datatable').DataTable({
        "paging": true,       // Enable pagination
        "ordering": true,     // Enable column sorting
        "info": true,         // Show table info
        "searching": true,    // Enable search
        "lengthMenu": [10, 25, 50, 100],
        "language": {
            "search": "Search:"
        },
    });
});
