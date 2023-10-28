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
        return $this->db->insert('potencia', $data);
        //$this->db->insert('potencia', $data);
    }
}