<?php 

class conexion{
     private $server;
     private $user; 
     private $password;
     private $database;
     private $port;
     private $conexion;

    function __construct()
    {
        $listaDatos= $this-> datosConexion();
        foreach ($listaDatos as $key => $value) {
           $this-> server = $value['server'];
           $this-> user = $value['user'];
           $this-> password = $value['password'];
           $this-> database = $value['database'];
           $this-> port = $value['port'];
        }
       
        $this->conexion = new PDO("pgsql:host=".$this->server.";port=".$this-> port.";dbname=".$this-> database,$this-> user,$this-> password) 
        or die('No se ha podido conectar: ' . pg_last_error());
        

    }//fin constructor

     private function datosConexion(){
         $direccion= dirname(__FILE__);
         //abre un arhivo y guarda la informacion
         $jsonDatos= file_get_contents($direccion . "/". "config");
         return json_decode($jsonDatos, true);
     }//Fin datos conexión
     
    public function obtenerDatos($qry){
         $result =  $this->conexion ->query($qry);      
        $datos= $result->fetchAll();
        if ($datos) 
            return $datos;
        else
            return false;
    }//Fin obtener datos

    public function nonQuery($qry){
        $result =   $this->conexion ->query($qry);
        return $this->conexion ->affected_rows;
    }//fin nonQuery

    public function guardar($qry){
        $result =   $this->conexion ->query($qry);
        $filas= $this->conexion ->affected_rows;
        if ($filas>=1) 
            return $this->conexion ->insert_id;
        else
            return 0;
    } //Fin guardar

    public function buscarDatos($qry)
    {
       $result =  $this->conexion ->query($qry);
        $datos= $result->fetch();
        if ($datos) 
            return $datos;
        else
            return false;       
    }//fin buscar datos

    //metodo de encriptar
    protected function encriptar($string)
    {
        return md5($string);

    }//fin encriptar

    public function crearVista($qry, $id_grupo)
    {
        $select = "SELECT count(*) from lista where id ='$id_grupo';";
        $result =  $this->conexion ->query($select);
        $resultArray= $result->fetch();
      
        foreach ($resultArray as $key) 
            $numero= $key;

        return $numero;
    }//fin crear vista

    public function alumnosGrupo($qry)
    {
        $result =  $this->conexion ->query($qry);
        $resultArray= $result->fetch();
        foreach ($resultArray as $key)
            $numero= $key;
        return $numero;
    }//Fin Alumno grupo

    public function riesgoDesercion(){
        $qry = "SELECT c.shortname,c.fullname,  g.name AS Groupname, u.username, u.idnumber, u.lastname, u.firstname
        , round((SELECT finalgrade
                FROM mdl_grade_grades
                INNER JOIN mdl_grade_items
                ON mdl_grade_items.id=mdl_grade_grades.itemid
                WHERE mdl_grade_items.itemtype = 'course'
                AND mdl_grade_items.courseid = c.id
                AND mdl_grade_grades.userid=u.id),2) AS calificacion
        ,round(gi.grademax, 2) as maxcalificacion, email
        ,to_char(date(to_timestamp(timeaccess)),'YYYY-MM-DD') as ultimo_acceso
        --,timeaccess as ultimo_acceso
        --,'--' as diferencia
        ,NOW() - to_timestamp(timeaccess) as diferencia,
        u.id AS id_usuario
        FROM mdl_course AS c
        JOIN mdl_groups AS g ON g.courseid = c.id
        JOIN mdl_groups_members AS m ON g.id = m.groupid
        JOIN mdl_user AS u ON m.userid = u.id
        INNER JOIN mdl_grade_items as gi ON gi.courseid = c.id AND gi.itemtype = 'course'
        left join mdl_user_lastaccess acceso on (u.id=acceso.userid and acceso.courseid=c.id)
        WHERE (round((SELECT finalgrade
                FROM mdl_grade_grades
                INNER JOIN mdl_grade_items
                ON mdl_grade_items.id=mdl_grade_grades.itemid
                WHERE mdl_grade_items.itemtype = 'course'
                AND mdl_grade_items.courseid = c.id
                AND mdl_grade_grades.userid=u.id),2))<=4
        order by fullname, groupname, lastname, firstname;";    
         $filas =  $filas = $this->conexion->query($qry)->fetchAll();
         if ($filas >= 1) 
             return  $filas;
         else 
             return 0;
    }//riesgoDeserción

