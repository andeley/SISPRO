<?php
						//PERFIL DIRECTOR
defined('BASEPATH') OR exit('No direct script access allowed');

class Preguntas extends CI_Controller { //autenticar

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->model("Preguntas_model");
		$this->load->model("Areas_model");
	}

	public function index()
	{
		$this->load->view('docente/header');
		

		$id=$this->session->userdata("id");
		$data['preguntas']= $this-> Preguntas_model->getPreguntas($id);
		$data['user']= $this-> Usuarios_model->getDirectorB($id); //datos basicos del user
		$data['est']= "general";
		$areas = $this-> Usuarios_model-> getAreasDocente($id);

		if(!$areas){
			$data['crear']= false;
			$this->session->set_flashdata("error", "Debes Registrar Areas de Conocimiento para Poder Crear Preguntas"); 
		}else{
			$data['crear']= true;
		}

		

		$this->load->view('docente/preguntas/listado', $data);
		$this->load->view('layouts/footer');

	}

    //cargar vista creacionPregunta
	public function crearPregunta(){ 
		$this->load->view('docente/header');
		$id=$this->session->userdata("id");
		
		$data['est']= "creacion_pregunta";
		$this->load->view('docente/preguntas/creacion_preguntas', $data);
		$this->load->view('layouts/footer');
	}

}
?>