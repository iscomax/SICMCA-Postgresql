$(document).ready(function() {
    var tablaAdm=$('#tablaAdministrador').DataTable({
        responsive: true,// Tabla responsiva
        dom: 'lBRfrtpi',// Posicionamiento de los componentes de la interfaz

        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            //traducimos los componentes al idioma español
       
    },
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
              messageTop: 'Lista de Usuarios',
              title: 'Universidad Nacional Autónoma de México ',
              exportOptions: { 
                   columns: [ 0, 1, 2, 3] 
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
               messageTop: 'Lista Usuarios',
               title: 'Universidad Nacional Autónoma de México ',
               download: 'open',
               exportOptions: { 
                   columns: [ 0, 1, 2, 3] 
               },
          },
          {
               extend:    'print',
               text:      'Imprimir',
               titleAttr: 'Imprimir',
               className: 'btn btn-outline-secondary m-3 rounded',
               messageTop: 'Lista Usuarios',
               title: 'Universidad Nacional Autónoma de México ',
               exportOptions: { 
                   columns: [ 0, 1, 2, 3] 
               },
          }
     ]
    },      
});
  // Creamos el gráfico con los datos iniciales    
  var grafica = $('#grafica');
  Highcharts.setOptions({
   colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
     return {
       radialGradient: {
         cx: 0.5,
         cy: 0.3,
         r: 0.7
       },
       stops: [
         [0, color],
         [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
       ]
     };
   })
 });

  var chart = Highcharts.chart(grafica[0], {
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
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
       headerFormat: 'Tipo de Usuario',
       pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
         'Cantidad: <b>{point.y}</b><br/>' 
     },

   plotOptions: {
       pie: {
           allowPointSelect: true,
           cursor: 'pointer',
           dataLabels: {
             enabled: true,
             format: '<b>{point.name}</b>: {point.percentage:.1f} %',
             connectorColor: 'silver'
           }
       }
   },
      series: [{
          name: 'Total de Usuario',  
          dataSorting: {
            enabled: true},
          colorByPoint: true,
          data: chartData(tablaAdm)//llamada a los datos almacenados
      }]

  });

//función chartData
function chartData(tablaAdm) {
    var filasAfectadas = {};//inicializacion de la variable para el conteo de las filas afectadas
    tablaAdm.column(2, {
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





