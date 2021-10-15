<?php
//require('./conexion/conexion.php');
//require_once "./conexion/conexion.php";
class cursos extends conexion
{
    //atributos de la clase
    private $id_curso;
    private $nombre_curso;
    private $profesor;
    private $id_profesor;
    private $nombre_Grupo;
    //metodos get y set
    public function setNombreCurso($nombre)
    {
        $this-> nombre_curso= $nombre;        
    }
    public function getNombreCurso()
    {
        return $this-> nombre_curso;
    }
    public function setProfesor($profesor)
    {
        $this->profesor;
    }
    public function getProfesor()
    {
        return $this->profesor;
    }
    public function setID($id)
    {
        $this-> id_curso;
    }
    public function getID()
    {
        return $this->id_curso;
    }

    public function setNombreGrupo($id)
    {
        $this->nombre_Grupo;
    }
    public function getNombreGrupo()
    {
        return $this->nombre_Grupo;
    }
    //contructor de la clase cursos
   /* function __construct()
    {
    }*/
    //funciones de las clase

    public function listaCursos($id)
    {
        $this->id_profesor = $id;
        $pagina=1;
        $inicio =0;
        $cantidad =10;//numero de registros a mostrar

        if ($pagina>1) {
            $inicio = ($cantidad*($pagina-1))+1;
            $cantidad = $cantidad*$pagina;
        }
        //ver mayusculas
        $query ="select mdl_context.instanceid, mdl_course.fullname,mdl_groups.id, mdl_user.firstname, 
        mdl_user.lastname, mdl_groups.name from  mdl_user, mdl_course, mdl_context, mdl_role_assignments, mdl_groups
        where    mdl_role_assignments.roleid=3 and mdl_role_assignments.contextid=mdl_context.id
                     and mdl_context.instanceid=mdl_course.id
                     and mdl_course.id = mdl_groups.courseid
                     and mdl_role_assignments.userid=mdl_user.id
                     and mdl_user.id=$this->id_profesor ";
        
        $datos = parent::obtenerDatos($query);
      
        
        return $datos;
    }

    public function mostrarCurso($id_profesor,$curso)
    {
        $this->id_profesor = $id_profesor;
        $this->id_curso =$curso;
        //ver mayusculas
        $query ="SELECT mdl_context.instanceid, mdl_course.fullname, mdl_user.firstname, mdl_user.lastname,  mdl_groups.id, mdl_groups.name
        from  mdl_user, mdl_course, mdl_context, mdl_role_assignments, mdl_groups
        where    mdl_role_assignments.roleid=3 and mdl_role_assignments.contextid=mdl_context.id
                     and mdl_context.instanceid=mdl_course.id
                     and mdl_course.id = mdl_groups.courseid
                     and mdl_role_assignments.userid=mdl_user.id
                     and mdl_user.id=$this->id_profesor and mdl_groups.id =$this->id_curso; ";
        
       $datos = parent::obtenerDatos($query);
        foreach ($datos as $key => $info) {
            $this->nombre_curso = $info['fullname'];
            $this->nombre_Grupo =$info['name'];
            $this->profesor= $info['firstname']." ". $info['lastname'];

        }
        return $datos;
    }
    public function totalCursos()
    {
        $qry="SELECT mdl_context.instanceid, mdl_course.fullname,mdl_user.id AS idp, mdl_user.firstname, mdl_user.lastname, mdl_user.email,mdl_groups.id, mdl_groups.name
        from  mdl_user, mdl_course, mdl_context, mdl_role_assignments, mdl_groups
        where    mdl_role_assignments.roleid=3 and mdl_role_assignments.contextid=mdl_context.id
                     and mdl_context.instanceid=mdl_course.id
                     and mdl_course.id = mdl_groups.courseid
                     and mdl_role_assignments.userid=mdl_user.id";

        $datos = parent::obtenerDatos($qry);

        return $datos;
    }

