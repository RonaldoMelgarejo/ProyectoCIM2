<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Factura_model extends CI_Model {

    public function obtenerDatosFactura($idUsuario, $dispositivoID) {
        $this->db->select('cliente.*, dispositivo.*, usuario.*,  COALESCE(SUM(medicionenergia.potenciaGenerada), 0) as potenciaGeneradaMesAnterior, COALESCE(SUM(medicionenergia.potenciaConsumida), 0) as potenciaConsumidaMesAnterior');
        $this->db->from('cliente');
        $this->db->join('dispositivo', 'cliente.idCliente = dispositivo.idCliente');
        $this->db->join('usuario', 'cliente.idUsuario = usuario.idUsuario');
        $this->db->join('medicionenergia', 'dispositivo.idDispositivo = medicionenergia.idDispositivo');
        $this->db->where('cliente.idUsuario', $idUsuario);
        $this->db->where('dispositivo.idDispositivo', $dispositivoID);
    
        // Filtrar por el mes anterior
        $this->db->where('MONTH(medicionenergia.fechaHoraMedicion)', date('m', strtotime('-1 month')));
    
        $query = $this->db->get();
    
        // Convertir el resultado en un array de objetos
        return $query->result();
    }
    
    
    
     // En tu modelo Factura_model
    public function existeFacturaParaMesYDispositivo($mes, $idDispositivo) {
        $this->db->where('detallesFactura', $mes);
        $this->db->where('idDispositivo', $idDispositivo);
        $query = $this->db->get('factura');
        return $query->num_rows() > 0;
    }


    // En tu modelo Factura_model
    public function obtenerTodasLasFacturas() {
        $this->db->select('factura.*, cliente.*, usuario.*, dispositivo.*, factura.estado as estadoFactura, consumo.consumoActual as consumoMes, consumo.anio as anioMes');
        $this->db->from('factura');
        $this->db->join('cliente', 'factura.idCliente = cliente.idCliente');
        $this->db->join('usuario', 'cliente.idUsuario = usuario.idUsuario');
        $this->db->join('dispositivo', 'factura.idDispositivo = dispositivo.idDispositivo');
        $this->db->join('consumo', 'factura.idFactura = consumo.idFactura', 'left'); // Relación con la tabla consumo
        $query = $this->db->get();
    
        return $query;
    }

    public function obtenerInformacionFactura($idFactura) {
        $this->db->select('factura.*, cliente.*, usuario.*, dispositivo.*, factura.estado as estadoFactura, consumo.consumoAnterior as consumoGen,consumo.consumoActual as consumoMes');
        $this->db->from('factura');
        $this->db->join('cliente', 'factura.idCliente = cliente.idCliente', 'left');
        $this->db->join('usuario', 'cliente.idUsuario = usuario.idUsuario');
        $this->db->join('dispositivo', 'factura.idDispositivo = dispositivo.idDispositivo');
        $this->db->join('consumo', 'factura.idFactura = consumo.idFactura', 'left');
        $this->db->where('factura.idFactura', $idFactura);
    
        $query = $this->db->get();
        return $query->row();
    }
    
    
    //======= Pagos =====
    public function obtenerUsuarioPorCI($ci) {
        $this->db->select('nombre, primerApellido, segundoApellido, email, direccion');
        $this->db->from('usuario');
        $this->db->join('cliente', 'usuario.idUsuario = cliente.idUsuario');
        $this->db->where('ci', $ci);
        $this->db->where('rol', 'Cliente');
        $query = $this->db->get();
    
        // Devuelve los detalles del usuario como arreglo
        return $query->row_array();
    }

    
    public function buscarDispositivosPorCI($ci) {
        $this->db->select('dispositivo.idDispositivo, factura.detallesFactura, factura.montoTotal, dispositivo.codigo, factura.idFactura, consumo.fechaConsumo, consumo.mes, consumo.anio');
        $this->db->from('dispositivo');
        $this->db->join('factura', 'dispositivo.idDispositivo = factura.idDispositivo');
        $this->db->join('cliente', 'dispositivo.idCliente = cliente.idCliente');
        $this->db->join('usuario', 'cliente.idUsuario = usuario.idUsuario');
        $this->db->join('consumo', 'dispositivo.idDispositivo = consumo.idDispositivo');
        $this->db->where('usuario.ci', $ci);
        $this->db->where('factura.estado', 0); // Agrega esta línea para filtrar por estado 0

        $query = $this->db->get();
    
        // Devuelve los dispositivos como arreglo
        return $query->result_array();
    }
    
    
    
    
    
    /// En tu modelo de factura (Factura_model)
    public function crearFactura($datos) {
        // Insertar datos de factura en la base de datos
        $this->db->insert('factura', $datos);

        // Obtener el ID de la factura recién creada
        return $this->db->insert_id();
    }
}