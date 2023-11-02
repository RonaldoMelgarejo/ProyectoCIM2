<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Dispositivo_model extends CI_Model {

	//no olvidar ir a cargar en autoload.php linea 135 en autoload Model 'estudiante_model' que es estudiante_model.php q sera usado en todo el proyecto
	//empieza con metodo que devolvera lista
	
    public function insertarDispositivo($data){
        $this->db->insert('dispositivo', $data);
        return true;
    }

    public function listaDispositivos(){
		$this->db->select('*');
		$this->db->from('dispositivo');
		return $this->db->get();  //manda los datos a un controlador y se lo llamara desde estudiante.php
	}

    public function cambiarEstado($id, $data){
        $this->db->where('id', $id);
        $this->db->update('dispositivo', $data);
    }

    public function modificarDispositivo($id, $data){
        $this->db->where('id',$id);
		$this->db->update('dispositivo',$data);
    }
    
    public function eliminardispositivo($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('dispositivo');
    }
}
