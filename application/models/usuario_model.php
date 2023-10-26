<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Usuario_model extends CI_Model {

	//no olvidar ir a cargar en autoload.php linea 135 en autoload Model 'estudiante_model' que es estudiante_model.php q sera usado en todo el proyecto
	//empieza con metodo que devolvera lista
	public function validar($email,$password)
	{
		
		$this->db->select("*");
		$this->db->from('usuarios');
		$this->db->where('email',$email);
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
        // Verificar si el correo electrónico ya existe en la base de datos
		$existing_email = $this->db->get_where('usuarios', array('email' => $data['email']))->row();

		if ($existing_email) {
			// El correo electrónico ya existe, devuelve falso o muestra un mensaje de error
			return false;
		} else {
			// El correo electrónico no existe, procede con la inserción
			$this->db->insert('usuarios', $data);
			return true;
		}
    }
}
