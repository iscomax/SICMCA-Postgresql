$(document).ready(function () {
    var tablaGrupo = $('#cursosCoordinador').DataTable({
        responsive: true,
        dom: 'Bfrtilp',
        //muestra los paneles de filtrado de la tabla 
        //dom:'Pfrtip',
        columnDefs: [
            {
                searchPanes: {
                    show: true,
                },
                targets: [1, 2],
            },
            {
                searchPanes: {
                    show: false,
                },
                targets: [0, 1, 3, 4, 5],
            },
            { "width": "90px", "targets": 6 }
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

    const dataArray = [],
        facultadArray = [],
        carreraArray = [],
        cursoArray = [];

    tablaGrupo.rows({ search: "applied" }).every(function () {
        const data = this.data();
        facultadArray.push(data[1]);
        carreraArray.push(data[2]);
        cursoArray.push(data[4]);
    });


    dataArray.push(facultadArray, carreraArray, cursoArray);
    //se imprime arreglo en consola
    dataArray.forEach(function (elemento, indice, array) {
        //console.log(elemento, indice);
    })



   
    // En cada seleccion de filtro, actualiza los datos en el gráfico.
    tablaGrupo.on('draw', function () {
        chart.series[0].setData(chartData(tablaGrupo));
        //$('#example').DataTable().searchPanes.rebuildPane(0, true);


    });
    //funcion chartData
    function chartData(tablaGrupo) {
        var filasAfectadas = {};
        // Contamos el número de entradas para cada puesto (Puesto) 
        // columna 1 = [0=nombre, 1=puesto, 2=pais]
        tablaGrupo.column(2, {
            search: 'applied'
        }).data().each(function (val) {
            if (filasAfectadas[val]) {
                filasAfectadas[val] += 1;
            } else {
                filasAfectadas[val] = 1;
            }
        });

        // Y mapeamos al formato que usa highcharts
        //usamos la funcion $map de jquery 
        //$.map(array, function(value, index){});

        return $.map(filasAfectadas, function (cantidad, clave) {
            console.log(filasAfectadas); //nos muestra la cantidad filas seleccionadas
            //console.log("clave: "+clave+" cantidad: "+cantidad);
            return {
                name: clave,
                y: cantidad,
            };

        });
    }

    
    
     // Creamos el gráfico con los datos iniciales    
     var container = $('#contenedor');
     var chart = Highcharts.chart(container[0], {

         chart: {
             type: 'column',
         },
         title: {
             text: 'Número de Cursos por Carrera',
         },
         xAxis: {
             title: {
                 text: 'Cursos'
             },
    
            /* categories: info =chartData(tablaGrupo), */ 
                
             
 
         },
         yAxis: {
             title: {
                 text: 'Número de Cursos'
             },
         },
         /*  plotOptions:{
               series:{
                   pointStart:5
               }
       
           },  */
         series: [{
             name: 'Número de Cursos',
             data: chartData(tablaGrupo),
 
         },]
 
     });


});