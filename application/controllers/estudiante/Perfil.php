<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");

		if(!$this->session->userdata("login")) {  //si no se ha iniciado sesion "login" -> es la variable creada en Auth var $data
			redirect(base_url());
		}  
		 
	}

	public function index()
	{
		$this->load->view('estudiante/header');

		$id=$this->session->userdata("id");
		$rol=$this->session->userdata("rol");
		$v=$this-> Usuarios_model -> cargarInfoPerfil($id, $rol);
		$data['info'] = $v;
		$data['programa'] = $this-> Usuarios_model -> getProgramaNombre($v-> id_programa);
		$data['semestre'] = $this-> Usuarios_model -> getSemestre($id);
		$this->load->view('estudiante/perfil', $data);
	}

	public function editar(){

	 $id=$this->session->userdata("id");
     $usuario['codigo'] = $this->input ->post("codigoE");
     $usuario['nombre'] = $this->input ->post("nombreE");
     $usuario['correo'] = $this->input ->post("correoE");
     $estudiante['nPeriodos'] = $this->input ->post("semestreE");
 	 $pass = $this->input ->post("passwordE");
     if($pass!="") $usuario['password']= sha1($pass);

      $this-> Usuarios_model -> editarUsuario($usuario, $id,"docente");
       $this-> Usuarios_model -> cambiarSemestre($estudiante, $id);
      redirect(base_url()."estudiante/Perfil");
	}

}