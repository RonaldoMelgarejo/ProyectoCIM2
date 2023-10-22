<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {


	//empieza con metodo
	public function index()
	{
		$data['msg']=$this->uri->segment(3);  //recupera el numero en la posicion 3 para dar mensajes index.php/usuarios/index/1(este es el numero)

		if($this->session->userdata('login'))
		{
			redirect('usuario/panel','refresh');
		}
		else
		{
			//$this->load->view('inc_head'); //cargar cabecera
			$this->load->view('loginform',$data); //cargar vista loginform y se envia $data que debe ser dado el formato en la vista
			//$this->load->view('inc_footer'); //cargar pie
		}		
	}
	
	public function validarusuario()
	{
		$login=$_POST['login'];
		$password=md5($_POST['password']);

		$consulta=$this->usuario_model->validar($login,$password);

		if($consulta->num_rows()>0)  //validamos usuario
		{
			foreach($consulta->result() as $row)
			{
				//creamos variables de session
				$this->session->set_userdata('idusuario',$row->idUsuarios); //creamos variable 'idusuario' y lo rescatamos de $row->idusuario bd
				$this->session->set_userdata('login',$row->login);
				$this->session->set_userdata('tipo',$row->tipo);
				redirect('usuario/panel','refresh');
			}
		}
		else
		{
			redirect('usuario/index/1','refresh'); //cargamos el login en caso contrario
		}
	}

	public function panel()
	{
		if($this->session->userdata('login'))
		{
			redirect('estudiante/index','refresh');
			//o tambie se puede crear por roles
		}
		else
		{
			redirect('usuario/index/2','refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('usuario/index/3','refresh');
	}
	
	public function register(){
		$this->load->view('registerform'); //cargar vista loginform y se envia $data que debe ser dado el formato en la vista
	}

	public function dashboard(){
		redirect('monitoreo/index','refresh');
	}
}
