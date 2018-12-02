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
		$this->load->view('director/header');
		$id=$this->session->userdata("id");
		$data['tipo']= "general";
		//Modal aprobar preguntas
		$programa =  $this-> Usuarios_model->getUsuarioPrograma($id);
		//cargar preguntas de los profesores de ingenieria de sistemas que aun no han sido aprobadas
		$data['preguntas_espera'] = $this-> Preguntas_model-> get_preguntas_programa($programa);
		//fin modal aprobar preguntas
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

		$this->load->view('director/preguntas', $data);
	}

	public function eliminar(){

	}

	public function anadir(){ 

		$enunciado['contenido'] = $this->input ->post("enunciado");
		$id_enunciado = $this-> Preguntas_model->crearEnunciado($enunciado);

		//registrar pregunta
		$pregunta['id_enunciado'] = $id_enunciado;
		$pregunta['tipo'] = $this->input ->post("tipo"); 
		$pregunta['visibilidad'] = $this->input ->post("visibilidad");
		$pregunta['id_docente_cargo'] = $this->session->userdata("id");
		$pregunta['id_area'] = $this->input ->post("area");
		$pregunta['estado'] = "aprobado";
		$pregunta['descripcion'] = $this->input ->post("descripcionPregunta");

		$id_p = $this-> Preguntas_model-> crearPregunta($pregunta);
		//insertar opciones
	if($pregunta['tipo']=="sm"){
		$opciones = $this->input ->post("opcion");
		$justificaciones = $this->input ->post("justificacion");
		$opcion_correcta = $this->input ->post("correcta");
		$contador = 0;

		foreach ($opciones as $opcion) {
			if($opcion!=""){
				if($contador+1 == $opcion_correcta) $opcio['correcta']= "si";
				else   $opcio['correcta']= "no";

				$opcio['id_pregunta'] = $id_p;
				$opcio['descripcion'] = $opcion;
				$opcio['justificacion'] = $justificaciones[$contador];

				$this-> Preguntas_model-> registrarOpcion($opcio);
			}
			$contador++;
		}
	}else if($pregunta['tipo']=="vf"){

		$opcione = $this->input ->post("opcion2");
		$justificaciones = $this->input ->post("justificacion2");
		$opcion_correcta = $this->input ->post("correcta2");
		$contador = 0;
		foreach ($opcione as $opcion) {
			if($opcion!=""){
				if($contador+1 == $opcion_correcta) $opcio['correcta']= "si";
				else   $opcio['correcta']= "no";

				$opcio['id_pregunta'] = $id_p;
				$opcio['descripcion'] = $opcion;
				$opcio['justificacion'] = $justificaciones[$contador];

				$this-> Preguntas_model-> registrarOpcion($opcio);
			}
			$contador++;
		}
	}else{ //registrar opc para pregunta abierta
		$opcio['correcta']= "si";
		$opcio['id_pregunta'] = $id_p;
		$opcio['descripcion'] = $this->input ->post("opciona");
		$opcio['justificacion'] = $this->input ->post("justificaciona");
		$this-> Preguntas_model-> registrarOpcion($opcio);
	}
	redirect(base_url()."director/Preguntas");

	}

	public function editar(){
		//cargar vista editar pregunta
		$id_pregunta= $this->uri-> segment(4);
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
		$this->load->view('director/header');
		$this->load->view('director/preguntas', $data);
		//$this->load->view('layouts/footer');
	}

	public function aprobar_pregunta(){//aprobar las preguntas realizadas por un docente
		$id_pregunta= $this->uri-> segment(4);
		$this-> Preguntas_model->aprobarPregunta($id_pregunta);
		redirect(base_url()."director/Preguntas");
	}

	public function ver_preguntas_director(){
		$this->load->view('director/header');
		$id=$this->session->userdata("id");
		$data['tipo'] = "ver preguntas docente";
		$data['preguntas']= $this-> Preguntas_model->getPreguntas($id);
		$this->load->view('director/preguntas', $data);
	//	$this->load->view('layouts/footer');
	}

	public function ver_preguntas_area(){
		//listar las preguntas por area de conocimiento
		$this->load->view('director/header');
		$id_area= $this->uri-> segment(4);
		$data['id_a'] = $id_area;
		$data['tipo'] = "ver preguntas area";
		$data['nombre_area'] = $this->Areas_model->getNombreArea($id_area);
		$data['preguntas']= $this-> Preguntas_model->getPreguntasArea($id_area);
		$this->load->view('director/preguntas', $data);
	//	$this->load->view('layouts/footer');
	}

    //cargar vista creacionPregunta
	public function crearPregunta(){ 
		$this->load->view('docente/header');
		$id=$this->session->userdata("id");
		
		$data['est']= "creacion_pregunta";
		$this->load->view('docente/preguntas/creacion_preguntas', $data);
	//	$this->load->view('layouts/footer');
	}

}
?>