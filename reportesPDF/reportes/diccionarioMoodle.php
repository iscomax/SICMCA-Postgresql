<?php 
 function getPlantilla(){
 
 $plantilla = ' <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logoUnam.png" width="100px">
      </div>
      <div id="institucion">
        <h2 class="nombre">Universidad Nacional Autónoma de México (UNAM)</h2>
        <div>Circuito exterior s/n, frente a la Facultad de Contaduría y Administración, Ciudad Universitaria, C.P. 04510, Ciudad de México</div>
        <div>Teléfonos: (55) 5622 8502 y (55) 5622 8354</div>
        <div><a href="mailto:contacto.tic@unam.mx">contacto.tic@unam.mx</a></div>
      </div>
      </div>
    </header>
    <main>
        <div id="titulo">
          <h1>Diccionario de datos Moodle</h1>
          <div class="tablaTitulo">Tabla: mdl_course</div>
          <div class="descripcion"> <strong>Descripción: </strong> Esta tabla contiene toda la información de un curso al momento de ser creado, entre sus elementos principales podemos ver el id del curso, que identifica a cada curso de manera única y el campo fullname almacena el nombre de cada curso.</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="filas">Etiqueta</th>
            <th class="filas">Tipo de campo</th>
            <th class="filas">Posición</th>
            <th class="filas">Requerido</th>
            <th class="filas">Propiedades</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="columna1 izquierda">Id</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">1</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Category</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">2</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Sortorder</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">3</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">fullname</td>
            <td class="centrado">Texto corto</td>
            <td class="centrado">4</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 254 caracteres, alfanumérico con caracteres especiales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">shortname</td>
            <td class="columna1 centrado">Texto corto</td>
            <td class="columna1 centrado">5</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 255 caracteres, alfanumérico con caracteres especiales.</td>
          </tr>
            <tr>
            <td class="izquierda">Idnumber</td>
            <td class="centrado">Texto corto</td>
            <td class="centrado">6</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 100 caracteres, alfanumérico con caracteres especiales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Summary</td>
            <td class="columna1 centrado">Texto largo</td>
            <td class="columna1 centrado">7</td>
            <td class="columna1 centrado">No</td>
            <td class="columna1 izquierda">Alfanumérico con caracteres especiales.</td>
          </tr>
            <tr>
            <td class="izquierda">Summaryformat</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">8</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 2 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Format</td>
            <td class="columna1 centrado">Texto corto</td>
            <td class="columna1 centrado">9</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 21 caracteres, alfanumérico con caracteres especiales.</td>
          </tr>
            <tr>
            <td class="izquierda">Showgrades</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">10</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 2 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Newsitems</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">11</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 5 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Startdate</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">12</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Enddate</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">13</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Relativedatesmode</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">14</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 1 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Market</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">15</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Maxbytes</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">16</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
          <tr>
            <td class="columna1 izquierda">Legacyfiles</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">17</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 4 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Showreports</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">18</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 4 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Visible</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">19</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 1 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Visibleold</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">20</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 1 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Downloadcontent</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">21</td>
            <td class="columna1 centrado">No</td>
            <td class="columna1 izquierda">Longitud: 1 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Groupmode</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">22</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 4 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Groupmodeforce</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">23</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 4 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Defaultgroupingid</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">24</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Lang</td>
            <td class="columna1 centrado">Texto corto</td>
            <td class="columna1 centrado">25</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 30 caracteres, alfanumérico con caracteres especiales.</td>
          </tr>
            <tr>
            <td class="izquierda">Calendartype</td>
            <td class="centrado">Texto corto</td>
            <td class="centrado">26</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 30 caracteres, alfanumérico con caracteres especiales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Theme</td>
            <td class="columna1 centrado">Texto corto</td>
            <td class="columna1 centrado">27</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 50 caracteres, alfanumérico con caracteres especiales.</td>
          </tr>
            <tr>
            <td class="izquierda">Timecreated</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">28</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Timemodified</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">29</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Requested</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">30</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 1 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="columna1 izquierda">Enablecompletion</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">31</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 1 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Completionnotify</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">32</td>
            <td class="centrado">Si</td>
            <td class="izquierda">Longitud: 1 dígitos con 0 posiciones decimales.</td>
          </tr>
          <tr>
            <td class="columna1 izquierda">Cacherev</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">33</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Originalcourseid</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">34</td>
            <td class="centrado">No</td>
            <td class="izquierda">Longitud: 10 dígitos con 0 posiciones decimales.</td>
          </tr>
          <tr>
            <td class="columna1 izquierda">Showactivitydates</td>
            <td class="columna1 centrado">Numérico</td>
            <td class="columna1 centrado">35</td>
            <td class="columna1 centrado">Si</td>
            <td class="columna1 izquierda">Longitud: 1 dígitos con 0 posiciones decimales.</td>
          </tr>
            <tr>
            <td class="izquierda">Showcompletionconditions</td>
            <td class="centrado">Numérico</td>
            <td class="centrado">36</td>
            <td class="centrado">No</td>
            <td class="izquierda">Longitud: 1 dígitos con 0 posiciones decimales.</td>
          </tr>
        </tbody>

      </table>
    </main>
  </body>';

  return $plantilla;
}