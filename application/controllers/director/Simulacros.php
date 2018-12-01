 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulacros extends CI_Controller {

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
		$this->load->view('director/simulacros', $data);

	}

	public function eliminarEstudianteSimulacro(){
			$estudiante = $this->uri-> segment(4);
			$simulacro = $this->uri-> segment(5);
			$this-> Simulacros_model->eliminarEstudianteSimulacro($estudiante, $simulacro);

			redirect(base_url()."director/Simulacros/editar/".$simulacro);
	}

	public function eliminarArea(){
			$area = $this->uri-> segment(4);
			$simulacro = $this->uri-> segment(5);
			$this-> Simulacros_model->eliminarAreaSimulacro($area, $simulacro);

			redirect(base_url()."director/Simulacros/editar/".$simulacro);
	}

	public function verPreguntas(){ 
			
	}

	public function registrarPreguntaSimulacro(){
		$simulacro_pregunta['id_simulacro'] = $this->uri-> segment(4);
		$simulacro_pregunta['id_pregunta'] = $this->input ->post("id_pregunta");
		$this-> Simulacros_model->registrarPreguntaSimulacro($simulacro_pregunta);

		redirect(base_url()."director/Simulacros/editar/".$simulacro_pregunta['id_simulacro']);
	}

	public function registrarEstudianteSimulacro(){
			$codigo = $this->input->post("codigoes");
			$id_est =  $this-> Usuarios_model-> get_id_user($codigo);
			$inscripcion['id_simulacro'] = $this->uri-> segment(4);
			if(!$id_est){
				$this->session->set_flashdata("error", "El usuario no Existe");
				redirect(base_url()."director/Simulacros/editar/".$inscripcion['id_simulacro']);
			}
			$inscripcion['id_estudiante'] =$id_est;
			$this-> Simulacros_model->registrarEstudianteSimulacro($inscripcion);

			redirect(base_url()."director/Simulacros/editar/".$inscripcion['id_simulacro']);
	}

	public function eliminar(){
		//primero eliminar-> areas-simulacro, Inscripciones, calificacion-est, simulacro-pregunta, estudiante-pregunta
		$id_simulacro= $this->uri-> segment(4);//id-> simulacro
		$this-> Simulacros_model->eliminar($id_simulacro);
		redirect(base_url()."director/Simulacros");
	}

	public function registrar(){ 
		$id=$this->session->userdata("id");
		$sim['id_director'] =$id;
		$sim['nombre'] =$this->input ->post("nombreS");
		$sim['descripcion'] =$this->input ->post("descripcionS");
		$sim['fecha_inicio'] =$this->input ->post("Fecha_ini");
		$sim['fecha_fin'] =$this->input ->post("Fecha_fin");

		$res=$this-> Simulacros_model->registrar($sim);

		redirect(base_url()."director/Simulacros");
	}

	public function editarDatosBase(){
		$id= $this->uri-> segment(4);
		$sim['nombre'] =$this->input ->post("nombreSE");
		$sim['descripcion'] =$this->input ->post("descripcionSE");
		$sim['fecha_inicio'] =$this->input ->post("Fecha_iniSE");
		$sim['fecha_fin'] =$this->input ->post("Fecha_finSE");

		$res=$this-> Simulacros_model->editar_datos_base($sim , $id);
		redirect(base_url()."director/Simulacros/editar/".$id);
	}

	public function editar(){ ///mostrar vista edicion
		$id= $this->uri-> segment(4);
		$data['info_simulacro'] = $this-> Simulacros_model->getSimulacro($id);
		$idUser=$this->session->userdata("id");
		$data['user']= $this-> Usuarios_model->getDirectorB($idUser);
		$areas = $this-> Simulacros_model->getAreasSimulacro($id); //listar las areas del simulacro
		$data['areas'] = $areas; //areas registradas en el simulacro
		$data['areasNo'] = $this-> Simulacros_model->getAreasNoRegistradas($id); //areas no registradas en el simulacro
		//$data['estudiantes']= $this-> Simulacros_model->getEstudiantesSimulacro($id);
		$data['preguntas']= $this-> Simulacros_model->getPreguntasSimulacro($id); //listar todas las preguntas con su area de conocimiento de cada una y el profesor encargado
		$data['preguntas_no'] = $this -> Simulacros_model->getPreguntasNoR($id); //preguntas aun no registradas
		//$data['simulacro'] = $this-> Simulacros_model->getSimulacro($id)
		$data['est']= "editS";
		$data['simulacroid']= $id;
        if($this->uri-> segment(5)=="n"){
        	$this->session->set_flashdata("error", "todas las areas están registradas");
        }
        //listar estudiantes rgistrados en el simulacro
        $data['estudiantes']= $this-> Simulacros_model->getEstudiantes($id);

		$this->load->view('director/header');
		
		$this->load->view('director/simulacros', $data);
		
	}

	public function registroAreaSimulacro(){
		$area=$this->input ->post("areaS");
		$id= $this->uri-> segment(4);

		if($area=="has seleccionado todas las areas"){
			redirect(base_url()."director/Simulacros/editar/".$id."/n");
		}else{
			$this-> Simulacros_model->registroAreaSimulacro($area, $id);
			redirect(base_url()."director/Simulacros/editar/".$id);
		}
	}
}