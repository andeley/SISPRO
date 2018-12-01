 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulacros extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Simulacros_model");
		$this->load->model("Usuarios_model");
		$this->load->model("Preguntas_model");
		$this->load->model("Areas_model");

		if(!$this->session->userdata("login")) {  //si no se ha iniciado sesion "login" -> es la variable creada en Auth var $data
			redirect(base_url());
		}  
		 
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
		if($data['simulacros']){
			$areas = array();
			foreach ($data['simulacros'] as $s) {
				array_push($areas, $this->Simulacros_model->getAreasSimulacro($s-> id));	
			}
			$data['areas_simulacros'] = $areas;
		}	
		$this->load->view('estudiante/simulacros', $data);
	}

	public function realizarSimulacro(){
		$id=$this->session->userdata("id");
		$id_simulacro=$this->uri-> segment(4);
		$programa_academico = $this-> Usuarios_model -> getUsuarioPrograma($id);
		$areas_simulacro = $this -> Simulacros_model -> getAreasSimulacro($id_simulacro);
		$preguntas_area = array();

		if($areas_simulacro){
				foreach ($areas_simulacro as $area) {
					//listar los enunciados del area
					$preguntas_area[$area -> id] = array ();
					$preguntas_area[$area -> id]["enunciados"] = $this -> Simulacros_model -> getEnunciadosAreaS($area -> id, $id_simulacro); //guarda array con enunciados
					$preguntas_area[$area -> id]["preguntas_area"] = $this -> Simulacros_model -> getPreguntasAreaS($area -> id, $id_simulacro); //guarda array con preguntas del area
				}
				$data['areas_simulacro'] = $areas_simulacro;
				$data['preguntas_area'] = $preguntas_area;
		}else{
				$data['areas_simulacro'] = false;
				$data['preguntas_area'] = false;
		}
		$data['programa'] = $programa_academico;
		$data['simulacro_id'] = $id_simulacro;
		$data['simulacro'] = $this -> Simulacros_model -> getSimulacro($id_simulacro);

		$this->load->view('estudiante/prueba', $data);
	}

	public function Registarse(){
		$inscripcion["id_simulacro"]= $this->uri-> segment(4);
		$inscripcion["id_estudiante"]=$this->session->userdata("id");
		$this-> Simulacros_model->registrarEstudianteSimulacro($inscripcion);

		redirect(base_url()."estudiante/Simulacros");
	}
}
?>