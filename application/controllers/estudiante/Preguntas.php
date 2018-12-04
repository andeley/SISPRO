<?php
						
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
		$this->load->view('estudiante/header');
		$id=$this->session->userdata("id");
		$data['tipo']= "general";
		//Modal aprobar preguntas
		$programa =  $this-> Usuarios_model->getUsuarioPrograma($id);

		$data['todas_las_areas'] = $this-> Areas_model->getAreas(); //todas las areas
		$data['preguntas']= $this-> Preguntas_model->getPreguntas($id); //preguntas del docente
		$data['user']= $this-> Usuarios_model->getDirectorB($id); //datos basicos del user
		$areas = $this-> Usuarios_model-> getAreasDocente($id);

		if(!$areas){
			$data['crear']= false;
			$this->session->set_flashdata("error", "Debes Registrar Areas de Conocimiento para Poder Crear Preguntas"); 
		}else{
			$data['crear']= true;
		}

		//cargar vista crear pregunta
		$data['Areas'] = $this-> Usuarios_model ->getAreasDocente($id);

		$this->load->view('estudiante/preguntas', $data);
	}


	public function verDetalle(){
		$id_pregunta= $this->uri-> segment(4);
		//obtener detalle de la pregunta, del enunciado general (si tiene), de las opciones de respuesta, , la respuesta correcta y la justificación
		$data['info_pregunta'] = $this-> Preguntas_model->getPregunta($id_pregunta); 
		$data['opciones_respuesta'] = $this-> Preguntas_model->getOpcionesRespuesta($id_pregunta);
		$data['area_p'] = $this-> Preguntas_model->getAreaP($id_pregunta);
		$data['tipo']= "ver detalle pregunta";
		if(!is_null($data['info_pregunta']->id_enunciado)){
			$data['enunciado'] = $this-> Preguntas_model->descripcionEnunciado($data['info_pregunta']->id_enunciado);
		}else{
			$data['enunciado'] ="no existe enunciado";
		}
		$this->load->view('estudiante/header');
		$this->load->view('estudiante/preguntas', $data);
		//$this->load->view('layouts/footer');
	}


	public function ver_preguntas_area(){
		//listar las preguntas por area de conocimiento
		$this->load->view('estudiante/header');
		$id_area= $this->uri-> segment(4);
		$data['id_a'] = $id_area;
		$data['tipo'] = "ver preguntas area";
		$data['nombre_area'] = $this->Areas_model->getNombreArea($id_area);
		$data['preguntas']= $this-> Preguntas_model->getPreguntasAreaPublicas($id_area);
		$this->load->view('estudiante/preguntas', $data);
	//	$this->load->view('layouts/footer');
	}

    
}
?>