<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispositivo extends CI_Controller {

    //Opcion a crear controlador y modelo para dispositivos 
	/*
	public function registrardispositivo(){
		// Recupera los datos del formulario
		$codigo = $this->input->post('codigo');
		$ubicacion = $this->input->post('ubicacion');
		$latitud = $this->input->post('latitud');
		$longitud = $this->input->post('longitud');

		$estado = 1;
		$usuariosid = $this->input->post('idUsuario');;

		$data = array(
			'codigo' => $codigo,
			'ubicacion' => $ubicacion,
			'latitud' => $latitud,
			'longitud' => $longitud,
			'estado' => $estado,
			'usuariosID' => $usuariosid,
		);

		// Llama al modelo para insertar los datos en ambas tablas
		$this->load->model('dispositivo_model'); // Asegúrate de haber cargado el modelo
		$resultado = $this->dispositivo_model->insertarDispositivo($data);

		if ($resultado) {
			// Éxito en la inserción, redirige a una página de éxito o muestra un mensaje
			//echo 'Registro exitoso.';
			//redirect('usuario/registro');
			$this->session->set_flashdata('mensaje_exito', 'Registro exitoso.');
		} else {
			// Error en la inserción, muestra un mensaje de error
			//echo 'Email existente.';
			//redirect('usuario/error_registro');
			$this->session->set_flashdata('mensaje_error', 'ChipID existente.');

		}
		redirect('monitoreo/registrarDispositivo');
	}
	*/

	public function registrardispositivo(){
		// Recupera los datos del formulario
		$codigo = $this->input->post('codigo');
		$ubicacion = $this->input->post('ubicacion');
		$latitud = $this->input->post('latitud');
		$longitud = $this->input->post('longitud');
		//$capacidad = 0;
		$idUsuario = $this->input->post('idCliente');
		$idCliente = $this->dispositivo_model->obtenerIdCliente($idUsuario);
		
		if (!$idCliente) {
			// Manejar el caso donde no se puede obtener el idCliente
			$this->session->set_flashdata('error', 'No se pudo obtener el idCliente del usuario.');
			redirect('monitoreo/registrarDispositivo');
			return;
		}

		$estado = 1;
		//$usuariosid = $this->input->post('idUsuario');
		
		// Verificar si el código ya existe
		$this->load->model('dispositivo_model');
		if ($this->dispositivo_model->verificarCodigoExistente($codigo)) {
			// El código ya existe, obtén los detalles del dispositivo
			$detalleDispositivo = $this->dispositivo_model->obtenerDetalleDispositivo($codigo);
	
			// Verifica si el estado es 0 para permitir la actualización
			if ($detalleDispositivo && $detalleDispositivo['estado'] == 0) {
				// Actualiza los datos del dispositivo
				$data = array(
					'ubicacion' => $ubicacion,
					'latitud' => $latitud,
					'longitud' => $longitud,
					'idCliente' => $idCliente,
				);
	
				$this->dispositivo_model->actualizarDispositivo($codigo, $data);
	
				// Mensaje de éxito
				$this->session->set_flashdata('success', 'Registro exitoso.');
			} else {
				// El estado no es 0, muestra un mensaje de error o lanza un modal
				$this->session->set_flashdata('error', 'El código no existe en la base de datos.');
			}
	
			redirect('monitoreo/registrarDispositivo');
			return; // Termina la ejecución de la función
		}
	
		// Si llegamos aquí, el código no existe y se omite la inserción
		$this->session->set_flashdata('error', 'El código ya se encuentra registrado y no se puede actualizar.');
		redirect('monitoreo/registrarDispositivo');
	}
	
	
	public function deshabilitarbd(){
		$id = $_POST['idDispositivo'];
		$data['estado'] = '0';
		$this->dispositivo_model->cambiarEstado($id, $data);
		redirect('monitoreo/dispositivos', 'refresh');
	}
	
	public function habilitarbd(){
		$id = $_POST['idDispositivo'];
		$data['estado'] = '1';
		$this->dispositivo_model->cambiarEstado($id, $data);
		redirect('monitoreo/dispositivos', 'refresh');
	}	

	//---- Temporal
	public function deshabilitarbdAdm(){
		$id = $_POST['idDispositivo'];
		$data['estado'] = '0';
		$this->dispositivo_model->cambiarEstado($id, $data);
		redirect('monitoreo/listaDispositivo', 'refresh');
	}
	
	public function habilitarbdAdm(){
		$id = $_POST['idDispositivo'];
		$data['estado'] = '1';
		$this->dispositivo_model->cambiarEstado($id, $data);
		redirect('monitoreo/listaDispositivo', 'refresh');
	}	
	//--------
	public function modificarbd(){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id = $this->input->post('idDispositivo');
			$data['codigo'] = $this->input->post('codigo');
			$data['ubicacion'] = $this->input->post('ubicacion');
			$data['latitud'] = $this->input->post('latitud');
			$data['longitud'] = $this->input->post('longitud');
			$this->dispositivo_model->modificarDispositivo($id, $data);
		}
	
		redirect('monitoreo/dispositivos', 'refresh');
	}
	
	public function eliminarbd(){
		$id=$_POST['idDispositivo'];
		$this->dispositivo_model->eliminardispositivo($id); //enviamos al delete esos datos

		redirect('monitoreo/dispositivos','refresh');
	}
	
	//========== Admin ===========
	public function registrarChipID(){
		$codigo = $this->input->post('codigo');
		$usuariosid = $this->input->post('idUsuario');
	
		// Verificar si el código ya existe en la base de datos
		$this->load->model('dispositivo_model');
		$codigo_existente = $this->dispositivo_model->verificarCodigoExistenteAdm($codigo);
	
		if ($codigo_existente) {
			$this->session->set_flashdata('error', 'El ChipID ya existe.');
			//echo "<script>mostrarToast('error', 'El ChipID ya existe.');</script>";
		} else {
			$data = array(
				'codigo' => $codigo,
				'idUsuario' => $usuariosid,
			);
	
			// Llama al modelo para insertar los datos en ambas tablas
			$resultado = $this->dispositivo_model->insertarDispositivo($data);
	
			if ($resultado){
				$this->session->set_flashdata('success', 'Registro exitoso.');
				//echo "<script>mostrarToast('success', 'Registro exitoso.');</script>";
			} else {
				$this->session->set_flashdata('error', 'Error al insertar el ChipID.');
				//echo "<script>mostrarToast('error', 'Error al insertar el ChipID.');</script>";
			}
		}
	
		redirect('monitoreo/listaDispositivo');
	}
	
}
