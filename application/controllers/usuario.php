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
				$this->session->set_userdata('fechaRegistro',$row->fechaRegistro);
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
			//$this->session->set_flashdata('mensaje_exito', 'Registro exitoso.');

			// Envía un correo de bienvenida al usuario
			$asunto = "Bienvenido a Hope UI";
			$mensaje = "Hola " . $nombre . ",\n\n";
			$mensaje .= "¡Gracias por registrarte en Hope UI! Tu cuenta ha sido creada con éxito.\n";
			$mensaje .= "Tu nombre de usuario es: " . $nombreusuario . "\n";
			$mensaje .= "Guarda esta información de forma segura.\n";
			$mensaje .= "¡Esperamos que disfrutes de nuestra plataforma!\n";
	
			// Carga la biblioteca de correo de CodeIgniter
			$this->load->library('email');

			// Configura el correo utilizando la configuración definida en email.php
			$this->email->from('pablo_ronaldo_mel@hotmail.com', 'Prueba Envio');
			$this->email->to($email); // Usar la dirección de correo del usuario
			$this->email->subject($asunto);
			$this->email->message($mensaje);
	
			// Envia el correo
			if ($this->email->send()) {
				// Correo enviado con éxito
				$this->session->set_flashdata('mensaje_exito', 'Registro exitoso. Se ha enviado un correo de bienvenida.');
			} else {
				// Error al enviar el correo
				$this->session->set_flashdata('mensaje_error', 'Error al enviar el correo de bienvenida.');
			}
		} else {
			// Error en la inserción, muestra un mensaje de error
			//echo 'Email existente.';
			//redirect('usuario/error_registro');
			$this->session->set_flashdata('mensaje_error', 'Email existente.');

		}
		redirect('usuario/register');
	}

	/* OPCIONAL
	public function modificarusuario() {
		//echo 'Controlador: La función modificarusuario se ha llamado correctamente.<br>'; // Imprime un mensaje
		$id = $this->input->post('idUsuario'); // Cambia 'idusuario' a 'idUsuario' para que coincida con el nombre del campo del formulario
	    //echo 'ID del usuario: ' . $id . '<br>'; // Imprime el ID del usuario

		$data['nombre'] = $this->input->post('name');
		$data['primerApellido'] = $this->input->post('firstName');
		$data['segundoApellido'] = $this->input->post('lastName');
		$data['email'] = $this->input->post('email');
	
		
		echo 'Datos del formulario:<pre>';
		print_r($data); // Imprime los datos del formulario
		echo '</pre>';
		

		$this->usuario_model->modificarUsuarioBD($id, $data);
	
		redirect('monitoreo/perfil', 'refresh');
	}
	*/

	public function modificarusuario() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id = $this->input->post('idUsuario');
			$data['nombre'] = $this->input->post('name');
			$data['primerApellido'] = $this->input->post('firstName');
			$data['segundoApellido'] = $this->input->post('lastName');
			$data['email'] = $this->input->post('email');
			$this->usuario_model->modificarUsuarioBD($id, $data);
	
			// Actualiza los valores en la sesión
			$this->session->set_userdata('nombre', $data['nombre']);
			$this->session->set_userdata('primerApellido', $data['primerApellido']);
			$this->session->set_userdata('segundoApellido', $data['segundoApellido']);
			$this->session->set_userdata('email', $data['email']);
		}
	
		redirect('monitoreo/perfil', 'refresh');
	}
	
}
