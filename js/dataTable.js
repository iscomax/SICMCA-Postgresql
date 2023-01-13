$(document).ready(function() {
  $('#loadTable').DataTable({
        responsive: true,
        dom: 'Bfrtilp',
        //muestra los paneles de filtrado de la tabla 
        //dom:'Pfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },


        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="bi bi-file-earmark-excel-fill"></i>',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="bi bi-file-earmark-pdf-fill"></i>',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-primary'
            },
            {
                extend: 'print',
                text: '<i class="bi bi-printer-fill"></i>',
                titleAttr: 'Imprimir',
                className: 'btn btn-info'
            },

        ]
    })

});

/*************************************************************************/
