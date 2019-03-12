<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function  cambiarSemestre($estudiante, $id){
         $this->db->where('id_user',  $id);
            $this->db->update('estudiante', $estudiante);
    }

    public function editarUsuario($usuario, $id_user, $tipo){
       
            $this->db->where('id',  $id_user);
            $this->db->update('usuario', $usuario);
        
    }

    public function login($codigo, $password){
        $this->db->where("codigo", $codigo); //hacer comparación
        $this->db->where("password", $password);

        $resultados = $this-> db->get("usuario"); //"usuarios" -> nombre de la tabla

        if ($resultados->num_rows () > 0) {
            return $resultados-> row(); //un solo user
        }else {
            return false;
        }
    }


    public function get_id_user($codigo){
        $this->db->select('id');
        $this->db->from('usuario');
        $this->db->where('codigo',  $codigo);
        $consulta=$this->db->get();
        if($consulta->num_rows() > 0){
            return $consulta->row()->id;
        } else      return false;

    }
    public function AsignarNuevoDirector($id_doc, $id_dir){

        //eliminar cargo director
        $data['es_director'] ='no';
        $this->db->where('id_user',  $id_dir);
        $this->db->update('docente', $data);

        //asignar nuevo docente
        $data['es_director'] ='si';
        $this->db->where('id_user',  $id_doc);
        $this->db->update('docente', $data);
    }

    public function existe_Docente($codigo_docente){
        $this->db->select('d.id_user');
        $this->db->from('docente d');
        $this->db->join('usuario u', 'u.id=d.id_user');
        $this->db->where("u.codigo", $codigo_docente);

        $consulta=$this->db->get();
        if($consulta->num_rows() > 0){
            return $consulta->row()->id_user;
        } else      return false;

    }

    public function getEstudiantes($programa){
        $this->db->select('u.nombre, u.id_programa, u.codigo, u.id');
        $this->db->from('usuario u');
        $this->db->join('estudiante e','e.id_user=u.id');
        $this->db->join('programa_academico p','p.id=u.id_programa');
        $this->db->where("p.nombre", $programa);

        $consulta=$this->db->get();
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }       return false;
    }
    public function aprobar_nuevo_docente($id_docente){
        $data['estado_aprobacion'] ='aprobado';
        $this->db->where('id_user',  $id_docente);
        $this->db->update('docente', $data);
    }
    public function docentes_en_espera($programa, $valor){
        $this->db->select('u.nombre, u.id_programa, u.codigo, u.id');
        $this->db->from('usuario u');
        $this->db->join('docente d','d.id_user=u.id');
        $this->db->join('programa_academico p','p.id=u.id_programa');
        $this->db->where('d.estado_aprobacion', $valor);
      //  $this->db->where("p.nombre", $programa);

        $consulta=$this->db->get();
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }       return false;
    }

    public function verificarRol($id){
      $this->db->where("id_user", $id);
      $resultados = $this-> db->get("estudiante");
      if ($resultados->num_rows () > 0) {
          return "estudiante";
      }else{
        $this->db->where("id_user", $id);
        $resultados = $this-> db->get("docente");

        if($resultados-> row()-> es_director == "no"){
            return "docente";
        }else{
            return "director";
        }
    }
}

    public function verificar_docente_aprobado($id){
        $this->db->where("id_user", $id);
        $resultados = $this-> db->get("docente");
        return $resultados-> row() -> estado_aprobacion;
    }

public function cargarProgramas(){

   $this->db->select('nombre');
   $this->db->from('programa_academico');
   $resultados = $this-> db->get();

   if($resultados->num_rows() > 0){
    return $resultados;
}return false;

}

    public function verificarCodigo($codigo){ //verificar si el usuario ya existe

       $this->db->where("codigo", $codigo);
       $resultados = $this-> db->get("usuario"); 

       if($resultados->num_rows() > 0){
        return true;
    }return false;
}

    public function verificarCorreo($correo){ //verificar si el usuario ya existe

       $this->db->where("correo", $correo);
       $resultados = $this-> db->get("usuario"); 

       if($resultados->num_rows() > 0){
        return true;
    }return false;
}

