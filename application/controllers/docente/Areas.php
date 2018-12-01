<?php
						//PERFIL DIRECTOR
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends CI_Controller { //autenticar

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->model("Areas_model");
		$this->load->model("Preguntas_model");
	}

	public function index()
	{
		$this->load->view('docente/header');
		$id=$this->session->userdata("id");
		$data['todas_las_areas'] = $this-> Areas_model->getAreas(); //todas las areas
		$data['areas_doc'] = $this-> Usuarios_model-> getAreasDocente($id);

		if($data['todas_las_areas']){
			$n_preguntas= array();
			$n_docentes=array();

			foreach ($data['todas_las_areas'] as $area) {
				array_push($n_preguntas, $this-> Areas_model->n_preguntas_area($area-> id));
				array_push($n_docentes, $this-> Areas_model->n_docentes_area($area-> id));
			}

			$data['n_preguntas'] = $n_preguntas;
			$data['n_docentes'] = $n_docentes;
		}

		$this->load->view('docente/areas', $data);

	}

	public function registrarArea(){ //el area ya existe, el docente va a asociarse a un area
		$id=$this->session->userdata("id");
		$area = $this->input ->post("areaR");

		$this->Areas_model->registrarAreaDoc($area, $id);
		redirect(base_url()."docente/Areas");
	}

	


	}
?>