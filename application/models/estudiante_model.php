<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Estudiante_model extends CI_Model {

	//no olvidar ir a cargar en autoload.php linea 135 en autoload Model 'estudiante_model' que es estudiante_model.php q sera usado en todo el proyecto
	//empieza con metodo que devolvera lista
	public function lista()
	{
		$this->db->select('*');
		$this->db->from('estudiantes');
		return $this->db->get();  //manda los datos a un controlador y se lo llamara desde estudiante.php
	}
	
	public function recuperarEstudiante($idEstudiante)
	{
		$this->db->select('*');
		$this->db->from('estudiantes');
		$this->db->where('idEstudiante',$idEstudiante);  //recibe datos de $idEstudiante y recupera de BD idEstudiante es nombre de la BD
		return $this->db->get();  //manda los datos a un controlador a modificar() y se lo llamara desde estudiante.php
	}
	
	public function modificarEstudiante($idEstudiante,$data)
	{
		$this->db->where('idEstudiante',$idEstudiante);
		$this->db->update('estudiantes',$data);  // update('nombreTablaBD','datos')
	}

	public function agregarEstudiante($data){
		$this->db->insert('estudiantes',$data); // insert en ('nombreTablaBD','datos')
	}

	public function eliminarEstudiante($idEstudiante){    //hard delete
		$this->db->where('idEstudiante',$idEstudiante);
		$this->db->delete('estudiantes',$data);  // delete('nombreTablaBD','datos')
	}
}
