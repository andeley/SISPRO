<?php
						//PERFIL DIRECTOR
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends CI_Controller { //autenticar

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->model("Preguntas_model");
		$this->load->model("Areas_model");
	}

	public function index()
	{
		$this->load->view('director/header');
		$data['tipo'] = "general";

		
		$data['todas_las_areas'] = $this-> Areas_model->getAreas(); //todas las areas

		$this->load->view('director/areas_conocimiento', $data);
		$this->load->view('layouts/footer');

	}

	public function registrarArea(){ //el area ya existe, el docente va a asociarse a un area
		$id=$this->session->userdata("id");
		$area = $this->input ->post("areaR");

		$this->Areas_model->registrarAreaDoc($area, $id);
		redirect(base_url()."director/Areas/misAreas");
	}

	public function registrar(){
		$area['nombre'] = $this->input ->post("nombreA");
		$validar_repeticion = $this-> Areas_model->getArea($area['nombre']);
		if(!$validar_repeticion){
			$this-> Areas_model->registrar($area);
			$this->session->set_flashdata("bien", "Area registrada exitosamente"); 
			redirect(base_url()."director/Areas");
		}else{
			$this->session->set_flashdata("error", "Esta area de conocimiento ya existe"); 
			redirect(base_url()."director/Areas");

		}
	}
}
?>