<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Consumo_model extends CI_Model {

    // En tu modelo de consumo (Consumo_model)
    public function obtenerConsumosPendientesPorDispositivo($idDispositivo) {
        // Realizar la consulta para obtener consumos pendientes para el dispositivo
        // ...
    }

    public function actualizarEstadoConsumo($idConsumo, $estado) {
        // Actualizar el estado del consumo en la base de datos
        $this->db->set('estado', $estado);
        $this->db->where('idConsumo', $idConsumo);
        $this->db->update('consumo');
    }
}