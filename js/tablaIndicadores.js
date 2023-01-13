$(document).ready(function() {
    var tablaInd=$('#tablaIndicador').DataTable({
        responsive: true,// Tabla responsiva
        dom: 'BRflrtpi',// Posicionamiento de los componentes de la interfaz

        "language": {
           buttons: {
               colvis: 'Mostrar columnas',
               className: 'btn btn-secondary'
           },
         "lengthMenu": "Mostrar" + 
                        `<select>
                        <option value='10'>10</option>
                        <option value='25'>25</option>
                        <option value='100'>100</option>
                        <option value='200'>200</option>
                        </select>` +
                        "registros por página",
         "zeroRecords": "Nada encontrado - disculpa",
         "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
         "infoEmpty": "No hay registros",
         "infoFiltered": "(filtrado de _MAX_ registros totales)",
         "loadingRecords": "Cargando...",
         "processing": "Procesando...",
         'search': 'Buscar: ',
         'paginate': {
              'next':'Siguiente',
              'previous':'Anterior'
         }

        },

       /* "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            //traducimos los componentes al idioma español
       
    },*/
    buttons:{//invocación de los botones exportar PDF, Excel e imprimir
         dom: {
              button:{
                   className: 'btn'
              }
         },
         buttons:[ 
          {
              extend: "excel",
              text:'Exportar a Excel',
              titleAttr: 'Exportar a Excel',
              className:'btn btn-outline-success m-3 rounded',
              messageTop: 'Deserción',
              title: 'Universidad Nacional Autónoma de México ',
              exportOptions: {
                  columns:':visible'
                   //columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8] 
              },
              excelStyles: {                      // Add an excelStyles definition
               cells: "1",                     // adonde se aplicaran los estilos (fila 2)
               style: {                        // estilos de bloque
                   font: {                     // estilos de letra
                       name: "Arial",          // tipo de letra
                       size: "16",             // tamaño de letra
                       color: "FFFFFF",        // Color
                       b: true,               // negrita SI
                   },
                   fill: {                     // Estilo de relleno (background)
                       pattern: {              // tipo de rellero (pattern or gradient)
                           color: "1C3D6C",    // color de fondo de la fila
                       }
                   }
               }
           }
          },

          {
               extend:    'pdfHtml5',
               text:      'Exportar a PDF',
               titleAttr: 'Exportar a PDF',
               className: 'btn btn-outline-danger m-3 rounded',
               messageTop: 'Deserción',
               title: 'Universidad Nacional Autónoma de México ',
               download: 'open',
               orientation: 'landscape',
               pageSize: 'LEGAL',
               exportOptions: { 
                columns:':visible'//columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8] 
               },
          },
          {
               extend:    'print',
               text:      'Imprimir',
               titleAttr: 'Imprimir',
               className: 'btn btn-outline-secondary m-3 rounded',
               messageTop: 'Deserción',
               title: 'Universidad Nacional Autónoma de México ',
               exportOptions: { 
                   columns:':visible' 
              },
          },
          {
           extend:  'colvis',
           text:    'Columnas Visibles',
           titleAttr: 'Agregar/Eliminar Columnas',
           className:'btn btn-outline-primary m-3 rounded',
        }
     ]
    },      
});
  // Creamos el gráfico con los datos iniciales    
  var grafica = $('#grafica');

  var chart = Highcharts.chart(grafica[0], {
      chart: {
          type: 'pie',
      },//tipo de gráfica
      title: {
          text: 'Roles',
      },
      //colors:['#1C140A', '#E4D6A3'],
      xAxis:{
          title:{
              text:'Rol de Usuario',
              name:'Usuario'
          }
      },
      yAxis:{
          title:{
              text:'Cantidad'
          }
      },

      legend: {
       enabled: false
   },
    lang: {
        viewFullscreen:"Ver en pantalla completa",
        printChart:"Imprimir",
        downloadPNG:"Descarga PNG",
        downloadJPEG:"Descarga JPEG",
        downloadPDF:"Descarga PDF",
        downloadSVG:"Descarga SVG",       
        downloadCSV:"Descarga CSV",
        downloadXLS:"Descarga XLS",
        viewData:"Ver tabla de datos",
        hideData: "Ocultar tabla de datos" 
    },
    tooltip: {
        headerFormat: 'Nombre',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
        'Alumnos en Riesgo: <b>{point.y}</b><br/>'
    },

   plotOptions: {
       series: {
           borderWidth: 0,
           dataLabels: {
               enabled: true
           }
       }
   },
      series: [{
          name: 'Total',
          dataSorting: {
            enabled: true},  
          colorByPoint: true,
          data: chartData(tablaInd)//llamada a los datos almacenados
      }]

  });

//función chartData
function chartData(tablaInd) {
    var filasAfectadas = {};//inicializacion de la variable para el conteo de las filas afectadas
    tablaInd.column(1, {
        search: 'applied'}).data().each(function(val) {
        if (filasAfectadas[val]) {
            filasAfectadas[val] += 1;
        } else {
            filasAfectadas[val] = 1;
        }
    });

    return $.map(filasAfectadas, function(cantidad, tipoUsuario) {
        console.log("tipoUsuario: "+tipoUsuario+" cantidad: "+cantidad);
        return {
            name: tipoUsuario,
            y: cantidad,
        };

    });
}
});





