<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docentes extends CI_Controller {

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
		$data['programa']= $this-> Usuarios_model->getUsuarioPrograma($id);
		//cargar todos los docentes del programa académico que aún no han sido aprobados
		$programa =  $data['programa'];
		$data['docentes_a'] = $this-> Usuarios_model->docentes_en_espera($programa, "espera");
		//cargar los docentes vinculados a un programa académico (docentes de planta)
		$data['docentes_a2'] = $this-> Usuarios_model->docentes_en_espera($programa, "aprobado");

		$areas_docentes = array();
		if($data['docentes_a2']){
			foreach ($data['docentes_a2'] as $doc) {
				array_push($areas_docentes, $this-> Usuarios_model-> getAreasDocente($doc-> id));
			}
		}
		$data['areas_docentes'] = $areas_docentes;
		$this->load->view('director/docentes', $data);


	}

	public function AsignarNuevoDirector(){
		$id_nuevo_director= $this->input ->post("codigoD");
		//verificar existencia director 
		$id_doc = $this-> Usuarios_model->existe_Docente($id_nuevo_director);
		if($id_doc){
			//cerrar sesion
			$id=$this->session->userdata("id"); //id del usuario director
			$this-> Usuarios_model->AsignarNuevoDirector($id_doc, $id);
			redirect(base_url().'AutenticarLogin/logout/'); 
		}else{
			$this->session->set_flashdata("error", "el Código no corresponde a un docente"); 
			redirect(base_url()."director/usuarios/Docentes");
		}
		
	}

	public function aprobar(){
		$id_docente= $this->uri-> segment(5);
		$this-> Usuarios_model->aprobar_nuevo_docente($id_docente);
		redirect(base_url()."director/usuarios/Docentes");

	}
}
?>