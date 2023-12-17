<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sensor extends CI_Controller {

   /*funcional
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
        } -->
    }*/

    /* solo potencia del panel 
    public function sensorPotencia() {
        print_r($_POST);
        $pot1 = $this->input->post('pot1');
        $pot2 = $this->input->post('pot2');
        $potConsumida = $this->input->post('potConsumida');
        $chipID = $this->input->post('chipID'); // Asegúrate de que el ESP32 envíe su Chip ID en el POST request.
        echo "Chip ID recibido: " . $chipID;

        $potencia = $pot1 * $pot2;
    
        // Consulta la base de datos para verificar si el Chip ID existe.
        $dispositivoID = $this->sensor_model->getDispositivoIDByChipID($chipID);
    
        if ($dispositivoID !== null) {
            $data = array(
                'voltajeGenerado' => $pot1,
                'corrienteGenerado' => $pot2,
                'potenciaGenerada' => $potencia,
                'potenciaConsumida' => $potConsumida, // Nueva columna
                'idDispositivo' => $dispositivoID
            );
    
            if ($this->sensor_model->insertaPotencia($data)) {
                echo "Datos insertados con éxito";
            } else {
                echo "Error al insertar datos";
            }
        } else {
            echo "Chip ID no encontrado en la base de datos.";
        }
    }
    */

    public function sensorPotenciaTemperaturaHumedad() {
        print_r($_POST);
        $pot1 = $this->input->post('pot1');
        $pot2 = $this->input->post('pot2');
        $pot3 = $this->input->post('pot3');
        $temperature = $this->input->post('temperature');
        $humidity = $this->input->post('humidity');
        $chipID = $this->input->post('chipID');
    
        echo "Chip ID recibido: " . $chipID;
    
        $potencia = $pot1 * $pot2;
    
        $dispositivoID = $this->sensor_model->getDispositivoIDByChipID($chipID);
    
        if ($dispositivoID !== false) {
            $dataPotencia = array(
                'voltajeGenerado' => $pot1,
                'corrienteGenerado' => $pot2,
                'potenciaGenerada' => $potencia,
                'idDispositivo' => $dispositivoID
            );
    
            $dataBateria = array(
                'voltajeBateria' => $pot3,
                'nivel' => $pot3,  // Puedes ajustar según sea necesario
                'dispositivoID' => $dispositivoID
            );
    
            $dataDHT11 = array(
                'temperatura' => $temperature,
                'humedad' => $humidity,
                'dispositivoID' => $dispositivoID
            );
    
            if ($this->sensor_model->insertaPotencia($dataPotencia) && $this->sensor_model->insertaBateria($dataBateria) && $this->sensor_model->insertaDHT11($dataDHT11)) {
                echo "Datos insertados con éxito";
            } else {
                echo "Error al insertar datos";
            }
        } else {
            echo "Chip ID no encontrado en la base de datos.";
        }
    }
    
    
    /*
    public function sensorPotencia() {
        print_r($_POST);
        $pot1 = $this->input->post('pot1');
        $pot2 = $this->input->post('pot2');
        $chipID = $_POST['chipID']; // Asegúrate de que el ESP32 envíe su Chip ID en el POST request.
    
        // Consulta la base de datos para verificar si el Chip ID existe.
        $dispositivoID = $this->sensor_model->getDispositivoIDByChipID($chipID);
    
        if ($dispositivoID !== false) {
            // Verifica si el estado del dispositivo es 0 (inactivo).
            $estado = $this->sensor_model->getEstadoByDispositivoID($dispositivoID);
    
            if ($estado == 0) {
                // Cambia el estado de 0 a 1 en la tabla 'dispositivos'.
                $this->sensor_model->cambiarEstadoDispositivo($dispositivoID, 1);
            }
    
            $potencia = $pot1 * $pot2;
    
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
        } else {
            echo "Chip ID no encontrado en la base de datos.";
        }
    }
    */



    //======== Nuevo =============
    /*
    public function sensorPotencia() {
        // Recibir datos de Arduino
        $chipID = $this->input->post('chipID');
        $pot1 = $this->input->post('pot1');
        $pot2 = $this->input->post('pot2');
        $potConsumida = $this->input->post('potConsumida');
        
        $this->load->model('sensor_model');

        // Obtener idDispositivo usando el código del dispositivo
        //$codigo = $this->input->post('codigo');
        $idDispositivo = $this->sensor_model->getIdDispositivo($chipID);
  
        // Insertar datos en la tabla medicionenergia
        $this->sensor_model->insertMedicion($idDispositivo, $pot1, $pot2, $potConsumida);
    }
    */

    public function sensorPotencia() {
        // Recibir datos de Arduino
        $chipID = $this->input->post('chipID');
        $voltaje = $this->input->post('voltaje');
        $corrienteDC = $this->input->post('corrienteDC');
        $potenciaConsumida = $this->input->post('potenciaConsumida');
        
        $this->load->model('sensor_model');

        // Obtener idDispositivo usando el código del dispositivo
        //$codigo = $this->input->post('codigo');
        $idDispositivo = $this->sensor_model->getIdDispositivo($chipID);

        // Insertar datos en la tabla medicionenergia
        $this->sensor_model->insertMedicion($idDispositivo, $voltaje, $corrienteDC, $potenciaConsumida);
    }
}