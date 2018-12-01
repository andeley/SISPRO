<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller { //autenticar

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->model("Areas_model");
	}
	public function index()
	{
		$this->load->view('docente/header');

		$id=$this->session->userdata("id");
		$rol=$this->session->userdata("rol");
		$v=$this-> Usuarios_model -> cargarInfoPerfil($id, $rol);
		$data['info'] = $v;
		$data['programa'] = $this-> Usuarios_model -> getProgramaNombre($v-> id_programa);
		
		//Areas del Docente
		$data['areas']= $this-> Areas_model->getAreas(); //listar todas las areas existentes del user
		$data['areas_doc'] = $this-> Usuarios_model-> getAreasDocente($id);

		$this->load->view('docente/perfil', $data);
		

	}

	public function editar(){

	}

	}
?>