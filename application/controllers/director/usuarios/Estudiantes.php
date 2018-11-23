<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiantes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Simulacros_model");
		$this->load->model("Usuarios_model");

		if(!$this->session->userdata("login")) {  //si no se ha iniciado sesion "login" -> es la variable creada en Auth var $data
			redirect(base_url());
		}  
		 
	}

	public function index()
	{
		$this->load->view('director/header');
		
		$id=$this->session->userdata("id");
		$programa =  $this-> Usuarios_model->getUsuarioPrograma($id); 
		$data['estudiantes'] = $this-> Usuarios_model->getEstudiantes($programa);

		$this->load->view('director/estudiantes', $data);


	}


}
?>