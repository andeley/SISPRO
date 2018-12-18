<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulacros extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Simulacros_model");
		$this->load->model("Usuarios_model");
		$this->load->model("Preguntas_model");
		$this->load->model("Areas_model");

		if(!$this->session->userdata("login")) { 
			redirect(base_url());
		}  
		 date_default_timezone_set('America/Bogota');
	}

	public function index()
	{
		$this->load->view('estudiante/header');
		$id=$this->session->userdata("id");

		//cargar todos los simulacros del programa académico
		$data['programa']= $this-> Usuarios_model->getUsuarioPrograma($id);
		$data['simulacros']= $this-> Simulacros_model->getSimulacrosPrograma($data['programa']);
		$data['tipo']= "General";
		//cargar todos los simulacros registrados por el estudiante
		$data['simulacros_estudiante']= $this-> Simulacros_model->getSimulacrosEstudiante($id);	
		$calificacion = array(); //verificar que el estudiante ya haya realizado ese simulacro

		if($data['simulacros_estudiante']){
			
			foreach ($data['simulacros_estudiante'] as $s) {
				
				$val = $this->Simulacros_model->getCalificaciones_se($s-> id, $id);
				if($val){
					foreach ($val as $v) {
						array_push($calificacion, $v);
					}
				}		
			}
		}
		if($data['simulacros']){
			$areas = array();
			foreach ($data['simulacros'] as $s) {
				array_push($areas, $this->Simulacros_model->getAreasSimulacro($s-> id));
			}
			$data['areas_simulacros'] = $areas;
		}	
		$data['calificaciones'] = $calificacion;
		$this->load->view('estudiante/simulacros', $data);
	}

	public function verResultados(){

		$this->load->view('estudiante/header');
		$data['tipo']= "ver desempeño";
		$id=$this->session->userdata("id");
	$data['simulacros_estudiante']= $this-> Simulacros_model->getSimulacrosEstudianteTodos($id);	
		$calificacion = array(); //verificar que el estudiante ya haya realizado ese simulacro

		if($data['simulacros_estudiante']){
			
			foreach ($data['simulacros_estudiante'] as $s) {
			
			if(strtotime($s->fecha_fin) >= strtotime(date("d-m-Y H:i:00", time()))) continue;
				$val = $this->Simulacros_model->getCalificaciones_se($s-> id, $id);
				if($val){
					foreach ($val as $v) {
						array_push($calificacion, $v); //mostrar calificaciones para simulacros finalizados
					}
				}		
			}
		}
		$data['calificaciones'] = $calificacion;
		$this->load->view('estudiante/simulacros', $data);
	}

	public function anadir_rta(){ //guardar la respuesta instantaneamente al responderla-actualizar respuesta
		$id=$this->session->userdata("id");
		$id_simulacro=$this->uri-> segment(4);
		$id_pregunta=$this->uri-> segment(5);
		$id_opcion=$this->uri-> segment(6);

		$this -> Simulacros_model->anadir_rta($id_opcion, $id_pregunta, $id, $id_simulacro);
		//$this->load->view('estudiante/header');

	}

	public function guardar_simulacro(){//generar y guardar los resultados de la prueba saber para el estudiante
		$id=$this->session->userdata("id");
		$id_simulacro=$this->uri-> segment(4);
		$areas_simulacro = $this -> Simulacros_model -> getAreasSimulacro($id_simulacro);
		if($areas_simulacro){
			//extraer preguntas area y respuestas-area
			foreach ($areas_simulacro as $area) {
				$preguntas = $this -> Simulacros_model -> getPreguntasAreaS($area -> id, $id_simulacro);
				$respuestas_estudiante = $this -> Simulacros_model ->getRespuestasEstudianteArea( $area -> id, $id_simulacro, $id);

				$n_respuestas_est = 0; //respuestas correctas del estudiante
				if($respuestas_estudiante){
					$n_respuestas_est = count($respuestas_estudiante);
					foreach ($respuestas_estudiante as $r) {
						if($r -> respuesta == "no")$n_respuestas_est--;
					}
				}
					$n_preguntas = count($preguntas);
					$calificacion = round(($n_respuestas_est*5.0)/$n_preguntas, 2);

					//guardar calificación del estudiante
					$c = array();
					$c['id_simulacro'] = $id_simulacro;
					$c['id_estudiante'] = $id;
					$c['id_area'] = $area -> id;
					$c['puntaje'] = $calificacion;
					$c['p_correctas'] = $n_respuestas_est;
					$c['p_totales'] = $n_preguntas;
					$this -> Simulacros_model -> guardar_calificacion_est($c);	
			}
		}
		redirect(base_url()."estudiante/Simulacros");
	}

	public function realizarSimulacro(){ //cargar vista simulacro en vivo
		$id=$this->session->userdata("id");
		$id_simulacro=$this->uri-> segment(4);
		$programa_academico = $this-> Usuarios_model -> getUsuarioPrograma($id);
		$areas_simulacro = $this -> Simulacros_model -> getAreasSimulacro($id_simulacro);
		$preguntas_area = array();
		$opciones= array();
		$num_preguntas =0;

		if($areas_simulacro){
				foreach ($areas_simulacro as $area) {
					//listar los enunciados del area
					$preguntas_area[$area -> id] = $this -> Simulacros_model -> getPreguntasAreaS($area -> id, $id_simulacro); //guarda array con preguntas del area
					if($preguntas_area[$area -> id]){
						$num_preguntas+=count($preguntas_area[$area -> id]);
						foreach ($preguntas_area[$area -> id]as $pregunta) {
							//almacenar opciones de respuesta
							$opciones[$pregunta -> id_pregunta] = $this-> Preguntas_model -> getOpcionesRespuesta($pregunta -> id_pregunta);
						}
					}
				}
				$data['opciones'] = $opciones;
				$data['areas_simulacro'] = $areas_simulacro;
				$data['preguntas_area'] = $preguntas_area;
				$data['num_preguntas'] = $num_preguntas;

				$preguntas_respondidas = $this -> Simulacros_model -> preguntas_respondidas($id_simulacro, $id);
				$total =0;
				
				if($preguntas_respondidas){
					$total = count($preguntas_respondidas);
				}
				$data['porcentaje']=0;
				if($num_preguntas>0)$data['porcentaje'] = (int) (($total*100)/$num_preguntas);
				$data['preguntas_respondidas'] = $preguntas_respondidas;
		}else{
				$data['areas_simulacro'] = false;
				$data['preguntas_area'] = false;
		}
		$data['programa'] = $programa_academico;
		$data['simulacro_id'] = $id_simulacro;
		$data['simulacro'] = $this -> Simulacros_model -> getSimulacro($id_simulacro);

		$this->load->view('estudiante/prueba', $data);
	}

	public function Registrarse(){
		$inscripcion["id_simulacro"]= $this->uri-> segment(4);
		$inscripcion["id_estudiante"]=$this->session->userdata("id");
		$this-> Simulacros_model->registrarEstudianteSimulacro($inscripcion);

		redirect(base_url()."estudiante/Simulacros");
	}
}
?>