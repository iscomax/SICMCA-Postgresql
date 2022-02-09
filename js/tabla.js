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
               className:'btn btn-outline-success m-3 rounded'
           },
           {
                extend:    'pdfHtml5',
                text:      'Exportar a PDF',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-outline-danger m-3 rounded'
           },
           {
                extend:    'print',
                text:      'Imprimir',
                titleAttr: 'Imprimir',
                className: 'btn btn-outline-secondary m-3 rounded'
           },
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

    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },
       series: [{
           name: 'Total de Usuario',  
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