public function getPrograma($programa){
    $this->db->select('id');
    $this->db->where("nombre", $programa);
    $resultado = $this->db->get("programa_academico");

    if($resultado->num_rows() > 0){
        return $resultado->row()->id;
    }else{return false;}
}

public function getProgramaNombre($id){
    $this->db->select('nombre');
    $this->db->where("id", $id);
    $resultado = $this->db->get("programa_academico");

    if($resultado->num_rows() > 0){
        return $resultado->row()-> nombre;
    }else{return false;}
}

public function registrarDocente($data){

    try{

        $this->db->insert("usuario", $data);

        $this->db->select("u.id");
        $this->db->from('usuario u');
        $this->db->where("u.codigo", $data['codigo']);
        $id = $this-> db->get()->row()->id;

        $this->db->insert('docente', array(
            'id_user'=> $id,
            'es_director'=> "no",
            'estado_aprobacion'=> "aprobado"
        ));

    }catch(excepcion $e){
        return false;
    } return true;
}

    public function getDirectorB($id){ //retorna la informacion basica de docente/director
       $this->db->select('u.nombre, u.id_programa, p.nombre AS programa');
       $this->db->from('usuario u');
       $this->db->join('programa_academico p', 'u.id_programa=p.id');

       $this->db->where('u.id', $id );


       $consulta=$this->db->get();
       if($consulta->num_rows() > 0){
        return $consulta->row();
    } return false;
}

public function registrarEstudiante($data, $semestre){

    try{

        $this->db->insert("usuario", $data);

        $this->db->select("id");
        $this->db->from('usuario');
        $this->db->where("codigo", $data['codigo']);
        $id = $this-> db->get()->row()->id;

        $this->db->insert('estudiante', array(
            'id_user'=> $id,
            'nPeriodos'=> $semestre
        ));

    }catch(excepcion $e){
        return false;
    } return true;
}

public function getPass($codigo){

    $this->db->select("u.password");
    $this->db->from('usuario u');
    $this->db->where("u.codigo", $codigo);
    $pass = $this-> db->get()->row()->password;

    return $pass;

}

public function getNombre($codigo){

    $this->db->select("u.nombre");
    $this->db->from('usuario u');
    $this->db->where("u.codigo", $codigo);
    $nombre = $this-> db->get()->row()->nombre;

    return $nombre;

}

public function cambiarPass($nueva, $codigo){

    try {
        $data['password'] =$nueva;
        $this->db->where('codigo',  $codigo);
        $this->db->update('usuario', $data); 
        return true;
    } catch (Exception $e) {
        return false;
    }
}

public function getUsuarioPrograma($id){ //me retorna el programa academico al cual pertenece al usuario

    $this->db->select("u.id_programa");
    $this->db->from('usuario u');
    $this->db->where("u.id", $id);
    $id_programa = $this-> db->get()->row()->id_programa;

    $this->db->select("p.nombre");
    $this->db->from('programa_academico p');
    $this->db->where("p.id", $id_programa);
    $programa = $this-> db->get()->row()->nombre;

    return $programa;

}

public function getAreasDocente($id){  //areas registradas del docente (o del director)
    $this->db->select('a.id, a.nombre');
    $this->db->from('area a');
    $this->db->join('area_docente ad', 'ad.id_area = a.id');
    $this->db->where("ad.id_docente", $id);
    $resultados = $this-> db->get();

    if($resultados->num_rows() > 0){
    return $resultados->result();
    }return false;
}

public function cargarInfoPerfil($id, $rol){
    $this->db->select('*');
    $this->db->from('usuario u');
    if($rol=="estudiante"){
        $this->db->join('estudiante e', 'e.id_user = u.id');
    }
    
    $this->db->where("u.id", $id);
    $resultados = $this-> db->get();

    if($resultados->num_rows() > 0){
    return $resultados->row();
    }return false;
}

public function getSemestre($id){
    $this->db->select('*');
    $this->db->from('estudiante');
    $this->db->where("id_user", $id);
   return  $this-> db->get()->row()-> nPeriodos;

}
}

?>