    public function usuarioReporte(){
        $qry = "SELECT c.shortname,c.fullname,  g.name AS Groupname, u.username, u.idnumber, u.lastname, u.firstname
        , round((SELECT finalgrade
                FROM mdl_grade_grades
                INNER JOIN mdl_grade_items
                ON mdl_grade_items.id=mdl_grade_grades.itemid
                WHERE mdl_grade_items.itemtype = 'course'
                AND mdl_grade_items.courseid = c.id
                AND mdl_grade_grades.userid=u.id),2) AS calificacion
        ,round(gi.grademax, 2) as maxcalificacion, email
        ,to_char(date(to_timestamp(timeaccess)),'YYYY-MM-DD') as ultimo_acceso
        --,timeaccess as ultimo_acceso
        --,'--' as diferencia
        ,NOW() - to_timestamp(timeaccess) as diferencia,
        u.id AS id_usuario
        FROM mdl_course AS c
        JOIN mdl_groups AS g ON g.courseid = c.id
        JOIN mdl_groups_members AS m ON g.id = m.groupid
        JOIN mdl_user AS u ON m.userid = u.id
        INNER JOIN mdl_grade_items as gi ON gi.courseid = c.id AND gi.itemtype = 'course'
        left join mdl_user_lastaccess acceso on (u.id=acceso.userid and acceso.courseid=c.id)
        order by fullname, groupname, lastname, firstname;";    
         $filas =  $filas = $this->conexion->query($qry)->fetchAll();
         if ($filas >= 1) 
             return  $filas;
         else 
             return 0;
    }//finusuarioReporte

    public function validarUsuarioCorreo($correo)
    {
        if($correo="" or $correo < 0)
            return 0;
        $qry = "select * from mdl_user where email= '$correo';";
        $filas = $this->conexion->query($qry)->rowCount();
        if ($filas >= 1)
            return  $filas;
         else 
            return $qry;
    } //fin validar Usuario correo

    public function obtenerBitacora($id){
        $qry = "select curso.fullname, bitacora.eventname,        
        CASE action
        WHEN 'removed' THEN 'removido'
        WHEN 'loggedout' THEN 'Desconectado'
        WHEN 'assigned' THEN 'Asignado'
        WHEN 'updated' THEN 'Actualizado'
        WHEN 'deleted' THEN 'Eliminado'
        WHEN 'loggedin' THEN 'Conectado'
        WHEN 'submitted' THEN 'Presentado'
        WHEN 'send' THEN 'enviado'
        WHEN 'added' THEN 'Agregado'
        WHEN 'viewed' THEN 'Visto'
        WHEN 'shown' THEN 'Mostrado'
        WHEN 'failed' THEN 'Fallido'
        WHEN 'uploaded' THEN 'Subido'
        WHEN 'ended' THEN 'Terminado'
        WHEN 'unassigned' THEN 'No Asignado'
        WHEN 'graded' THEN 'Calificado'
        WHEN 'started' THEN 'Comenzó'
        WHEN 'created' THEN 'Creado'
        END action_m, 
        to_char(date(to_timestamp(bitacora.timecreated)),'YYYY/MM/DD HH24:MI:SS:MS') as fechaCreacion,
        bitacora.ip, crud as permiso, 
        CASE crud
	   WHEN 'c' THEN 'Creado'
	   WHEN 'r' THEN 'Leido'
       WHEN 'u' THEN 'Actualizado'
       WHEN 'd' THEN 'Eliminado'
       END permiso,
        bitacora.id
        from mdl_logstore_standard_log bitacora
        join mdl_course curso on(bitacora.courseid=curso.id)
        where userid=$id
        order by bitacora.timecreated desc;";
    
         $filas =  $filas = $this->conexion->query($qry)->fetchAll();
         if ($filas >= 1) 
             return  $filas;
         else 
             return 0;
         }//fin obtener bitácora

