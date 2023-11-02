<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispositivo extends CI_Controller {

    //Opcion a crear controlador y modelo para dispositivos 
	public function registrardispositivo(){
		// Recupera los datos del formulario
		$codigo = $this->input->post('codigo');
		$ubicacion = $this->input->post('ubicacion');
		$latitud = $this->input->post('latitud');
		$longitud = $this->input->post('longitud');

		$estado = 1;
		$usuariosid = 1;

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
			$this->session->set_flashdata('mensaje_error', 'Email existente.');

		}
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
	
}
