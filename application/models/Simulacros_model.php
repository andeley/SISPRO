<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulacros_model extends CI_Model {

public function getPreguntasAreaS($id_area, $id_simulacro){ //extraer preguntas del area simulacro
	$this->db->select('*');
	$this->db->from('pregunta p');
	$this->db->join('simulacro_pregunta sm', 'sm.id_pregunta = p.id');
	$this->db->join('simulacro s', 's.id = sm.id_simulacro');
    $this->db->join('area_simulacro as', 'as.id_simulacro = s.id');
    $this->db->where('as.id_area='.$id_area);
    $this->db->where('sm.id_simulacro='.$id_simulacro);

	 $resultados = $this-> db->get();
		 if($resultados->num_rows() > 0){
			return $resultados->result();
		}return false;	
}

public function getEnunciadosAreaS($id_area, $id_simulacro){ //extraer enunciados del simulacros por el area
	$this->db->select('e.id, e.contenido');
	$this->db->distinct();
	$this->db->from('enunciado e');
	$this->db->join('pregunta p', 'p.id_enunciado = e.id');
    $this->db->join('simulacro_pregunta sm', 'sm.id_pregunta = p.id');
    $this->db->join('simulacro s', 's.id = sm.id_simulacro');
    $this->db->join('area_simulacro as', 'as.id_simulacro = s.id');

    $this->db->where('as.id_area='.$id_area);
    $this->db->where('sm.id_simulacro='.$id_simulacro);

	 $resultados = $this-> db->get();
		 if($resultados->num_rows() > 0){
			return $resultados->result();
		}return false;	
}

public function eliminarEstudianteSimulacro($estudiante, $simulacro){
	$this->db->where('id_simulacro='.$simulacro);
	$this->db->where('id_estudiante='.$estudiante);
	$this->db->delete('inscripcion');
}

public function eliminarAreaSimulacro($area, $simulacro){

	$this->db->where('id_simulacro='.$simulacro);
	$this->db->where('id_area='.$area);
	$this->db->delete('area_simulacro');
}

public function registrarPreguntaSimulacro($simulacro_pregunta){
	return $this->db->insert("simulacro_pregunta", $simulacro_pregunta);
}

public function registrarEstudianteSimulacro($inscripcion){
	return $this->db->insert("inscripcion", $inscripcion);
}

public function getPreguntasNoR($id_simulacro){ //preguntas que no han sido registradas del simulacro
			$this->db->select('*');
			$this->db->from('pregunta p');
		 	$this->db->where("p.id NOT IN 
										(SELECT s.id_pregunta
										 FROM simulacro_pregunta s
										 WHERE s.id_simulacro =".$id_simulacro.")");

		 $resultados = $this-> db->get();
		 if($resultados->num_rows() > 0){
			return $resultados->result();
		}return false;	

}

public function getSimulacrosPrograma($nombre_programa){
	$this->db->select('s.id, d.nombre AS nombreDir, s.fecha_inicio, s.fecha_fin, s.nombre AS nombreS, p.nombre AS nombreProg, s.fecha_inicio, s.fecha_fin, s.descripcion');
		 $this->db->from('simulacro s');
		 $this->db->join('usuario d', 'd.id=s.id_director');
		 $this->db->join('programa_academico p', 'p.id=d.id_programa');
		 $this->db->where('p.nombre', $nombre_programa);
		 $consulta=$this->db->get();
			 if($consulta->num_rows() > 0){
				return $consulta->result();
			} return false;
}

public function getEstudiantes($id){//estudiantes que se registraron en el simulacro
	$this->db->select('u.id, u.codigo, u.nombre');
	$this->db->from('Inscripcion i');
	$this->db->join('estudiante e', 'e.id_user=i.id_estudiante');
	$this->db->join('usuario u', 'e.id_user=u.id');
	$this->db->where('id_simulacro', $id );
	 $consulta=$this->db->get();
			 if($consulta->num_rows() > 0){
				return $consulta->result();
			} return false;
}

public function getSimulacrosEstudiante($id_est){//Simulacros activos para el estudiante

		 $this->db->select('s.id, d.nombre AS nombreDir, s.fecha_inicio, s.fecha_fin, p.nombre AS nombreProg, s.fecha_inicio, s.fecha_fin, s.nombre AS nombreS');
		 $this->db->from('simulacro s');
		 $this->db->join('usuario d', 'd.id=s.id_director');
		 $this->db->join('programa_academico p', 'p.id=d.id_programa');

		 $this->db->join('inscripcion i', 'i.id_simulacro=s.id');
		 $this->db->where('i.id_estudiante', $id_est );
		 $this->db->where('s.fecha_inicio <= CURRENT_TIMESTAMP()-5 and s.fecha_fin >= CURRENT_TIMESTAMP()-5');
		 $consulta=$this->db->get();
			 if($consulta->num_rows() > 0){
				return $consulta->result();
			} return false;
}
public function getSimulacros(){ //todos los simulacros de los programas académicos
	     $this->db->select('s.id, d.nombre AS nombreDir, s.fecha_inicio, s.fecha_fin, s.nombre AS nombreS, p.nombre AS nombreProg, s.fecha_inicio, s.fecha_fin, s.descripcion');
		 $this->db->from('simulacro s');
		 $this->db->join('usuario d', 'd.id=s.id_director');
		 $this->db->join('programa_academico p', 'p.id=d.id_programa');
		 $consulta=$this->db->get();
			 if($consulta->num_rows() > 0){
				return $consulta->result();
			} return false;
}

public function getSimulacro($id){//informacion de 1 solo simulacro
	$this->db->select('*');
	$this->db->from('simulacro');
	$this->db->where('id', $id );
	$consulta = $this-> db->get(); 
	return $consulta->row();
}

public function registrar($sim){
	return $this->db->insert("simulacro", $sim);
}

public function editar_datos_base($data, $id){
	$this->db->where('id', $id);
	return $this->db->update("simulacro", $data);
}

public function eliminar($id_simulacro){
	$this->db->delete('area_simulacro', array('id_simulacro' => $id_simulacro));
	$this->db->delete('inscripcion', array('id_simulacro' => $id_simulacro));
	$this->db->delete('calificacion_estudiante', array('id_simulacro' => $id_simulacro));
	$this->db->delete('simulacro_pregunta', array('id_simulacro' => $id_simulacro));
	$this->db->delete('estudiante_respuestas', array('id_simulacro' => $id_simulacro));

	return $this->db->delete('simulacro', array('id' => $id_simulacro));
}

public function getAreasSimulacro($id){ //listar areas de los simulacros
		$this->db->select('a.id, a.nombre');
		$this->db->from('area_simulacro as');
		$this->db->join('area a', 'a.id= as.id_area');
		$this->db->where("as.id_simulacro", $id);
		 $resultados = $this-> db->get(); 
		 
		 if($resultados->num_rows() > 0){
			return $resultados->result();
		}return false;
}

public function getPreguntasSimulacro($id){ //listar todas las preguntas del simulacro
	$this->db->select('*');
		$this->db->from('simulacro_pregunta s');
		$this->db->join('pregunta p', 'p.id= s.id_pregunta');
		$this->db->where("s.id_simulacro", $id);
		$this->db->where("p.estado", "aprobado");
		 $resultados = $this-> db->get(); 
		 
		 if($resultados->num_rows() > 0){
			return $resultados->result();
		}return false;	

}

public function getAreasNoRegistradas($id){ //selecciones las areas que aun no han sido listadas del simulacro
	 $this->db->select('*');
	 $this->db->from('area a');
	 $this->db->where("a.id NOT IN 
								(SELECT ar.id_area FROM area_simulacro ar
								WHERE  ar.id_simulacro = $id)
						");
		 $resultados = $this-> db->get(); 
		 
		 if($resultados->num_rows() > 0){
			return $resultados->result();
		}return false;
}

public function registroAreaSimulacro($area, $id_simulacro){
	    $this->db->select('a.id');
		$this->db->from('area a');
		$this->db->where("a.nombre", $area);
		$id_area = $this-> db->get()->row()-> id; 

		$area_s['id_area']=(int) $id_area;
		$area_s['id_simulacro']= (int) $id_simulacro;
		 $this->db->insert("area_simulacro", $area_s);

}
}

?>