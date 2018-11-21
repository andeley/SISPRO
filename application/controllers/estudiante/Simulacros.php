 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulacros extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Simulacros_model");
		$this->load->model("Usuarios_model");
		$this->load->model("Preguntas_model");
		$this->load->model("Areas_model");

		if(!$this->session->userdata("login")) {  //si no se ha iniciado sesion "login" -> es la variable creada en Auth var $data
			redirect(base_url());
		}  
		 
	}

	public function index()
	{
		$this->load->view('estudiante/header');
		$id=$this->session->userdata("id");

		//cargar todos los simulacros
		$data['simulacros']= $this-> Simulacros_model->getSimulacros();

		//cargar todos los simulacros registrados por el estudiante
		$data['simulacros_estudiante']= $this-> Simulacros_model->getSimulacrosEstudiante($id);		
	//	if($data['simulacros_estudiante']!= false )echo ('Numero de simulacros registrados activos: '.count($data['simulacros_estudiante']));
		//else echo "el estudiante no tiene simulacros";
		$this->load->view('estudiante/simulacros', $data);
	}
}
?>