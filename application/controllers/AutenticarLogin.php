<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AutenticarLogin extends CI_Controller { //autenticar

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
	}
	public function index()
	{
		if($this->session->userdata("login")) {  //ya se inicio sesion
			$rol = $this->session->userdata("rol");
			redirect(base_url().$rol."/Perfil");
		}  else{
			$res ['programas']=$this->Usuarios_model->cargarProgramas(); 
			$this->load->view('login', $res);
		} 
		
	}

	public function login(){
		$codigo = $this->input ->post("codigo");
		$password = $this->input ->post("contraseña");
		$res = $this-> Usuarios_model->login($codigo, sha1($password));  //sha1-> encriptar pass

		if (!$res) { //no existe ese usuario


			$this->session->set_flashdata("error", "Correo y/o Contraseña incorrectos"); 
			redirect(base_url());


			
		}else{ //el usuario existe, verifical rol

			$i = $res->id;
			$rol = $this->Usuarios_model->verificarRol($i);
			$data =array(
				            'id' =>$res->id, 
				        	'nombre'=>$res->nombre,
				        	'rol'=> $rol,
				        	'login'=> TRUE
				        );

			if($rol=="estudiante"){
				$this->session->set_userdata($data); //enviar datos inic sesion
				redirect(base_url()."estudiante/Perfil"); //redirecciona al controler dashboard estudiante
			}else if($rol=="docente"){
				$verAprobado = $this->Usuarios_model->verificar_docente_aprobado($res->id);
				if($verAprobado == "espera"){
					$this->session->set_flashdata("error", "Debes esperar a la aprobación del director de programa"); 
					redirect(base_url());
				}else{
					$this->session->set_userdata($data); 
					redirect(base_url()."docente/Perfil");
				}
			}else{ //director-admin
				$this->session->set_userdata($data); //enviar datos inic sesion
				redirect(base_url()."director/Perfil");
			}

			
			
		}
	}
	
	public function registro(){
		$data=array();

		$nombre = $this->input ->post("nombreR");
		$codigo = $this->input ->post("codigoR");
		$correo = $this->input ->post("correoR");
		$password = $this->input ->post("contraseñaR");
		$programa = $this->input ->post("programaR");
		$rol = $this->input ->post("tipo_usuario");

		//verificar datos iguales

		$validacion = $this->Usuarios_model->verificarCodigo($codigo);

		if($validacion){
			$this->session->set_flashdata("error", "el usuario ".$codigo." ya existe"); 
			redirect(base_url());
		}else{
			
			//registrar nuevo usuario

		$data['nombre'] =$nombre;
        $data['codigo'] =$codigo;
        $data['correo'] =$correo;
        $data['password'] =sha1($password);
        $data['id_programa'] = $this->Usuarios_model->getPrograma($programa);
        
        if($rol=="estudiante"){
        	$semestre =  $this->input ->post("semestreR");
        	$resultado = $this->Usuarios_model->registrarEstudiante($data, (int)$semestre);
        	//redireccionar a la vista est

        	if($resultado){

        	$user = $this-> Usuarios_model->login($codigo, sha1($password));
        	$i = $res->id;
			//$rol = Usuarios_model->verificarRol($i);
			$data =array(
				            'id' =>$user->id, 
				        	'nombre'=>$user->nombre,
				        	'rol'=> "estudiante",
				        	'programa_nombre'=> $programa,
				        	'login'=> TRUE
				        );

			$this->session->set_userdata($data); //enviar datos inic sesion
			redirect(base_url()."estudiante/Perfil"); 

        }else{
        	$this->session->set_flashdata("error", "No se pudo registrar el usuario"); 
			redirect(base_url());
        }

        }else{
        	$resultado = $this->Usuarios_model->registrarDocente($data);



        	//redireccionar a la vista doc

        	if($resultado){//mostrar mensaje registro de docente

        		$user = $this-> Usuarios_model->login($codigo, sha1($password));
        	$i = $res->id;
			//$rol = Usuarios_model->verificarRol($i);
			$data =array(
				            'id' =>$user->id, 
				        	'nombre'=>$user->nombre,
				        	'rol'=> "docente",
				        	'login'=> TRUE
				        );

			$this->session->set_userdata($data); //enviar datos inic sesion
			redirect(base_url()."docente/Perfil"); 


			//$this->session->set_flashdata("error", "Registro exitoso. esperar la aprobación del /director de Programa"); 
			//redirect(base_url()); 

        }else{
        	$this->session->set_flashdata("error", "No se pudo registrar el usuario"); 
			redirect(base_url());
        }

        }

        
        
        
		}
	}

	    public function logout (){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function recuperar(){
		$codigo =$this->input ->post("codigores");
		$correo = $this->input ->post("correores");

		//validar codigo

		$validacion = $this->Usuarios_model->verificarCodigo($codigo);

		if(!$validacion){
			$this->session->set_flashdata("error", "el usuario ".$codigo." No existe"); 
			redirect(base_url());
		}else{
		$validacion2 = $this->Usuarios_model->verificarCorreo($correo);

			if(!$validacion2){
			$this->session->set_flashdata("error", "El correo para el usuario ".$codigo." no es el correspondiente"); 
			redirect(base_url());
			}else{

				 

				 //cargar vista reestablecer
				 redirect(base_url().'AutenticarLogin/reestablecer/'.$codigo); 
				 

		}
		}


}

public function reestablecer(){
	

	$codigo= $this->uri-> segment(3);

	$pass = $this->Usuarios_model->getPass($codigo);
	$nombre = $this->Usuarios_model->getNombre($codigo);

				 $res ['pass']=$pass; 
				 $res ['nombre']=$nombre; 

    $this->load->view('reestablecer', $res);
}

public function validacion1(){

}
public function reestablecerPass(){
	    $antigua = $this->input ->post("ca");
		$nueva = $this->input ->post("cn");
		$nuevar = $this->input ->post("cnn");

		$codigo= $this->uri-> segment(3);

		$pass = $this->Usuarios_model->getPass($codigo);
		$nombre = $this->Usuarios_model->getNombre($codigo);
		$res ['pass']=$pass; 
		$res ['nombre']=$nombre;

		if($this->Usuarios_model->getPass($codigo)!=sha1($antigua)){
			$this->session->set_flashdata("error", "la contraseña antigua es incorrecta");
			$this->load->view('reestablecer', $res);
		}else if($nueva!= $nuevar){
			$this->session->set_flashdata("error", "verificar igualdad de la nueva contaseña");
			$this->load->view('reestablecer', $res);
		}else{
		
		$validacion=  $this->Usuarios_model->cambiarPass(sha1($nueva), $codigo);

		if($validacion){
			$this->session->set_flashdata("bien", "La contraseña se ha reestablecido correctamente");
			redirect(base_url());
		}else{
			$this->session->set_flashdata("error", "No se ha podido reestablecer la contraseña");
			$this->load->view('reestablecer');
		}
	}
}
}

?>