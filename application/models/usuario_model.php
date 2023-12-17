<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Usuario_model extends CI_Model {

	//no olvidar ir a cargar en autoload.php linea 135 en autoload Model 'estudiante_model' que es estudiante_model.php q sera usado en todo el proyecto
	//empieza con metodo que devolvera lista
	public function validar($usuario,$password)
	{
		
		$this->db->select("*");
		$this->db->from('usuario');
		$this->db->where('nombreUsuario',$usuario);
		//$this->db->where('login',$login);
		$this->db->where('password',$password);
		return $this->db->get();  //manda los datos a un controlador y se lo llamara desde estudiante.php
		/*
		// Realizar la consulta SQL para validar al usuario y recuperar sus datos
        $this->db->select('id, nombre, primerApellido, segundoApellido, email, rol');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('usuarios'); // Suponiendo que la tabla se llama 'usuarios'

        return $query; */
	}
	
	public function insertarUsuario($data) {
        // Verificar si el correo electrónico o el CI ya existen en la base de datos
        $existing_email = $this->db->get_where('usuario', array('email' => $data['email']))->row();
        $existing_ci = $this->db->get_where('usuario', array('ci' => $data['ci']))->row();

        if ($existing_email || $existing_ci) {
            // El correo electrónico o CI ya existe, muestra un mensaje de error y redirige
            $this->session->set_flashdata('mensaje_error', 'Correo electrónico o CI ya existente.');
            redirect('monitoreo/registrarUsuario');
            return false; // Detiene la ejecución del método
        } else {
            // El correo electrónico y CI no existen, procede con la inserción
            $this->db->insert('usuario', $data);
            return $this->db->insert_id(); // Devuelve el ID del usuario recién insertado
        }
    }

    public function insertarTecnico($data) {
        // Verificar si el usuario ya tiene un rol de técnico
        $existing_tecnico = $this->db->get_where('tecnico', array('idUsuario' => $data['idUsuario']))->row();

        if (!$existing_tecnico) {
            // El usuario no es un técnico, procede con la inserción
            $this->db->insert('tecnico', $data);
        }
        // No hay necesidad de devolver un valor específico aquí
    }

    // En el modelo tecnico_model
    public function verificarTecnicoExistente($idTecnico) {
        // Verifica si el idTecnico existe en la tabla tecnico
        $query = $this->db->get_where('tecnico', array('idTecnico' => $idTecnico));
        return $query->num_rows() > 0;
    }

    public function insertarCliente($data) {
        // Verificar si el usuario ya tiene un rol de cliente
        $existing_cliente = $this->db->get_where('cliente', array('idUsuario' => $data['idUsuario']))->row();

        if (!$existing_cliente) {
            // El usuario no es un cliente, procede con la inserción
            $this->db->insert('cliente', $data);
        }
        // No hay necesidad de devolver un valor específico aquí
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
    
    //====== Modificar contraseña =====/
    public function get_usuario_by_id($idUsuario) {
        $query = $this->db->get_where('usuario', array('idUsuario' => $idUsuario));
        return $query->row_array();
    }

    public function modificar_contrasenia($idUsuario, $hashedPassword) {
        $data = array(
            'password' => $hashedPassword
        );

        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuario', $data);
    }

    public function cambiarContrasenia($idUsuario, $oldPassword, $newPassword) {
        // Verifica si la contraseña anterior es correcta
        $this->db->where('idUsuario', $idUsuario);
        $this->db->where('password', $oldPassword);
        $query = $this->db->get('usuario');
  
        if ($query->num_rows() > 0) {
           // Contraseña anterior es correcta, procede a actualizar la contraseña
           $data = array('password' => $newPassword);
           $this->db->where('idUsuario', $idUsuario);
           $this->db->update('usuario', $data);
  
           return true; // Indica que el cambio fue exitoso
        } else {
           return false; // La contraseña anterior no coincide
        }
    }
    //=====================================/
    /*
	public function modificarUsuarioBD($id,$data){
		$data['fechaModificacion'] = date('Y-m-d H:i:s'); // Establece la fecha y hora de modificación actual

		$this->db->where('idUsuario',$id);
		$this->db->update('usuario',$data);  // update('nombreTablaBD','datos')
	}
    */

    public function modificarUsuarioBD($id, $data) {
        try {
            // Inicia una transacción
            $this->db->trans_start();
    
            $data['fechaModificacion'] = date('Y-m-d H:i:s');
            $this->db->where('idUsuario', $id);
            $this->db->update('usuario', $data);
    
            // Finaliza la transacción
            $this->db->trans_complete();
    
            // Verifica si la transacción fue exitosa
            if ($this->db->trans_status() === FALSE) {
                // Si hay un error, devuelve false
                return false;
            }
    
            // Si la transacción fue exitosa, devuelve true
            return true;
        } catch (Exception $e) {
            // Maneja cualquier excepción y devuelve false
            return false;
        }
    } 

	public function cambiarEstado($id, $data){
        $this->db->where('id', $id);
        $this->db->update('usuario', $data);
    }

	public function eliminarUsuario($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('usuario');
    }

	public function obtenerDispositivosUsuario($idUsuario) {
        $this->db->select('id, codigo'); // Ajusta los campos según tus necesidades
        $this->db->where('usuariosID', $idUsuario);
        $query = $this->db->get('dispositivo');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

}