         public function actividadesEntregadas($id){
            $qry ="SELECT c.id, c.shortname as NombreCorto, c.fullname as NombreLargo, css.section as numSemana, css.id, css.name as nombreSemana
            , (select count(module) from mdl_course_sections cs
                  inner join mdl_course_modules cm on (cm.section = cs.id)
                  inner join mdl_modules m on(m.id=cm.module)
                  where cs.course = c.id and m.id=1 and cs.id=css.id and cs.section>0 and cs.visible=1
            group by(cs.id)) as Tareas
            ,(select
            count(gg.id) as count_cal
            from mdl_course_modules cm
            join mdl_course_sections cs on (cs.id=cm.section and cs.visible=1)
            join mdl_modules m on (m.id=cm.module)
            join mdl_grade_items gi on (gi.iteminstance = cm.instance and gi.itemmodule=m.name)
            left join mdl_grade_grades gg on (gg.itemid=gi.id)
            where cm.course=c.id and cm.module in (1) and cs.section >0 and usermodified is null
            and cs.section =css.section
            group by cm.module
            ) as SinCalificarTareas
            , (select count(module) from mdl_course_sections cs
                  inner join mdl_course_modules cm on (cm.section = cs.id)
                  inner join mdl_modules m on(m.id=cm.module)
                  where cs.course = c.id and m.id=9 and cs.id=css.id and cs.section>0 and cs.visible=1
            group by(cs.id)) as Foros
            ,(select
            count(gg.id) as count_cal
            from mdl_course_modules cm
            join mdl_course_sections cs on (cs.id=cm.section and cs.visible=1)
            join mdl_modules m on (m.id=cm.module)
            join mdl_grade_items gi on (gi.iteminstance = cm.instance and gi.itemmodule=m.name)
            left join mdl_grade_grades gg on (gg.itemid=gi.id)
            where cm.course=c.id and cm.module in (9) and cs.section >0 and usermodified is null
            and cs.section =css.section
            group by cm.module
            ) as SinCalificarForos
            , (select count(module) from mdl_course_sections cs
                  inner join mdl_course_modules cm on (cm.section = cs.id)
                  inner join mdl_modules m on(m.id=cm.module)
                  where cs.course = c.id and m.id=17 and cs.id=css.id and cs.section>0 and cs.visible=1
            group by(cs.id)) as Examen
            ,(select
            count(gg.id) as count_cal
            from mdl_course_modules cm
            join mdl_course_sections cs on (cs.id=cm.section and cs.visible=1)
            join mdl_modules m on (m.id=cm.module)
            join mdl_grade_items gi on (gi.iteminstance = cm.instance and gi.itemmodule=m.name)
            left join mdl_grade_grades gg on (gg.itemid=gi.id)
            where cm.course=c.id and cm.module in (17) and cs.section >0 and usermodified is null
            and cs.section =css.section
            group by cm.module
            ) as SinCalificarExamen
            , (select count(module) from mdl_course_sections cs
                  inner join mdl_course_modules cm on (cm.section = cs.id)
                  inner join mdl_modules m on(m.id=cm.module)
                  where cs.course = c.id and m.id not in (13, 1,9,17) and cs.id=css.id and cs.section>0 and cs.visible=1
            group by(cs.id)) as totalRecursos
            
            
            from mdl_course c
            inner join mdl_course_sections css on (css.course=c.id)
            where
            -- c.id=4 and
            c.id>1 and
            css.section>0 and css.visible=1
            order by c.id, css.id;";
                     $filas =  $filas = $this->conexion->query($qry)->fetchAll();
                     if ($filas >= 1) 
                         return  $filas;
                     else 
                         return $qry;
        }//Actividades Entregadas

        public function diasSinAcceso($id)
        {
            $qry = "SELECT * from mdl_user where email= '';";
            $filas =  $filas = $this->conexion->query($qry)->fetchAll();
            if ($filas >= 1) 
                return  $filas;
            else 
                return 0;
        } //Días sin Acceso

        public function tiempoPlataforma($id)
        {
            $qry = "SELECT
            username
            ,c.shortname
            ,la.timeaccess
            ,age(CAST(to_timestamp(la.timeaccess) AS DATE), CAST(now() AS DATE)) AS age
            FROM mdl_user_lastaccess la
          JOIN mdl_user u ON u.id = $id
          JOIN mdl_course c ON c.id = la.courseid limit 1;";
             $filas = $this->conexion->query($qry)->fetchAll();
             if ($filas >= 1)
             return  $filas;
             else
             return 0;
        } //Tiempo en la Plataforma



        public function ultimoAccesoPlataforma($id)
        {
            $qry = "SELECT to_char(date(to_timestamp(timeaccess)),'YYYY-MM-DD')
            from mdl_user_lastaccess
            where userid= $id limit 1;";
             $filas = $this->conexion->query($qry)->fetchAll();
             if ($filas >= 1)
             return  $filas;
             else
             return 0;
        } //Tiempo en la Plataforma
        
            public function ultimoAcceso($id)
            {
                $qry = "SELECT * from mdl_user where email= '';";
                $filas =  $filas = $this->conexion->query($qry)->fetchAll();
                if ($filas >= 1) 
                    return  $filas;
                else 
                    return 0;
            } //Último Acceso a la plataforma

