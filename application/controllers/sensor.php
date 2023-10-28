<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sensor extends CI_Controller {

    public function sensorPotencia() {
        print_r($_POST);
        $pot1 = $this->input->post('pot1');
        $pot2 = $this->input->post('pot2');

        $potencia = $pot1 * $pot2;

        $dispositivoID = 1;

        $data = array(
            'voltaje' => $pot1,
            'corriente' => $pot2,
            'potencia' => $potencia,
            'dispositivoID' => $dispositivoID
        );

        if ($this->sensor_model->insertaPotencia($data)) {
            echo "Datos insertados con éxito";
        } else {
            echo "Error al insertar datos";
        }
/*
        if ($pot1 && $pot2) {
            $this->load->model('sensor_model');
            $this->Sensor_model->insertaPotencia($pot1, $pot2, $potencia, $dispositivoID );
            echo "Datos almacenados correctamente.";
        } else {
            echo "Error en los datos recibidos.";
        } */
    }
}