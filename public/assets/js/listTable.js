
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#dataTable').DataTable({
        dom: 'Blfrtip',
        buttons: [
            { extend: 'excel', className: 'btn btn-primary' },
            { extend: 'pdf', className: 'btn btn-primary' },
            { extend: 'print', className: 'btn btn-primary' }
        ]
    });

    // Event listener for PDF button
    $('.pdf-btn').on('click', function() {
        table.button('.buttons-pdf').trigger();
    });

    // Event listener for Excel button
    $('.excel-btn').on('click', function() {
        table.button('.buttons-excel').trigger();
    });

    // Event listener for Print button
    $('.print-btn').on('click', function() {
        window.print();
    });
});
