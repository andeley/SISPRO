 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preguntas extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata("login")) {  //si no se ha iniciado sesion "login" -> es la variable creada en Auth var $data
			redirect(base_url());
		}  
		 
	}

	public function index()
	{
		$this->load->view('estudiante/header');
		$this->load->view('estudiante/preguntas');
	}
}
?>