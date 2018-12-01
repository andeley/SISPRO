<?php
						//PERFIL DIRECTOR
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends CI_Controller { //autenticar

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->model("Areas_model");
	}

	public function index()
	{
		$this->load->view('docente/header');
		

		$id=$this->session->userdata("id");
		//$programa= $this-> Usuarios_model->getUsuarioPrograma($id); //progran
		$data['areas']= $this-> Areas_model->getAreas(); //listar todas las areas existentes
		$data['areas_doc'] = $this-> Usuarios_model-> getAreasDocente($id);
		

		$this->load->view('docente/areas', $data);
		$this->load->view('layouts/footer');

	}

	public function registrarArea(){ //el area ya existe, el docente va a asociarse a un area
		$id=$this->session->userdata("id");
		$area = $this->input ->post("areaR");

		$this->Areas_model->registrarAreaDoc($area, $id);
		redirect(base_url()."docente/Areas");
	}



	}
?>