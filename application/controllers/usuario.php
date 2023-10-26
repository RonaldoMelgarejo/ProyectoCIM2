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
	
	public function panel()
	{
		if($this->session->userdata('email'))
		{
			redirect('monitoreo/index','refresh');
			//redirect('estudiante/index','refresh');
			//o tambie se puede crear por roles
		}
		else
		{
			redirect('usuario/index/2','refresh');
		}
	}

	public function validarusuario()
	{
		$email=$_POST['email'];
		//$login=$_POST['login'];
		$password=md5($_POST['password']);

		//$consulta=$this->usuario_model->validar($login,$password);
		$consulta=$this->usuario_model->validar($email,$password);

		if($consulta->num_rows()>0)  //validamos usuario
		{
			foreach($consulta->result() as $row)
			{
				//creamos variables de session
				$this->session->set_userdata('idusuario',$row->id); //creamos variable 'idusuario' y lo rescatamos de $row->idusuario bd
				//$this->session->set_userdata('login',$row->login);
				//$this->session->set_userdata('tipo',$row->tipo);
				$this->session->set_userdata('nombre', $row->nombre);
            	$this->session->set_userdata('primerApellido', $row->primerApellido);
            	$this->session->set_userdata('segundoApellido', $row->segundoApellido);
				$this->session->set_userdata('email',$row->email);
				$this->session->set_userdata('rol',$row->rol);
				redirect('usuario/panel','refresh');
			}
		}
		else
		{
			redirect('usuario/index/1','refresh'); //cargamos el login en caso contrario
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('usuario/index/3','refresh');
	}
	
	public function register()
	{
		$this->load->view('registerform'); //cargar vista loginform y se envia $data que debe ser dado el formato en la vista
	}

	public function dashboard()
	{
		redirect('monitoreo/index','refresh');
	}

	public function registrarusuario(){
		// Recupera los datos del formulario
		$nombre = $this->input->post('name');
		$primerApellido = $this->input->post('firstName');
		$segundoApellido = $this->input->post('lastName');
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		//$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		// Verifica que los campos requeridos no estén vacíos
		if (empty($nombre) || empty($primerApellido) || empty($email) || empty($password)) {
			// Mostrar un mensaje de error o redirigir a una página de error
			//echo 'Por favor, complete todos los campos obligatorios.';
			$this->session->set_flashdata('mensaje_error', 'Por favor, complete todos los campos obligatorios.');
			redirect('usuario/register');
			return; // Detiene la ejecución del método
		}

		// Obtener el año actual y los segundos de un datetime
		$anio_actual = date('Y');
		$segundos = date('s');
	
		// Obtener las iniciales de los nombres y apellidos
		$inombre = substr($nombre, 0, 1);
		$iprimerapellido = substr($primerApellido, 0, 1);
		$isegundoapellido = substr($segundoApellido, 0, 1);
	
		// Concatenar las iniciales y otros datos para formar el nombre de usuario
		$nombreusuario = $iprimerapellido . $isegundoapellido . $inombre . $anio_actual . $segundos;

		//tipo
		$rol = "user";
	
		$data = array(
			'nombreUsuario' => $nombreusuario,
			'nombre' => $nombre,
			'primerApellido' => $primerApellido,
			'segundoApellido' => $segundoApellido,
			'email' => $email,
			'password' => $password,
			'rol' => $rol,
		);

		// Llama al modelo para insertar los datos en ambas tablas
		$this->load->model('usuario_model'); // Asegúrate de haber cargado el modelo
		$resultado = $this->usuario_model->insertarUsuario($data);

		if ($resultado) {
			// Éxito en la inserción, redirige a una página de éxito o muestra un mensaje
			//echo 'Registro exitoso.';
			//redirect('usuario/registro');
			$this->session->set_flashdata('mensaje_exito', 'Registro exitoso.');
		} else {
			// Error en la inserción, muestra un mensaje de error
			//echo 'Email existente.';
			//redirect('usuario/error_registro');
			$this->session->set_flashdata('mensaje_error', 'Email existente.');

		}
		redirect('usuario/register');
	}

	public function generarUsuario(){
		
	}
	
}
