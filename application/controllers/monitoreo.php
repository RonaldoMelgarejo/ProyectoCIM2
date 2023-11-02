<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoreo extends CI_Controller {


	//empieza con metodo
	//---------- funciones del template -------
	public function index()
	{
        /*
		$lista=$this->estudiante_model->lista();   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		$data['estudiante']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		*/

		$this->load->view('inc_head'); //cargar cabecera
		//$this->load->view('est_lista'$data); //cargar vista est_lista y se envia $data que debe ser dado el formato en la vista
        $this->load->view('inc_sidebar');
        $this->load->view('inc_navbar');
		$this->load->view('dashboardtemplate');
		$this->load->view('inc_footer'); //cargar pie
	}

	public function prueba()
	{
        /*
		$lista=$this->estudiante_model->lista();   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		$data['estudiante']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		*/

		$this->load->view('inc_head'); //cargar cabecera
		//$this->load->view('est_lista'$data); //cargar vista est_lista y se envia $data que debe ser dado el formato en la vista
        $this->load->view('inc_sidebar');
        $this->load->view('inc_navbar');
		$this->load->view('prueba');
		$this->load->view('inc_footer'); //cargar pie
	}
	//-----------------------------------------

	//--------- Vista Dashboard --------
	public function dashboard(){
		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
        $this->load->view('inc_navbar');
		$this->load->view('dashboard');
		$this->load->view('inc_footer');
	}
	//----------------------------------

	//--------- Vista de perfil y de editar usuario ---------
	public function perfil()
	{
        
		$lista=$this->dispositivo_model->listaDispositivos();   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		$data['dispositivo']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		

		$this->load->view('inc_head'); //cargar cabecera
		//$this->load->view('est_lista'$data); //cargar vista est_lista y se envia $data que debe ser dado el formato en la vista
        $this->load->view('inc_sidebar');
        $this->load->view('inc_navbar');
		$this->load->view('profile', $data);
		$this->load->view('inc_footer'); //cargar pie
	}
	//-------------------------------------------------------

	//--------- Vista Tabla --------
	public function table(){
		$lista=$this->monitoreo_model->lista();   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		$data['medicion']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		
		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
		$this->load->view('inc_navbar');
		$this->load->view('datatable', $data);
		$this->load->view('inc_footer');
	}
	//------------------------------

	//--------- Funciona de graficar AJAX ------
	public function graficaAjax(){
		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
		$this->load->view('inc_navbar');
		$this->load->view('chart');
		$this->load->view('inc_footer');
	}

	public function grafica() {
        $this->load->model('Monitoreo_model');

        $data['voltaje'] = $this->Monitoreo_model->getVoltajeData();
        $data['corriente'] = $this->Monitoreo_model->getCorrienteData();

        header('Content-Type: application/json');
        echo json_encode($data);
    }
	//------------------------------------------

	//--------- Vista de registrar y lista de Dispositivo -----
	public function registrarDispositivo(){
		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
		$this->load->view('inc_navbar');
		$this->load->view('device_register');
		$this->load->view('inc_footer');
	}

	public function dispositivos(){
		$lista=$this->dispositivo_model->listaDispositivos();   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		$data['dispositivo']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		
		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
		$this->load->view('inc_navbar');
		$this->load->view('device_list', $data);
		$this->load->view('inc_footer');
	}	
	//---------------------------------------------------------

	/*
	public function modificar(){
		$idEstudiante=$_POST['idEstudiante'];   //en la variable $idEstudiante q creamos recibimos el parametro de del input=idEstudiante
		$data['infoestudiante']=$this->estudiante_model->recuperarEstudiante($idEstudiante);   //realizamos la consulta al modelo mandando el valor del id
	
		$this->load->view('inc_head'); //cargar cabecera
		$this->load->view('est_modificar',$data); //cargar vista est_modificar y se envia $data que debe ser dado el formato en la vista
		$this->load->view('inc_footer'); //cargar pie
	}

	public function modificarbd(){
		$idEstudiante=$_POST['idEstudiante'];
		$data['nombre']=$_POST['nombre'];   //'nombre' como esta escrito en BD y el post 'nombre' como esta escrito en input del formulario 
		$data['primerApellido']=$_POST['primerApellido'];
		$data['segundoApellido']=$_POST['segundoApellido'];
		$data['nota']=$_POST['nota'];

		$this-> estudiante_model->modificarEstudiante($idEstudiante,$data);  //envia a model.php los datos para hacer update
		
		redirect('estudiante/index','refresh');
	}

	public function agregar(){
		$this->load->view('inc_head'); //cargar cabecera
		$this->load->view('est_agregar'); //cargar vista eset_agregar 
		$this->load->view('inc_footer'); //cargar pie
	}

	public function agregarbd(){
		$data['nombre']=$_POST['nombre'];   //'nombre' como esta escrito en BD y el post 'nombre' como esta escrito en input del formulario 
		$data['primerApellido']=$_POST['primerApellido'];
		$data['segundoApellido']=$_POST['segundoApellido'];
		$data['nota']=$_POST['nota'];

		$this->estudiante_model->agregarEstudiante($data); //enviamos el al insert esos datos

		redirect('estudiante/index','refresh');
	}

	public function eliminarbd(){
		$idEstudiante=$_POST['idEstudiante'];
		$this->estudiante_model->eliminarEstudiante($idEstudiante); //enviamos al delete esos datos

		redirect('estudiante/index','refresh');
	}*/
}
