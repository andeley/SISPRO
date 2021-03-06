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
		 
	}

	public function index()
	{
		$this->load->view('docente/header');
		

		$id=$this->session->userdata("id");
		//$programa= $this-> Usuarios_model->getUsuarioPrograma($id); //progran
		$data['simulacros']= $this-> Simulacros_model->getSimulacros();
		$data['user']= $this-> Usuarios_model->getDirectorB($id);
		$data['est']= "viewall";
		$data['programa']= $this-> Usuarios_model->getUsuarioPrograma($id);
		if($data['simulacros']){
			$areas = array();
			foreach ($data['simulacros'] as $s) {
				array_push($areas, $this->Simulacros_model->getAreasSimulacro($s-> id));	
			}
			$data['areas_simulacros'] = $areas;
		}
		$this->load->view('docente/simulacros', $data);

	}

	public function verPreguntas(){ 
		$id=$this->session->userdata("id");
		$id_simulacro = $area = $this->uri-> segment(4);

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

		}else{
				$data['areas_simulacro'] = false;
				$data['preguntas_area'] = false;
		}
		$data['programa'] = $programa_academico;
		$data['simulacro_id'] = $id_simulacro;
		$data['simulacro'] = $this -> Simulacros_model -> getSimulacro($id_simulacro);

		//$this->load->view('docente/header', $data);
		$this->load->view('docente/prueba', $data);

	}

}