<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {


	//empieza con metodo
	public function index()
	{
		//$data['msg']=$this->uri->segment(3);  //recupera el numero en la posicion 3 para dar mensajes index.php/usuarios/index/1(este es el numero)

		if($this->session->userdata('email'))
		{
			redirect('usuario/panel','refresh');
		}
		else
		{
			$data['msg']=$this->uri->segment(3);
			//$this->load->view('inc_head'); //cargar cabecera
			$this->load->view('loginform',$data); //cargar vista loginform y se envia $data que debe ser dado el formato en la vista
			//$this->load->view('inc_footer'); //cargar pie
		}		
	}
	
	public function panel()
	{
		if($this->session->userdata('nombreUsuario'))
		{
			$rol = $this->session->userdata('rol');
            if($rol == 'administrador' || $rol == 'Administrador' || $rol == 'Instalador')
            {
                redirect('monitoreo/adm_index','refresh');
            }
            else{
                redirect('monitoreo/table','refresh');
            }

			//redirect('monitoreo/index','refresh');
			//o tambie se puede crear por roles
		}
		else
		{
			redirect('usuario/index/2','refresh');
		}

	}

	public function validarusuario()
	{
		$usuario=$_POST['usuario'];
		//$login=$_POST['login'];
		$password=md5($_POST['password']);

		//$consulta=$this->usuario_model->validar($login,$password);
		$consulta=$this->usuario_model->validar($usuario,$password);

		if($consulta->num_rows()>0)  //validamos usuario
		{
			foreach($consulta->result() as $row)
			{
				//creamos variables de session
				$this->session->set_userdata('idusuario',$row->idUsuario); //creamos variable 'idusuario' y lo rescatamos de $row->idusuario bd
				//$this->session->set_userdata('login',$row->login);
				//$this->session->set_userdata('tipo',$row->tipo);
				$this->session->set_userdata('nombreUsuario', $row->nombreUsuario);
				$this->session->set_userdata('nombre', $row->nombre);
            	$this->session->set_userdata('primerApellido', $row->primerApellido);
            	$this->session->set_userdata('segundoApellido', $row->segundoApellido);
				$this->session->set_userdata('email',$row->email);
				$this->session->set_userdata('ci',$row->ci);
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

	public function registrarusuario()
	{
		// Recupera los datos del formulario
		$nombre = $this->input->post('name');
		$primerApellido = $this->input->post('firstName');
		$segundoApellido = $this->input->post('lastName');
		$email = $this->input->post('email');
		$ci = $this->input->post('ci');
		$rol = $this->input->post('type');

		// Verifica que los campos requeridos no estén vacíos
		if (empty($nombre) || empty($primerApellido) || empty($email) || empty($ci)) {
			$this->session->set_flashdata('mensaje_error', 'Por favor, complete todos los campos obligatorios.');
			redirect('monitoreo/registrarUsuario');
			return; // Detiene la ejecución del método
		}

		// Generar el nombre de usuario utilizando la función actualizada
		$nombreusuario = $this->generarNombreUsuario($nombre, $primerApellido, $segundoApellido);

		// Generar una contraseña aleatoria de 8 caracteres
		$password = $this->generarPasswordAleatorio(8);

		$estado = 1;
		// Definir la especialidad o dirección basada en el rol seleccionado
		$especialidad = '';
		$direccion = '';

		 if ($rol === 'Instalador') {
			$especialidad = $this->input->post('specialty');
		} elseif ($rol === 'Cliente') {
			$direccion = $this->input->post('add');
		}

		$data = array(
			'nombreUsuario' => $nombreusuario,
			'nombre' => $nombre,
			'primerApellido' => $primerApellido,
			'segundoApellido' => $segundoApellido,
			'email' => $email,
			'password' => md5($password), // Hash de la contraseña
			'ci' => $ci,
			'rol' => $rol,
			'estado' => $estado,
		);

		// Llama al modelo para insertar los datos en ambas tablas
		$this->load->model('usuario_model'); // Asegúrate de haber cargado el modelo
		$idUsuario = $this->usuario_model->insertarUsuario($data);

		if ($rol === 'Instalador') {
			// Si es Instalador, insertar en la tabla técnico
			$this->load->model('usuario_model');
			$tecnicoData = array(
				'especialidad' => $especialidad,
				'idUsuario' => $idUsuario,
			);
			$this->usuario_model->insertarTecnico($tecnicoData);
		} elseif ($rol === 'Cliente') {
			// Si es Cliente, insertar en la tabla cliente
			$this->load->model('usuario_model');
			$clienteData = array(
				'direccion' => $direccion,
				'idUsuario' => $idUsuario,
			);
			$this->usuario_model->insertarCliente($clienteData);
		}

		if ($idUsuario) {
			// Éxito en la inserción, redirige a una página de éxito o muestra un mensaje

			// Llama a enviarCredenciales para enviar las credenciales por correo
			$correo_enviado = $this->enviarCredenciales($nombreusuario, $password, $email);

			if ($correo_enviado) {
				// El correo se envió con éxito
				$this->session->set_flashdata('mensaje_exito', 'Registro exitoso. Las credenciales se han enviado por correo.');
			} else {
				// Error en el envío del correo
				$this->session->set_flashdata('mensaje_error', 'Error al enviar el correo.');
			}
		} else {
			// Error en la inserción, muestra un mensaje de error
			$this->session->set_flashdata('mensaje_error', 'Email o CI existente.');
		}

		redirect('monitoreo/registrarUsuario');
	}

	// Función para generar el nombre de usuario
	private function generarNombreUsuario($nombre, $primerApellido, $segundoApellido)
	{
		// Obtener el año actual y los segundos de un datetime
		$anio_actual = date('Y');
		$segundos = date('s');

		// Obtener las iniciales de los nombres y apellidos
		$inombre = substr($nombre, 0, 1);
		$iprimerapellido = substr($primerApellido, 0, 1);
		$isegundoapellido = substr($segundoApellido, 0, 1);

		// Concatenar las iniciales y otros datos para formar el nombre de usuario
		return $iprimerapellido . $isegundoapellido . $inombre . $anio_actual . $segundos;
	}

	// Función para generar una cadena aleatoria de longitud $length
	private function generarPasswordAleatorio($length)
	{
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($caracteres), 0, $length);
	}

	public function enviarCredenciales($nombreUsuario, $password, $destinatario) {
        $this->load->library('email');

        $this->email->from('pablo_ronaldo_mel@hotmail.com', 'SolarEnergy');
        $this->email->to($destinatario);
        $this->email->subject('Credenciales de registro');
        $mensaje = 'Tu nombre de usuario es: ' . $nombreUsuario . '<br>';
        $mensaje .= 'Tu contraseña es: ' . $password;
        $this->email->message($mensaje);

        if ($this->email->send()) {
            // Correo enviado con éxito
            return true;
        } else {
            // Error en el envío del correo
            return false;
        }
    }

	public function modificar_contrasenia() {
        $idUsuario = $this->input->post('idUsuario');
        $oldPassword = $this->input->post('old');
        $newPassword = $this->input->post('new');
        $confirmPassword = $this->input->post('confirm');

        // Validar que la contraseña anterior sea correcta
		$this->load->model('usuario_model');
        $usuario = $this->usuario_model->get_usuario_by_id($idUsuario);

		// Imprimir información para depuración
		echo 'Contraseña almacenada: ' . $usuario['password'] . '<br>';
		echo 'Contraseña ingresada (MD5): ' . md5($oldPassword) . '<br>';
        if (trim($usuario['password']) !== md5(trim($oldPassword))) {
			$this->session->set_flashdata('error', 'La contraseña anterior es incorrecta.');
			redirect('monitoreo/passwordAdm');
		}
		

		
        // Validar que la nueva contraseña y la confirmación coincidan
        if ($newPassword !== $confirmPassword) {
            $this->session->set_flashdata('error', 'La nueva contraseña y la confirmación no coinciden.');
            redirect('monitoreo/passwordAdm');
        }

        // Actualizar la contraseña en la base de datos
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->usuario_model->modificar_contrasenia($idUsuario, $hashedPassword);

        // Establecer un flash_data para mostrar un mensaje de éxito
        $this->session->set_flashdata('success', 'La contraseña se ha modificado con éxito.');

        redirect('monitoreo/passwordAdm');
    }

	public function cambiarContrasenia() {
		// Verifica si el formulario ha sido enviado
		if ($this->input->post('cambiarPassword')) {

			// Validación de los campos
			$this->form_validation->set_rules('old', 'Contraseña Anterior', 'required');
			$this->form_validation->set_rules('new', 'Nueva Contraseña', 'required|min_length[6]');
			$this->form_validation->set_rules('confirm', 'Confirmar Contraseña', 'required|matches[new]');

			if ($this->form_validation->run() == TRUE) {
				// Validación exitosa, procede a cambiar la contraseña en el modelo
				$idUsuario = $this->input->post('idUsuario');
				$oldPassword = md5($this->input->post('old'));
				$newPassword = md5($this->input->post('new'));

				// Llama al modelo para cambiar la contraseña
				$this->load->model('usuario_model');
				$cambioExitoso = $this->usuario_model->cambiarContrasenia($idUsuario, $oldPassword, $newPassword);

				if ($cambioExitoso) {
					// Contraseña cambiada exitosamente, realiza acciones adicionales si es necesario
					redirect('monitoreo/perfil');
				} else {
					// La contraseña anterior no coincide, muestra un mensaje de error
					$data['error_message'] = 'La contraseña anterior no es válida.';
				}
			}
		}

		// Carga la vista con el formulario
		$this->load->view('profile', $data);
	}

	public function indexp() {
        // Cargar la vista principal del controlador Usuario
        $this->load->view('pruebas');
    }

	public function obtenerDispositivos($idUsuario) {
        $dispositivos = $this->usuario_model->obtenerDispositivosUsuario($idUsuario);

        // Convertir los resultados a un formato JSON y enviarlos al cliente
        echo json_encode($dispositivos);
    }

	/* Funciona ejemplo de enviar correo
	public function enviar_correo() {
        $this->load->library('email');

        // Configura los detalles del correo
        $destinatario = $this->input->post('destinatario');
        $mensaje = $this->input->post('mensaje');
        $this->email->from('pablo_ronaldo_mel@hotmail.com', 'Ronaldo');
        $this->email->to($destinatario);
        $this->email->subject('Asunto del Correo');
        $this->email->message($mensaje);

        // Envía el correo
        if ($this->email->send()) {
            echo 'Correo enviado exitosamente';
            redirect('usuario/register');
        } else {
            show_error($this->email->print_debugger());
        }
    }
	*/

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
			$data['nombreUsuario'] = $this->input->post('userName');
			$data['nombre'] = $this->input->post('name');
			$data['primerApellido'] = $this->input->post('firstName');
			$data['segundoApellido'] = $this->input->post('lastName');
			$data['email'] = $this->input->post('email');
			$data['ci'] = $this->input->post('ci');
			/*
			$this->usuario_model->modificarUsuarioBD($id, $data);
			*/

			// Intenta modificar el usuario en la base de datos
			$result = $this->usuario_model->modificarUsuarioBD($id, $data);

			if ($result) {
				// Modificación exitosa
				$this->session->set_flashdata('success', 'Modificación exitosa.');
			} else {
				// Error al modificar
				$this->session->set_flashdata('error', 'Error al actualizar o modificar.');
			}
			
			// Actualiza los valores en la sesión
			$this->session->set_userdata('nombreUsuario', $data['nombreUsuario']);
			$this->session->set_userdata('nombre', $data['nombre']);
			$this->session->set_userdata('primerApellido', $data['primerApellido']);
			$this->session->set_userdata('segundoApellido', $data['segundoApellido']);
			$this->session->set_userdata('email', $data['email']);
			$this->session->set_userdata('ci', $data['ci']);

		}
	
		redirect('monitoreo/perfilAdm', 'refresh');
	}

	public function modificarusuariocliente() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id = $this->input->post('idUsuario');
			$data['nombreUsuario'] = $this->input->post('userName');
			$data['nombre'] = $this->input->post('name');
			$data['primerApellido'] = $this->input->post('firstName');
			$data['segundoApellido'] = $this->input->post('lastName');
			$data['email'] = $this->input->post('email');
			$data['ci'] = $this->input->post('ci');
			/*
			$this->usuario_model->modificarUsuarioBD($id, $data);
			*/

			// Intenta modificar el usuario en la base de datos
			$result = $this->usuario_model->modificarUsuarioBD($id, $data);

			if ($result) {
				// Modificación exitosa
				$this->session->set_flashdata('success', 'Modificación exitosa.');
			} else {
				// Error al modificar
				$this->session->set_flashdata('error', 'Error al actualizar o modificar.');
			}
			
			// Actualiza los valores en la sesión
			$this->session->set_userdata('nombreUsuario', $data['nombreUsuario']);
			$this->session->set_userdata('nombre', $data['nombre']);
			$this->session->set_userdata('primerApellido', $data['primerApellido']);
			$this->session->set_userdata('segundoApellido', $data['segundoApellido']);
			$this->session->set_userdata('email', $data['email']);
			$this->session->set_userdata('ci', $data['ci']);

		}
	
		redirect('monitoreo/perfil', 'refresh');
	}

	public function deshabilitarbd(){
		$id = $_POST['idUsuario'];
		$data['estado'] = '0';
		$this->usuario_model->cambiarEstado($id, $data);
		redirect('monitoreo/listaUsuario', 'refresh');
	}
	
	public function habilitarbd(){
		$id = $_POST['idUsuario'];
		$data['estado'] = '1';
		$this->usuario_model->cambiarEstado($id, $data);
		redirect('monitoreo/listaUsuario', 'refresh');
	}

	public function eliminarbd(){
		$id=$_POST['idUsuario'];
		$this->usuario_model->eliminarUsuario($id); //enviamos al delete esos datos

		redirect('monitoreo/listaUsuario','refresh');
	}
}
