<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Monitoreo_model extends CI_Model {

	//no olvidar ir a cargar en autoload.php linea 135 en autoload Model 'estudiante_model' que es estudiante_model.php q sera usado en todo el proyecto
	//empieza con metodo que devolvera lista
    
    //----- para la lista table ------
	public function lista(){
		$this->db->select('*');
		$this->db->from('energiagenerada');
		return $this->db->get();  //manda los datos a un controlador y se lo llamara desde estudiante.php
	}
    //--------------------------------

    //------ Intento datatable AJAX ---
    public function obtenerDatos() {
        $query = $this->db->get('energiagenerada');
        return $query->result();
    }
    //---------------------------------

    //----- Nuevo Chart Funcional---
    public function getVoltajeData() {
        $this->db->select('fechaHoraMedicion, voltaje');
        $this->db->from('energiagenerada');
        $this->db->order_by('fechaHoraMedicion', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getCorrienteData() {
        $this->db->select('fechaHoraMedicion, corriente');
        $this->db->from('energiagenerada');
        $this->db->order_by('fechaHoraMedicion', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getPotenciaData() {
        $this->db->select('fechaHoraMedicion, potencia');
        $this->db->from('energiagenerada');
        $this->db->order_by('fechaHoraMedicion', 'ASC');
        return $this->db->get()->result_array();
    }
    //------------------------------

}
