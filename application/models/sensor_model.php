<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Sensor_model extends CI_Model {

    public function insertaPotencia($data) {
        /*
        $data = array(
            'voltaje' => $pot1,
            'corriente' => $pot2,
            'potencia' => $potencia,
            'dispositivoID' => $dispositivoID
        );
        */
        return $this->db->insert('medicionenergia', $data);
        //$this->db->insert('potencia', $data);
    }

    public function getDispositivoIDByChipID($chipID) {
        $this->db->select('idDispositivo');
        $this->db->where('codigo', $chipID); // Asegúrate de que tu tabla tenga una columna 'chipid'.
        $query = $this->db->get('dispositivo');
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        } else {
            return null; // El Chip ID no se encontró en la base de datos.
        }
    }

    public function insertaBateria($data) {
        return $this->db->insert('bateria', $data);
    }
    
    public function insertaDHT11($data) {
        return $this->db->insert('sensordht11', $data);
    }
    


    //========== Nuevo =========
    public function getIdDispositivo($codigo) {
        // Obtener el idDispositivo usando el código del dispositivo
        $this->db->select('idDispositivo');
        $this->db->where('codigo', $codigo);
        $query = $this->db->get('dispositivo');
  
        if ($query->num_rows() > 0) {
           return $query->row()->idDispositivo;
        } else {
           // Manejar el caso en el que no se encuentra el dispositivo
           return null;
        }
     }
  
     public function insertMedicion($idDispositivo, $pot1, $pot2, $potConsumida) {
        // Verificar y ajustar los valores negativos
        $pot1 = max(0, $pot1);
        $pot2 = max(0, $pot2);
        $potConsumida = max(0, $potConsumida);
        
        // Insertar datos en la tabla medicionenergia
        $data = array(
           'idDispositivo' => $idDispositivo,
           'voltajeGenerado' => $pot1,
           'corrienteGenerado' => $pot2,
           'potenciaGenerada' => $pot1 * $pot2,
           'potenciaConsumida' => $potConsumida
        );
  
        $this->db->insert('medicionenergia', $data);
     }

}