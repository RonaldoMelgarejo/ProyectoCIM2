<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Monitoreo_model extends CI_Model {

	//no olvidar ir a cargar en autoload.php linea 135 en autoload Model 'estudiante_model' que es estudiante_model.php q sera usado en todo el proyecto
	//empieza con metodo que devolvera lista
    
    public function getChipIDsByUserID($userID){
        $this->db->select('codigo');
        $this->db->where('usuariosID', $userID);
        $query = $this->db->get('dispositivo');

        if ($query->num_rows()>0){
            return $query->result_array();
        } else{
            return array();
        }
    }

    public function obtenerPotenciaPorIdCodigoFecha($idDispositivo, $fechaInput) {
        $this->db->select('fechaHoraMedicion, potenciaGenerada');
        $this->db->from('medicionenergia');
        $this->db->where('idDispositivo', $idDispositivo);
        $this->db->where('fechaHoraMedicion >=', $fechaInput . ' 00:00:00');
        $this->db->where('fechaHoraMedicion <=', $fechaInput . ' 23:59:59');
        
        return $this->db->get()->result_array();
    }
    
    public function obtenerVoltajePorIdCodigoFecha($idDispositivo, $fechaInput) {
        $this->db->select('fechaHoraMedicion, voltajeGenerado');
        $this->db->from('medicionenergia');
        $this->db->where('idDispositivo', $idDispositivo);
        $this->db->where('fechaHoraMedicion >=', $fechaInput . ' 00:00:00');
        $this->db->where('fechaHoraMedicion <=', $fechaInput . ' 23:59:59');
        
        return $this->db->get()->result_array();
    }
    
    public function obtenerCorrientePorIdCodigoFecha($idDispositivo, $fechaInput) {
        $this->db->select('fechaHoraMedicion, corrienteGenerada');
        $this->db->from('medicionenergia');
        $this->db->where('idDispositivo', $idDispositivo);
        $this->db->where('fechaHoraMedicion >=', $fechaInput . ' 00:00:00');
        $this->db->where('fechaHoraMedicion <=', $fechaInput . ' 23:59:59');
        
        return $this->db->get()->result_array();
    }
    

    //============= Usuario ================
    //----- para la lista table ------
	
    public function lista($userID) {
        $this->db->select('medicionenergia.*, dispositivo.codigo as codigoDispositivo');
        $this->db->from('medicionenergia');
        $this->db->join('dispositivo', 'dispositivo.idDispositivo = medicionenergia.idDispositivo');
        $this->db->where('dispositivo.idUsuario', $userID); // Filtra por usuariosID
    
        return $this->db->get();  
    }

    /*
    public function obtenerDatosEnergiaGenerada($dispositivoSeleccionado) {
        $this->db->select('*');
        $this->db->from('energiagenerada');
        $this->db->where('dispositivoID', $dispositivoSeleccionado);
    
        return $this->db->get();
    }
    */

    public function obtenerDatosEnergiaGenerada($dispositivoSeleccionado) {
        $this->db->select('energiagenerada.*, dispositivo.codigo as codigoDispositivo, dispositivo.ubicacion as ubicacionDispositivo');
        $this->db->from('energiagenerada');
        $this->db->join('dispositivo', 'dispositivo.id = energiagenerada.dispositivoID');
        $this->db->where('dispositivoID', $dispositivoSeleccionado);

        return $this->db->get();
    }
    //--------------------------------

    //------ Intento datatable AJAX ---
    public function obtenerDatos() {
        $query = $this->db->get('energiagenerada');
        return $query->result();
    }
    //---------------------------------

    //----- Nuevo Chart Funcional---
    /*
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
    */
    //------------------------------

    //--- Prueba de modularizar ---
    public function getMedicionData($table, $fields) {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('fechaHoraMedicion', 'ASC');
        return $this->db->get()->result_array();
    }
    
    public function getVoltajeData() {
        return $this->getMedicionData('energiagenerada', 'fechaHoraMedicion, voltaje');
    }
    
    public function getCorrienteData() {
        return $this->getMedicionData('energiagenerada', 'fechaHoraMedicion, corriente');
    }
    
    public function getPotenciaData() {
        return $this->getMedicionData('energiagenerada', 'fechaHoraMedicion, potencia');
    } 

    //-----------------------------

    //Nuevas Consultas
    public function consultar_datos($idDispositivo, $fechaInput) {
        // Realiza tu consulta SQL utilizando $idDispositivo y $fechaInput
    
        // Ejemplo de consulta:
        //$query = $this->db->query("SELECT * FROM medicionenergia WHERE idDispositivo = $idDispositivo AND fechaHoraMedicion >= '$fechaInput'");
        $this->db->select('m.*, d.codigo as codigo_dispositivo');
        $this->db->from('medicionenergia m');
        $this->db->join('dispositivo d', 'm.idDispositivo = d.idDispositivo');
        $this->db->where('m.idDispositivo', $idDispositivo);
        $this->db->where('m.fechaHoraMedicion >=', $fechaInput . ' 00:00:00');
        $this->db->where('m.fechaHoraMedicion <=', $fechaInput . ' 23:59:59');
        $query = $this->db->get();
        // Devuelve los resultados
        return $query->result_array();
        
    }
    
    //================================


    //=========== Admin ==============
    public function get_total_usuarios() {
        $this->db->where('rol !=', 'Cliente');
        return $this->db->count_all_results('usuario');
    }
    
    public function get_total_clientes() {
        return $this->db->count_all('cliente');
    }

    public function get_total_dispositivos() {
        return $this->db->count_all('dispositivo');
    }

    public function get_total_dispositivos_activos() {
        $this->db->where('estado', 1); // Filtra por dispositivos con estado activo
        return $this->db->count_all_results('dispositivo');
    }
    
    public function usuarioLista(){
        $this->db->select("*");
		$this->db->from('usuario');
		return $this->db->get();
    }

    public function usuarioListaClientes(){
        $this->db->select("*");
        $this->db->from('usuario');
        $this->db->where('rol', 'cliente'); // Agrega esta línea para seleccionar solo clientes
        return $this->db->get();
    }
    
    public function obtenerDispositivosClientes() {
        $query = $this->db->query("
            SELECT
                d.idDispositivo AS dispositivoID,
                d.codigo,
                d.ubicacion,
                d.latitud,
                d.longitud,
                d.estado AS estado_dispositivo,
                d.fechaRegistro,
                d.fechaInstalacion,
                u.idUsuario, -- Agrega esta línea para seleccionar el idUsuario
                u.email,
                u.nombre,
                u.primerApellido,
                u.segundoApellido,
                COALESCE(SUM(meg.potenciaGenerada), 0) AS suma_potencia
            FROM dispositivo d
            LEFT JOIN cliente c ON d.idCliente = c.idCliente
            LEFT JOIN usuario u ON COALESCE(c.idUsuario, d.idUsuario) = u.idUsuario
            LEFT JOIN medicionenergia meg ON d.idDispositivo = meg.idDispositivo
            WHERE u.rol = 'cliente' -- Añadido para seleccionar solo dispositivos de clientes
            GROUP BY d.idDispositivo, d.codigo, d.ubicacion, d.latitud, d.longitud, d.estado, d.fechaRegistro, d.fechaInstalacion, u.idUsuario, u.email, u.nombre, u.primerApellido, u.segundoApellido;
        ");
        
        return $query;
    }    

    public function obtenerInformacionDispositivos() {
        $query = $this->db->query("
            SELECT
                d.idDispositivo AS dispositivoID,
                d.codigo,
                d.ubicacion,
                d.latitud,
                d.longitud,
                d.estado AS estado_dispositivo,
                d.fechaRegistro,
                d.fechaInstalacion,
                u.email,
                u.nombre,
                u.primerApellido,
                u.segundoApellido,
                COALESCE(SUM(meg.potenciaGenerada), 0) AS suma_potencia
            FROM dispositivo d
            LEFT JOIN cliente c ON d.idCliente = c.idCliente
            LEFT JOIN usuario u ON COALESCE(c.idUsuario, d.idUsuario) = u.idUsuario
            LEFT JOIN medicionenergia meg ON d.idDispositivo = meg.idDispositivo
            GROUP BY d.idDispositivo, d.codigo, d.ubicacion, d.latitud, d.longitud, d.estado, d.fechaRegistro, d.fechaInstalacion, u.email, u.nombre, u.primerApellido, u.segundoApellido;
        ");
    
        return $query;
    }
    
    public function informacionDispositivospdf() {
        $query = $this->db->query("
            SELECT
                d.idDispositivo AS dispositivoID,
                d.codigo,
                d.ubicacion,
                d.latitud,
                d.longitud,
                d.estado AS estado_dispositivo,
                d.fechaInstalacion,
                u.email,
                u.nombre,
                u.primerApellido,
                u.segundoApellido,
                COALESCE(SUM(meg.potenciaGenerada), 0) AS suma_potencia
            FROM dispositivo d
            JOIN cliente c ON d.idCliente = c.idCliente
            JOIN usuario u ON c.idUsuario = u.idUsuario
            LEFT JOIN medicionenergia meg ON d.idDispositivo = meg.idDispositivo
            GROUP BY d.idDispositivo, d.codigo, d.ubicacion, d.latitud, d.longitud, d.estado, d.fechaInstalacion, u.email, u.nombre, u.primerApellido, u.segundoApellido;    
        ");

        return $query->result();
        //return $query->result_array(); // Retorna el resultado como un array de objetos
    }

    public function obtenerPotenciaActualizada($fechaInicio, $fechaFinal) {
        $query = $this->db->query("
            SELECT
                d.id AS dispositivoID,
                COALESCE(SUM(eg.potencia), 0) AS suma_potencia
            FROM dispositivo d
            LEFT JOIN energiagenerada eg ON d.id = eg.dispositivoID
            WHERE eg.fechaHoraMedicion BETWEEN ? AND ?
            GROUP BY d.id
        ", array($fechaInicio, $fechaFinal));
    
        // Obtener el resultado de la consulta
        $result = $query->result();
    
        // Verificar si hay resultados
        if (!empty($result)) {
            // Devolver el primer resultado (asumiendo que la consulta devuelve un solo dispositivo)
            return array(
                'dispositivoID' => $result[0]->dispositivoID,
                'suma_potencia' => $result[0]->suma_potencia
            );
        } else {
            // Si no hay resultados, devolver un valor predeterminado o manejar de acuerdo a tu lógica
            return array(
                'dispositivoID' => 0,
                'suma_potencia' => 0
            );
        }
    }

    public function obtenerClientes() {
        // Obtener usuarios con el rol "Cliente"
        $this->db->select('idUsuario, nombreUsuario');
        $this->db->from('usuario');
        $this->db->where('rol', 'Cliente');

        $query = $this->db->get();

        // Verificar si hay resultados
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array(); // Retorna un array vacío si no hay clientes
        }
    }

    public function listaDispositivosParaSelect($idUsuario) {
        $this->db->select('idDispositivo, codigo');
        $this->db->from('dispositivo');
        $this->db->join('cliente', 'cliente.idCliente = dispositivo.idCliente');
        $this->db->where('cliente.idUsuario', $idUsuario);
        
        return $this->db->get()->result_array();
    }
    
    
    //================================


}
