<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Usuario_model extends CI_Model {

	//no olvidar ir a cargar en autoload.php linea 135 en autoload Model 'estudiante_model' que es estudiante_model.php q sera usado en todo el proyecto
	//empieza con metodo que devolvera lista
	public function validar($login,$password)
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('login',$login);
		$this->db->where('password',$password);
		return $this->db->get();  //manda los datos a un controlador y se lo llamara desde estudiante.php
	}
	
	
}
