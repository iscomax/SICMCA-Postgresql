$(document).ready(function () {
    const tablaGrupo = $('#cursosProfesor').DataTable({
        responsive: true,
        dom: 'Bfrtilp',
        //muestra los paneles de filtrado de la tabla 
        //dom:'Pfrtip',
        columnDefs: [
            {
                searchPanes: {
                    show: true,
                },
                targets: [4],
            },
            {
                searchPanes: {
                    show: false,
                },
                targets: [0, 1, 2, 3, 5],
            },
            { "width": "90px", "targets": 7 }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            searchPanes: {

                collapse: '<i class="bi bi-funnel-fill"></i>',
                clearMessage: 'Limpiar Todo',
                cascadePanes: true,
                viewTotal: true,
                layout: 'columns-6',
                title: {
                    _: 'Filtros seleccionados - %d',

                },
            }
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
        {
            extend: 'searchPanes',
            titleAttr: 'Filtrar',
            className: 'btn btn-warning',
            config: {

                cascadePanes: true
            }
        },

        ]
    })
//cambiar el nombre de los arreglos 
    const dataArray = [],
        grupoArray = [],
        pendientesArray = [],
        calificadosArray = [];


    tablaGrupo.rows({ search: "applied" }).every(function () {
        const data = this.data();
        grupoArray.push(data[4]);
        pendientesArray.push(parseInt(data[5].replace(/\,/g, "")));
        calificadosArray.push(parseInt(data[6].replace(/\,/g, "")));
    });


    dataArray.push(grupoArray, pendientesArray, calificadosArray);
    //se imprime arreglo en consola
    dataArray.forEach(function (elemento, indice, array) {
        console.log(elemento, indice);
    })


    // Creamos el gráfico con los datos iniciales    
    var container = $('#contenedor');

    Highcharts.chart(container[0], {
        chart: {
            //column, pie
            type: 'column',
        },
        title: {
            text: 'Estatus Calificaciones',
        },
        xAxis: {
            title: {
                text: 'Grupos'
            },
            categories: dataArray[0]
        },
        yAxis: {
            title: {
                text: 'Número de Alumnos'
            },
        },
        /* plotOptions:{
            series:{
                pointStart:6
            }
        },  */
        series: [
            {
                name: "Pendientes por Calificar",
                color: "#FF404E",
                type: "column",
                data: dataArray[1],
                /*  tooltip: {
                   valueSuffix: " M"
                 } */
            },
            {
                name: "Calificados",
                color: "#0071A7",
                type: "column",
                data: dataArray[2],

            },

        ],

    });



});