    public function listaCalificaciones($id)
    {
        $pagina=1;
        $inicio =0;
        $cantidad =10;//numero de registros a mostrar
         $this->id_curso = $id; 
        if ($pagina>1) {
            $inicio = ($cantidad*($pagina-1))+1;
            $cantidad = $cantidad*$pagina;
        }
        $query = "SELECT mdl_grade_items.courseid, mdl_course.fullname, mdl_groups.id, mdl_groups.name, 
        mdl_user.firstname, mdl_user.lastname, mdl_user.email, mdl_grade_grades.finalgrade
        from  mdl_grade_items,mdl_grade_grades,mdl_course, mdl_groups, mdl_user, mdl_groups_members
        where mdl_groups.courseid= mdl_course.id
        AND mdl_grade_grades.itemid = mdl_grade_items.id
        AND mdl_grade_grades.userid = mdl_user.id
        AND (mdl_grade_items.itemname IS NULL)
        AND (mdl_grade_grades.timemodified IS NOT NULL)
        AND (mdl_grade_grades.finalgrade >= 0)
        AND (mdl_user.deleted = 0)
        AND  mdl_groups.courseid = mdl_grade_items.courseid      
        AND mdl_groups_members.groupid= mdl_groups.id
        AND mdl_user.id = mdl_groups_members.userid 
        AND mdl_course.id= $this->id_curso ";	
        
        $datos = parent::obtenerDatos($query);
    
        return $datos;
    }
    public function listaCalificacionesTotal()
    {
        $pagina=1;
        $inicio =0;
        $cantidad =10;//numero de registros a mostrar
        if ($pagina>1) {
            $inicio = ($cantidad*($pagina-1))+1;
            $cantidad = $cantidad*$pagina;
        }
        $query = "SELECT mdl_grade_items.courseid, mdl_course.fullname, mdl_groups.id, mdl_groups.name, 
        mdl_user.firstname, mdl_user.lastname, mdl_user.email, mdl_grade_grades.finalgrade
        from  mdl_grade_items,mdl_grade_grades,mdl_course, mdl_groups, mdl_user, mdl_groups_members
        where mdl_groups.courseid= mdl_course.id
        AND mdl_grade_grades.itemid = mdl_grade_items.id
        AND mdl_grade_grades.userid = mdl_user.id
        AND (mdl_grade_items.itemname IS NULL)
        AND (mdl_grade_grades.timemodified IS NOT NULL)
        AND (mdl_grade_grades.finalgrade >= 0)
        AND (mdl_user.deleted = 0)
        AND  mdl_groups.courseid = mdl_grade_items.courseid      
        AND mdl_groups_members.groupid= mdl_groups.id
        AND mdl_user.id = mdl_groups_members.userid";	
        
        $datos = parent::obtenerDatos($query);
    
        return $datos;
    }

    public function mostrarCursos()
    {
        $listaCursos = $this->listaCursos( $this->id_profesor );
         foreach ($listaCursos as $key => $curso) {
                  //  echo $curso["instanceid"]."-". $curso["fullname"]."-".  $curso["firstname"]."-". $curso["lastname"]. "<br/>";
                
        } 
            

       
    }

    public function numeroAlumnos($id_grupo, $id_curso)
    {


        $query="SELECT COUNT(  mdl_groups.name) as total
        from 
        mdl_grade_items,mdl_grade_grades,mdl_course, mdl_groups, mdl_user, mdl_groups_members
        where 
        mdl_groups.courseid= mdl_course.id
        AND mdl_grade_grades.itemid = mdl_grade_items.id
        AND mdl_grade_grades.userid = mdl_user.id
        AND (mdl_grade_items.itemname IS NULL)
        AND (mdl_grade_grades.timemodified IS NOT NULL)
        AND (mdl_grade_grades.finalgrade >= 0)
        AND (mdl_user.deleted = 0)
        AND  mdl_groups.courseid = mdl_grade_items.courseid      
        AND mdl_groups_members.groupid= mdl_groups.id
        AND mdl_user.id = mdl_groups_members.userid 
        AND mdl_course.id= $id_curso AND   mdl_groups.id= $id_grupo; ";
           
        $numero = parent::alumnosGrupo($query);
        
        //echo "numero: ".$numero;
        
        return $numero;

    }
    public function obtenerProfesor($id_usuario)
    {
        $qry= "SELECT  mdl_user.id,  mdl_user.firstname,  mdl_user.lastname,  mdl_user.email from mdl_user where  mdl_user.id = '$id_usuario'";
        $datos = parent::obtenerDatos($qry);
       
        return $datos;
    }


    /***Busqieda por correo electronico */
    public function getListaBy($correo)
    {$query="SELECT mdl_grade_items.courseid, mdl_course.fullname,  mdl_groups.id, mdl_groups.name, 
        mdl_user.firstname, mdl_user.lastname, mdl_user.email, mdl_grade_grades.finalgrade
        from 
        mdl_grade_items,mdl_grade_grades,mdl_course, mdl_groups, mdl_user, mdl_groups_members
        where 
        mdl_groups.courseid= mdl_course.id
        AND mdl_grade_grades.itemid = mdl_grade_items.id
        AND mdl_grade_grades.userid = mdl_user.id
        AND (mdl_grade_items.itemname IS NULL)
        AND (mdl_grade_grades.timemodified IS NOT NULL)
        AND (mdl_grade_grades.finalgrade >= 0)
        AND (mdl_user.deleted = 0)
        AND  mdl_groups.courseid = mdl_grade_items.courseid      
        AND mdl_groups_members.groupid= mdl_groups.id
        AND mdl_user.id = mdl_groups_members.userid 
        and email='$correo'";
        $datos = parent::obtenerDatos($query);
        return $datos;

    }
}





