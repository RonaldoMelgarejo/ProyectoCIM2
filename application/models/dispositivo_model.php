<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//la clase debe llevar _model y el extends debe ser CI_Model
class Dispositivo_model extends CI_Model {

	//no olvidar ir a cargar en autoload.php linea 135 en autoload Model 'estudiante_model' que es estudiante_model.php q sera usado en todo el proyecto
	//empieza con metodo que devolvera lista
	public function insertarDispositivo($data){
        try {
            $this->db->insert('dispositivo', $data);
            return true;
        } catch (Exception $e) {
            echo "<script>mostrarToast('error', 'Error al insertar en la base de datos: " . $e->getMessage() . "');</script>";
            return false;
        }
    }
    
    /*
    public function insertarDispositivo($data){
        $this->db->insert('dispositivo', $data);
        return true;
    }
    */
    /*
    public function verificarCodigoExistente($codigo){
        $this->db->where('codigo', $codigo);
        $query = $this->db->get('dispositivo');
    
        if($query->num_rows() > 0){
            // El código ya existe en la base de datos
            return true;
        } else {
            // El código no existe en la base de datos
            return false;
        }
    }
    */

    public function verificarCodigoExistente($codigo){
        $this->db->where('codigo', $codigo);
        $query = $this->db->get('dispositivo');
    
        if ($query->num_rows() > 0) {
            // El código ya existe en la base de datos
            $row = $query->row();
            echo 'Estado del registro: ' . $row->estado; // Imprimimos el estado directamente
    
            if ($row->estado == 0) {
                // El estado es 0, se puede insertar un nuevo registro
                return true;
            } else {
                // El estado no es 0, no se puede insertar un nuevo registro
                return false;
            }
        } else {
            // El código no existe en la base de datos, se puede insertar un nuevo registro
            return true;
        }
    }

    public function verificarCodigoExistenteAdm($codigo) {
        $result = $this->db->get_where('dispositivo', array('codigo' => $codigo))->row();
        return ($result) ? true : false;
    }  
    
    public function obtenerDetalleDispositivo($codigo) {
        $this->db->where('codigo', $codigo);
        $query = $this->db->get('dispositivo');
    
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null;
        }
    }   

    public function obtenerIdCliente($idUsuario) {
        $this->db->select('idCliente');
        $this->db->where('idUsuario', $idUsuario);
        $query = $this->db->get('cliente');
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->idCliente;
        }
    
        return false;
    }
    
    public function actualizarDispositivo($codigo, $data) {
        $data['estado'] = 1; // Establece el estado a 1
        $this->db->set('fechaInstalacion', 'NOW()', false); // Utiliza NOW() sin escapar

        $this->db->where('codigo', $codigo);
        $this->db->update('dispositivo', $data);
    }
    

    public function listaDispositivos($idUsuario){
        /*
		$this->db->select('*');
		$this->db->from('dispositivo');
		return $this->db->get();  //manda los datos a un controlador y se lo llamara desde estudiante.php
        */
        $this->db->select('*');
        $this->db->from('dispositivo');
        $this->db->where('idCliente', $idUsuario); // Ajusta el nombre del campo según tu estructura de base de datos

        return $this->db->get();  // Devuelve los resultados como un array de objetos

	}

    public function listaDispositivosReporte($idUsuario) {
        $this->db->select('dispositivo.idDispositivo AS dispositivoID, dispositivo.codigo, dispositivo.ubicacion, dispositivo.latitud, dispositivo.longitud, dispositivo.estado AS estado_dispositivo, dispositivo.fechaInstalacion, usuario.email, usuario.nombre, usuario.primerApellido, usuario.segundoApellido, COALESCE(SUM(medicionenergia.potenciaGenerada), 0) AS suma_potencia');
        $this->db->from('dispositivo');
        $this->db->join('cliente', 'cliente.idCliente = dispositivo.idCliente');
        $this->db->join('usuario', 'usuario.idUsuario = cliente.idUsuario');
        $this->db->join('medicionenergia', 'medicionenergia.idDispositivo = dispositivo.idDispositivo', 'left');
        $this->db->where('cliente.idUsuario', $idUsuario);
        $this->db->group_by('dispositivo.idDispositivo, dispositivo.codigo, dispositivo.ubicacion, dispositivo.latitud, dispositivo.longitud, dispositivo.estado, dispositivo.fechaInstalacion, usuario.email, usuario.nombre, usuario.primerApellido, usuario.segundoApellido');
    
        return $this->db->get()->result();  // Devuelve los resultados como un array de objetos
    }
    

    public function cambiarEstado($id, $data){
        $this->db->where('idDispositivo', $id);
        $this->db->update('dispositivo', $data);
    }

    public function modificarDispositivo($id, $data){
        $this->db->where('idDispositivo',$id);
		$this->db->update('dispositivo',$data);
    }
    
    public function eliminardispositivo($id){
        $this->db->where('idDispositivo',$id);
        $this->db->delete('dispositivo');
    }

    //========== Admin ============
    
    
    //Generar Factura
    // En tu modelo de dispositivo (Dispositivo_model)
    public function obtenerInformacionDispositivo($idDispositivo) {
        // Realizar la consulta para obtener información del dispositivo
        // ...
    }
    
    
}
