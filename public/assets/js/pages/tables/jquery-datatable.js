$(function () {
    $('.js-basic-example').DataTable();

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        pageLength: 50,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});