            public function listaAlumnosAsig()
            {
                $qry = "SELECT c.id, c.shortname, c.fullname, gi.id, gi.itemname, gi.itemmodule, gi.iteminstance
                ,(select count(*) from mdl_grade_grades where itemid=gi.id ) as participantes
                ,(SELECT count(*) FROM mdl_assign_submission where assignment=gi.iteminstance and status='submitted') as enviados
                ,(select count(*) from mdl_grade_grades where itemid=gi.id and finalgrade is not null) as Calificados
                ,(select count(*) from mdl_grade_grades where itemid=gi.id and finalgrade is null) as SinCalificar
                ,(select count(*) from mdl_grade_grades where itemid=gi.id and feedback is not null) as ExisteRetroalimentacion
                from mdl_grade_items gi
                join mdl_course c on (c.id=gi.courseid)
                where itemmodule='assign'
                order by c.id, gi.id;";
                $filas =  $filas = $this->conexion->query($qry)->fetchAll();
                if ($filas >= 1) 
                    return  $filas;
                else 
                    return 0;
            } //Alumnos Asignados 

            public function profesoresMateria()
            {
                $qry = "SELECT c.shortname, c.fullname, c.visible, CONCAT( u.firstname,' ', u.lastname ) as profesor
                FROM mdl_course c
                JOIN mdl_context con ON con.instanceid = c.id
                JOIN mdl_role_assignments ra ON con.id = ra.contextid AND con.contextlevel = 50
                JOIN mdl_role r ON ra.roleid = r.id
                JOIN mdl_user u ON u.id = ra.userid
                WHERE r.id in (4,3)
                -- and c.visible=0
                order by c.shortname, profesor;";
                $filas =  $filas = $this->conexion->query($qry)->fetchAll();
                if ($filas >= 1) 
                    return  $filas;
                else 
                    return 0;
            } //Profesores Materia



           public function reporteGlobal()
            {
                $qry = "SELECT c.id, c.shortname as NombreCorto,
                CONCAT('<a target=\"_new\" href=\"/course/view.php?id=', c.id, '\">', c.fullname ,'</a>') as NombreLargo,
                c.visible,
                css.section as Mosaico, css.id, css.name as nombreSemana
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=1 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Tareas
                ,(select
                count(gg.id) as count_cal
                from mdl_course_modules cm
                join mdl_course_sections cs on (cs.id=cm.section and cs.visible=1)
                join mdl_modules m on (m.id=cm.module)
                join mdl_grade_items gi on (gi.iteminstance = cm.instance and gi.itemmodule=m.name)
                left join mdl_grade_grades gg on (gg.itemid=gi.id)
                where cm.course=c.id and cm.module in (1) and cs.section >0 and usermodified is null
                and cs.section =css.section
                group by cm.module
                ) as SinCalificarTareas
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=9 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Foros
                ,(select
                count(gg.id) as count_cal
                from mdl_course_modules cm
                join mdl_course_sections cs on (cs.id=cm.section and cs.visible=1)
                join mdl_modules m on (m.id=cm.module)
                join mdl_grade_items gi on (gi.iteminstance = cm.instance and gi.itemmodule=m.name)
                left join mdl_grade_grades gg on (gg.itemid=gi.id)
                where cm.course=c.id and cm.module in (9) and cs.section >0 and usermodified is null
                and cs.section =css.section
                group by cm.module
                ) as SinCalificarForos
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=17 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Examen
                ,(select
                count(gg.id) as count_cal
                from mdl_course_modules cm
                join mdl_course_sections cs on (cs.id=cm.section and cs.visible=1)
                join mdl_modules m on (m.id=cm.module)
                join mdl_grade_items gi on (gi.iteminstance = cm.instance and gi.itemmodule=m.name)
                left join mdl_grade_grades gg on (gg.itemid=gi.id)
                where cm.course=c.id and cm.module in (17) and cs.section >0 and usermodified is null
                and cs.section =css.section
                group by cm.module
                ) as SinCalificarExamen
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=2 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Assignment
                
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=3 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Book
                
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=4 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Chat
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=5 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Choice
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=6 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Data
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=7 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Feedback
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=14 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Lesson
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=16 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Page
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=18 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Resource
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=19 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Scorm
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=20 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Survey
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=21 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Url
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id=22 and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as Wiki
                
                
                
                , (select count(module) from mdl_course_sections cs
                      inner join mdl_course_modules cm on (cm.section = cs.id)
                      inner join mdl_modules m on(m.id=cm.module)
                      where cs.course = c.id and m.id not in (13, 1,9,17) and cs.id=css.id and cs.section>0 and cs.visible=1
                group by(cs.id)) as totalRecursos
                
                
                from mdl_course c
                inner join mdl_course_sections css on (css.course=c.id)
                where
                -- c.id=4 and
                c.id>1 and
                css.section>0
                -- and css.visible=1
                order by c.id, css.id;";
                $filas =  $filas = $this->conexion->query($qry)->fetchAll();
                if ($filas >= 1) 
                    return  $filas;
                else 
                    return 0;
            } //Último Acceso a la plataforma
            





}
?>