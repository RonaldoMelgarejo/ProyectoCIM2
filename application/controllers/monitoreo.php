<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoreo extends CI_Controller {

	//================ Users =================
	//empieza con metodo
	//---------- funciones del template -------
	public function index()
	{
        /*
		$lista=$this->estudiante_model->lista();   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		$data['estudiante']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		*/

		$this->load->view('inc_head'); //cargar cabecera
		//$this->load->view('est_lista'$data); //cargar vista est_lista y se envia $data que debe ser dado el formato en la vista
        $this->load->view('inc_sidebar');
        $this->load->view('inc_navbar');
		$this->load->view('dashboardtemplate');
		$this->load->view('inc_footer'); //cargar pie
	}

	public function prueba()
	{
        /*
		$lista=$this->estudiante_model->lista();   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		$data['estudiante']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		*/

		$this->load->view('inc_head'); //cargar cabecera
		//$this->load->view('est_lista'$data); //cargar vista est_lista y se envia $data que debe ser dado el formato en la vista
        $this->load->view('inc_sidebar');
        $this->load->view('inc_navbar');
		$this->load->view('prueba');
		$this->load->view('inc_footer'); //cargar pie
	}
	//-----------------------------------------

	//--------- Vista Dashboard --------
	public function dashboard(){
		/*
		$userID = $this->session->userdata('idusuario');
		$this->load->model('Monitoreo_model');
		$data['chipIDs'] = $this->monitoreo_model->getChipIDsByUserID($userID);
		*/
		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
        $this->load->view('inc_navbar');
		$this->load->view('dashboard');
		$this->load->view('inc_footer');
	}

	public function obtenerPotenciaPorChipID() {
        $chipID = $this->input->get('chipID');
        $this->load->model('Monitoreo_model');
        $data['potencia'] = $this->Monitoreo_model->obtenerPotenciaPorChipID($chipID);

		header('Content-Type: application/json'); // Asegúrate de que el tipo MIME sea JSON
        echo json_encode($data);
    }
	//----------------------------------

	//--------- Vista de perfil y de editar usuario ---------
	public function perfil()
	{
        /*
		$lista=$this->dispositivo_model->listaDispositivos();   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		$data['dispositivo']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		*/

		$this->load->view('inc_head'); //cargar cabecera
		//$this->load->view('est_lista'$data); //cargar vista est_lista y se envia $data que debe ser dado el formato en la vista
        $this->load->view('inc_sidebar');
        $this->load->view('inc_navbar');
		$this->load->view('profile');
		$this->load->view('inc_footer'); //cargar pie
	}
	//-------------------------------------------------------

	//--------- Vista Tabla --------
	public function table(){
		$userID = $this->session->userdata('idusuario');

		//$lista=$this->monitoreo_model->lista($userID);   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		//$data['medicion']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		
		$data['dispositivos'] = $this->monitoreo_model->listaDispositivosParaSelect($userID);

		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
		$this->load->view('inc_navbar');
		$this->load->view('user_datatable', $data);
		$this->load->view('inc_footer');
	}

	
	public function realizar_consulta() {
		// Obtén los datos del formulario
		$idDispositivo = $this->input->post('idDispositivo');
		$fechaInput = $this->input->post('fechaInput');
	
		// Carga el modelo
		$this->load->model('monitoreo_model');
	
		// Realiza la consulta en el modelo y obtén los resultados
		$resultados = $this->monitoreo_model->consultar_datos($idDispositivo, $fechaInput);
	
		//header('Content-Type: application/json'); // Asegúrate de que el tipo MIME sea JSON

		
		// Devuelve los resultados en formato JSON
		echo json_encode($resultados);
	}
	
	public function obtenerVoltajeCorriente() {
		$idDispositivo = $this->input->post('idDispositivo');
		$fechaInput = $this->input->post('fechaInput');
		$this->load->model('Monitoreo_model');

		$data['voltaje'] = $this->Monitoreo_model->obtenerVoltajePorIdCodigoFecha($idDispositivo, $fechaInput);
		$data['corriente'] = $this->Monitoreo_model->obtenerCorrientePorIdCodigoFecha($$idDispositivo, $fechaInput);

		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function obtenerPotencia() {
		$idDispositivo = $this->input->post('idDispositivo');
		$fechaInput = $this->input->post('fechaInput');
		$this->load->model('Monitoreo_model');
        $data['potencia'] = $this->Monitoreo_model->obtenerPotenciaPorIdCodigoFecha($idDispositivo, $fechaInput);

		header('Content-Type: application/json'); // Asegúrate de que el tipo MIME sea JSON
        echo json_encode($data);
    }

	/*
	public function energiageneradapdf(){
		// Obtener el valor del dispositivo seleccionado
		$dispositivoSeleccionado = $this->input->post('dispositivoSeleccionado');
		
		$lista=$this->monitoreo_model->obtenerDatosEnergiaGenerada($dispositivoSeleccionado);
		$lista=$lista->result();

		$nombre = $this->session->userdata('nombre');
		$primerApellido = $this->session->userdata('primerApellido');
        $segundoApellido = $this->session->userdata('segundoApellido');
		$email = $this->session->userdata('email');

		$nombreCompleto = "Nombre: $nombre $primerApellido $segundoApellido"; // Concatenar nombre, primer apellido y segundo apellido

		$this->pdf=new pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("Reporte Energia Generada");

		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);

		$this->pdf->Ln(20);
		$this->pdf->Cell(30);
		//$this->pdf->SetFillColor(210,210,210);
		$this->pdf->SetFont('helvetica','B',20);
		$this->pdf->Cell(120, 10, 'REPORTE ENERGIA GENERADA', 0, 1, 'C');

		// Agregar el nombre completo en una línea después del título
		$this->pdf->Cell(15);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(120, 10, $nombreCompleto, 0, 0, 'L', 0);
		$this->pdf->Ln(10);

		$this->pdf->Cell(15);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(120, 10, $dispositivoSeleccionado, 0, 0, 'L', 0);
		$this->pdf->Ln(10);
		
		// Imprimir el código del dispositivo
		foreach($lista as $row)
		{
			$codigoDispositivo  = $row->codigoDispositivo ;
			$this->pdf->Cell(120, 10, $codigoDispositivo , 0, 0, 'L', 0);
			$this->pdf->Ln(10);
		}
	

		$this->pdf->SetFont('courier','U', 15);
		$this->pdf->Cell(0, 10, 'Datos Registrados', 0, 1, 'C');

		$this->pdf->Ln(5);

		$this->pdf->SetFillColor(210,210,210);
		$this->pdf->SetFont('Arial','B',9);

		$this->pdf->Cell(30);
		$this->pdf->Cell(7, 5, 'No.', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(17, 5, 'Voltaje [V]', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(20, 5, 'Corriente [A]', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(24, 5, 'Potencia [W]', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(30, 5, 'Fecha y Hora', 'TBLR', 0, 'C', 1);
		$this->pdf->Ln(5);

		$this->pdf->SetFont('Arial','',9);

		$num=1;

		foreach($lista as $row)
		{
			$voltaje= $row->voltaje;
			$corriente= $row->corriente;
			$potencia= $row->potencia;
			$fechaHoraMedicion= formatearFecha($row->fechaHoraMedicion);

			$this->pdf->Cell(30);
			$this->pdf->Cell(7, 5, $num, 'TBLR', 0, 'L', 1);
			$this->pdf->Cell(17, 5, $voltaje, 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(20, 5, $corriente, 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(24, 5, $potencia, 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(30, 5, $fechaHoraMedicion, 'TBLR', 0, 'L', 0);
			$this->pdf->Ln(5);
			$num++;
		}
		$this->pdf->Output("energiagenerada.pdf","I");
	}
	*/
	public function energiageneradapdf(){
		// Obtener el valor del dispositivo seleccionado
		$dispositivoSeleccionado = $this->input->post('dispositivoSeleccionado');
		
		// Obtener datos de energía generada para el dispositivo seleccionado
		$lista = $this->monitoreo_model->obtenerDatosEnergiaGenerada($dispositivoSeleccionado);
		$lista = $lista->result();
	
		$nombre = $this->session->userdata('nombre');
		$primerApellido = $this->session->userdata('primerApellido');
		$segundoApellido = $this->session->userdata('segundoApellido');
		$email = $this->session->userdata('email');
	
		$nombreCompleto = "Nombre: $nombre $primerApellido $segundoApellido"; // Concatenar nombre, primer apellido y segundo apellido
	
		$this->pdf=new pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("Reporte Energia Generada");
	
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
	
		$this->pdf->Ln(20);
		$this->pdf->Cell(30);
		$this->pdf->SetFont('helvetica','B',20);
		$this->pdf->Cell(120, 10, 'REPORTE ENERGIA GENERADA', 0, 1, 'C');
	
		$this->pdf->Cell(15);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(120, 10, $nombreCompleto, 0, 0, 'L', 0);
		$this->pdf->Ln(10);
	
		/*
		$this->pdf->Cell(15);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(120, 10, $dispositivoSeleccionado, 0, 0, 'L', 0);
		$this->pdf->Ln(10);
		*/

		// Verificar si hay registros en la tabla energiagenerada
		if (!empty($lista)) {
			// Imprimir el código del dispositivo
			$codigoDispositivo = $lista[0]->codigoDispositivo;
			$codigo = "Codigo: $codigoDispositivo";
			$this->pdf->Cell(15);
			$this->pdf->Cell(120, 10, $codigo, 0, 0, 'L', 0);
			$this->pdf->Ln(10);
	
			$ubicacionDispositivo = $lista[0]->ubicacionDispositivo;
			$ubicacion = "Ubicación: $ubicacionDispositivo";
			// Dividir la ubicación en dos líneas
			$ubicacionArray = explode("\n", wordwrap($ubicacion, 60));
			$ubicacionLinea1 = isset($ubicacionArray[0]) ? $ubicacionArray[0] : '';
			$ubicacionLinea2 = isset($ubicacionArray[1]) ? $ubicacionArray[1] : '';

			$this->pdf->Cell(15);
			$this->pdf->Cell(120, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $ubicacionLinea1), 0, 0, 'L', 0);
			$this->pdf->Ln(10);
			$this->pdf->Cell(15);
			$this->pdf->Cell(120, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $ubicacionLinea2), 0, 0, 'L', 0);
			$this->pdf->Ln(10);
	
			$this->pdf->SetFont('courier','U', 15);
			$this->pdf->Cell(0, 10, 'Datos Registrados', 0, 1, 'C');
			$this->pdf->Ln(5);
	
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',9);
	
			$this->pdf->Cell(30);
			$this->pdf->Cell(7, 5, 'No.', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(17, 5, 'Voltaje [V]', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(20, 5, 'Corriente [A]', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(24, 5, 'Potencia [W]', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(30, 5, 'Fecha y Hora', 'TBLR', 0, 'C', 1);
			$this->pdf->Ln(5);
	
			$this->pdf->SetFont('Arial','',9);
	
			$num = 1;
	
			foreach($lista as $row)
			{
				$voltaje = $row->voltaje;
				$corriente = $row->corriente;
				$potencia = $row->potencia;
				$fechaHoraMedicion = formatearFecha($row->fechaHoraMedicion);
	
				$this->pdf->Cell(30);
				$this->pdf->Cell(7, 5, $num, 'TBLR', 0, 'L', 1);
				$this->pdf->Cell(17, 5, $voltaje, 'TBLR', 0, 'L', 0);
				$this->pdf->Cell(20, 5, $corriente, 'TBLR', 0, 'L', 0);
				$this->pdf->Cell(24, 5, $potencia, 'TBLR', 0, 'L', 0);
				$this->pdf->Cell(30, 5, $fechaHoraMedicion, 'TBLR', 0, 'L', 0);
				$this->pdf->Ln(5);
				$num++;
			}
		} else {
			// Si no hay registros, imprimir un mensaje indicando que no hay datos
			$this->pdf->SetFont('Arial', 'I', 10);
			$this->pdf->Cell(120, 10, 'No hay datos registrados para este dispositivo.', 0, 0, 'L', 0);
		}
	
		$this->pdf->Output("energiagenerada.pdf","I");
	}
	
	//------------------------------

	//--------- Intento Tabla AJAX --------
	public function tableAjax(){
		//$lista=$this->monitoreo_model->lista();   //almacena en una variable $lista el metodo lista() que esta en estudiante_model
		//$data['medicion']=$lista;		//$data es un array asociativo que puede almacenar muchos datos de muchas consultas como docente_model->lista2
		
		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
		$this->load->view('inc_navbar');
		$this->load->view('tableajax');
		$this->load->view('inc_footer');
	}

	public function obtenerDatosTabla2() {
		$this->load->model('monitoreo_model');
		$data = $this->monitoreo_model->obtenerDatos();
		
		header('Content-Type: application/json'); // Establece el encabezado JSON
		echo json_encode($data);
	}
	

	public function obtenerDatosTablaAnterior() {
		$this->load->model('monitoreo_model');
		$data = $this->monitoreo_model->obtenerDatos();
	
		$formattedData = array();
		foreach ($data as $row) {
			$formattedData[] = array(
				"nro" => $row->id,
				"voltaje" => $row->voltaje,
				"corriente" => $row->corriente,
				"potencia" => $row->potencia,
				"fecha_hora" => $row->fechaHoraMedicion
			);
		}
		echo json_encode($formattedData);
	}	
	//------------------------------

	//--------- Funciona de graficar AJAX ------
	public function graficaAjax(){
		$userID = $this->session->userdata('idusuario');
		$this->load->model('Monitoreo_model');
		$data['chipIDs'] = $this->monitoreo_model->getChipIDsByUserID($userID);

		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
		$this->load->view('inc_navbar');
		$this->load->view('chart', $data);
		$this->load->view('inc_footer');
	}

	public function obtenerVoltajeCorrientePorChipID() {
		try {
			$chipID = $this->input->get('chipID');
			$this->load->model('Monitoreo_model');
	
			$data['voltaje'] = $this->Monitoreo_model->obtenerVoltajePorChipID($chipID);
			$data['corriente'] = $this->Monitoreo_model->obtenerCorrientePorChipID($chipID);
	
			header('Content-Type: application/json');
			echo json_encode($data);
		} catch (Exception $e) {
			// Manejo de errores
			log_message('error', 'Error en el controlador: ' . $e->getMessage());
        show_error('Se produjo un error en el servidor. Por favor, inténtalo de nuevo más tarde.', 500);
		}
	}

	//funciona pero para voltaje y corriente individual 
	/*
	public function grafica() {
        $this->load->model('Monitoreo_model');

        $data['voltaje'] = $this->Monitoreo_model->getVoltajeData();
        $data['corriente'] = $this->Monitoreo_model->getCorrienteData();

        header('Content-Type: application/json');
        echo json_encode($data);
    }
	*/
	//

	//Intento para dos graficas de voltaje Corriente y Potencia
	/*
	public function grafica($tipoGrafica) {
		$this->load->model('Monitoreo_model');
        if ($tipoGrafica === 'voltajeCorriente') {
            $data = array(
                'voltaje' => $this->Monitoreo_model->getVoltajeData(),
                'corriente' => $this->Monitoreo_model->getCorrienteData()
            );
        } elseif ($tipoGrafica === 'potencia') {
            $data = array(
                'potencia' => $this->Monitoreo_model->getPotenciaData()
            );
        } else {
            show_404(); // Página no encontrada si el tipo de gráfica no es válido
            return;
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    } */
	//------------------------------------------

	//--------Prueba modularizar funciona-------
	public function obtenerDatosGrafica($tipoGrafica) {
		$this->load->model('Monitoreo_model');
	
		switch ($tipoGrafica) {
			case 'voltajeCorriente':
				$data = array(
					'voltaje' => $this->Monitoreo_model->getVoltajeData(),
					'corriente' => $this->Monitoreo_model->getCorrienteData()
				);
				break;
	
			case 'potencia':
				$data = array(
					'potencia' => $this->Monitoreo_model->getPotenciaData()
				);
				break;
	
			default:
				show_404();
				return;
		}
	
		return $data;
	}
	
	public function grafica($tipoGrafica) {
		$data = $this->obtenerDatosGrafica($tipoGrafica);
	
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	//----------------------------------

	//--------- Vista de registrar y lista de Dispositivo -----
	public function registrarDispositivo1(){
		$this->load->view('inc_head');
		$this->load->view('inc_sidebar');
		$this->load->view('inc_navbar');
		$this->load->view('device_register');
		$this->load->view('inc_footer');
	}

	public function dispositivos(){
		// Obtener el ID de usuario de la sesión
		$idUsuario = $this->session->userdata('idusuario');
		$idCliente = $this->dispositivo_model->obtenerIdCliente($idUsuario);

		// Verificar si el ID de usuario está presente en la sesión
		if ($idCliente) {
			// Obtener la lista de dispositivos para el usuario específico
			$lista = $this->dispositivo_model->listaDispositivos($idCliente);
	
			// Almacenar la lista en el array de datos
			$data['dispositivo'] = $lista;
	
			// Cargar las vistas con los datos
			$this->load->view('inc_head');
			$this->load->view('inc_sidebar');
			$this->load->view('inc_navbar');
			$this->load->view('device_list', $data);
			$this->load->view('inc_footer');
		} else {
			// Manejar el caso en el que no haya un ID de usuario en la sesión
			// Puedes mostrar la tabla vacía o redirigir a una página de inicio de sesión u otra acción apropiada.
			// Ejemplo:
			$data['dispositivo'] = array(); // Un array vacío

			// Cargar la vista con la tabla vacía
			$this->load->view('inc_head');
			$this->load->view('inc_sidebar');
			$this->load->view('inc_navbar');
			$this->load->view('device_list', $data);
			$this->load->view('inc_footer');
		}
	}

	public function listaDispositivopUsuariopdf(){
		$idUsuario = $this->session->userdata('idusuario');
		//$idCliente = $this->dispositivo_model->obtenerIdCliente($idUsuario);

		$this->load->model('dispositivo_model');
		$lista = $this->dispositivo_model->listaDispositivosReporte($idUsuario);
		$data['dispositivo'] = $lista;

		$nombre = $this->session->userdata('nombre');
		$primerApellido = $this->session->userdata('primerApellido');
		$segundoApellido = $this->session->userdata('segundoApellido');
		$email = $this->session->userdata('email');
	
		$nombreCompleto = "Nombre: $nombre $primerApellido $segundoApellido"; // Concatenar nombre, primer apellido y segundo apellido
	
		
		$this->pdf=new pdf();
		
		$this->pdf=new pdf();
		$this->pdf->AddPage('L');
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("Lista Dispositivo");

		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
		
		$this->pdf->Ln(20);
		$this->pdf->Cell(30);
		$this->pdf->SetFont('helvetica','B',20);
		$this->pdf->Cell(200, 10, 'LISTA DE DISPOSITIVOS', 0, 1, 'C');
	
		$this->pdf->Cell(15);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(120, 10, $nombreCompleto, 0, 0, 'L', 0);
		$this->pdf->Ln(10);
		// Verificar si hay registros en la tabla energiagenerada
		if (!empty($lista)) {
			
	
			$this->pdf->SetFont('courier','U', 15);
			$this->pdf->Cell(0, 10, 'Dispositivos Registrados', 0, 1, 'C');
			$this->pdf->Ln(5);
	
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',9);
	
			$this->pdf->Cell(5);
			$this->pdf->Cell(7, 5, 'No.', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(17, 5, 'Codigo', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(115, 5, 'Ubicacion', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(20, 5, 'Latitud', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(20, 5, 'Longitud', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(20, 5, 'Estado', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(24, 5, 'Potencia [W]', 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(30, 5, 'Fecha Instalacion', 'TBLR', 0, 'C', 1);
			$this->pdf->Ln(5);
	
			$this->pdf->SetFont('Arial','',9);
	
			$num = 1;
	
			foreach($lista as $row)
			{
				$codigo = $row->codigo;
				$ubicacion= $row->ubicacion;
				$ubicacionFormateada = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ubicacion);	
				$latitud = $row->latitud;
				$longitud = $row->longitud;
				$estado = isset($row->estado_dispositivo) ? ($row->estado_dispositivo == 1 ? 'Activo' : 'Inactivo') : 'Desconocido';
				$suma_potencia = $row->suma_potencia;
				$fechaInstalacion = isset($row->fechaInstalacion) ? formatearFecha($row->fechaInstalacion) : '';

	
				$this->pdf->Cell(5);
				$this->pdf->Cell(7, 5, $num, 'TBLR', 0, 'C', 1);
				$this->pdf->Cell(17, 5, $codigo, 'TBLR', 0, 'C', 0);
				$this->pdf->Cell(115, 5, ($ubicacionFormateada ? mb_strimwidth($ubicacionFormateada, 0, 72, '...', 'UTF-8') : ''), 'TBLR', 0, 'L', 0);
				$this->pdf->Cell(20, 5, $latitud, 'TBLR', 0, 'C', 0);
				$this->pdf->Cell(20, 5, $longitud, 'TBLR', 0, 'C', 0);
				$this->pdf->Cell(20, 5, $estado, 'TBLR', 0, 'C', 0);
				$this->pdf->Cell(24, 5, $suma_potencia, 'TBLR', 0, 'C', 0);
				$this->pdf->Cell(30, 5, $fechaInstalacion, 'TBLR', 0, 'C', 0);
				$this->pdf->Ln(5);
				$num++;
			}
		} else {
			// Si no hay registros, imprimir un mensaje indicando que no hay datos
			$this->pdf->SetFont('Arial', 'I', 10);
			$this->pdf->Cell(120, 10, 'No hay datos registrados para este dispositivo.', 0, 0, 'L', 0);
		}
	
		$this->pdf->Output("energiagenerada.pdf","I");
	}

	//---------------------------------------------------------
	//============================================

	/*
	public function modificar(){
		$idEstudiante=$_POST['idEstudiante'];   //en la variable $idEstudiante q creamos recibimos el parametro de del input=idEstudiante
		$data['infoestudiante']=$this->estudiante_model->recuperarEstudiante($idEstudiante);   //realizamos la consulta al modelo mandando el valor del id
	
		$this->load->view('inc_head'); //cargar cabecera
		$this->load->view('est_modificar',$data); //cargar vista est_modificar y se envia $data que debe ser dado el formato en la vista
		$this->load->view('inc_footer'); //cargar pie
	}

	public function modificarbd(){
		$idEstudiante=$_POST['idEstudiante'];
		$data['nombre']=$_POST['nombre'];   //'nombre' como esta escrito en BD y el post 'nombre' como esta escrito en input del formulario 
		$data['primerApellido']=$_POST['primerApellido'];
		$data['segundoApellido']=$_POST['segundoApellido'];
		$data['nota']=$_POST['nota'];

		$this-> estudiante_model->modificarEstudiante($idEstudiante,$data);  //envia a model.php los datos para hacer update
		
		redirect('estudiante/index','refresh');
	}

	public function agregar(){
		$this->load->view('inc_head'); //cargar cabecera
		$this->load->view('est_agregar'); //cargar vista eset_agregar 
		$this->load->view('inc_footer'); //cargar pie
	}

	public function agregarbd(){
		$data['nombre']=$_POST['nombre'];   //'nombre' como esta escrito en BD y el post 'nombre' como esta escrito en input del formulario 
		$data['primerApellido']=$_POST['primerApellido'];
		$data['segundoApellido']=$_POST['segundoApellido'];
		$data['nota']=$_POST['nota'];

		$this->estudiante_model->agregarEstudiante($data); //enviamos el al insert esos datos

		redirect('estudiante/index','refresh');
	}

	public function eliminarbd(){
		$idEstudiante=$_POST['idEstudiante'];
		$this->estudiante_model->eliminarEstudiante($idEstudiante); //enviamos al delete esos datos

		redirect('estudiante/index','refresh');
	}*/

	
	//=============== Admin ===============

	public function adm_index(){
		$data['totals'] = array(
            'total_usuarios' => $this->monitoreo_model->get_total_usuarios(),
            'total_clientes' => $this->monitoreo_model->get_total_clientes(),
			'total_dispositivos' => $this->monitoreo_model->get_total_dispositivos(),
			'total_dispositivos_activos' => $this->monitoreo_model->get_total_dispositivos_activos(),
            // Puedes agregar más variables según sea necesario para otras tablas
        );

		$this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('adm_dashboard', $data);
		$this->load->view('inc_footer'); 
	}

	public function perfilAdm(){
		$this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('adm_profile');
		$this->load->view('inc_footer'); 
	}

	public function passwordAdm(){
		$this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('password');
		$this->load->view('inc_footer'); 
	}

	public function redirectToEditPassword() {
		redirect('monitoreo/perfilAdm#edit-password', 'refresh');
	}

	public function registrarUsuario(){
		$this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('adm_registeruser');
		$this->load->view('inc_footer'); 
	}

	public function listaUsuario(){
		$lista=$this->monitoreo_model->usuarioLista();
		$data['usuarios']=$lista;

		$this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('adm_userlist', $data);
		$this->load->view('inc_footer'); 
	}

	public function registrarDispositivo(){
		$this->load->model('monitoreo_model');

		// Obtener la lista de clientes
		$data['clientes'] = $this->monitoreo_model->obtenerClientes();

		// Cargar la vista del formulario con los datos de los clientes
		$this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('adm_registerdevice', $data);
		$this->load->view('inc_footer'); 
	}

	public function listaDispositivo(){
		$this->load->model('Monitoreo_model');
		$lista=$this->monitoreo_model->obtenerInformacionDispositivos();
		$data['dispositivos']=$lista;

		$this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('adm_devicelist', $data);
		$this->load->view('inc_footer'); 
	}

	public function actualizarPotencia() {
		$fechaInicio = $this->input->post('fechaInicio');
		$fechaFinal = $this->input->post('fechaFinal');

		echo $fechaInicio;
		echo $fechaFinal;
		// Cargar el modelo
		$this->load->model('Monitoreo_model');

		// Lógica para obtener la nueva potencia según las fechas proporcionadas
		$potenciaActualizada = $this->monitoreo_model->obtenerPotenciaActualizada($fechaInicio, $fechaFinal);
	  
		// Devolver la respuesta como JSON
    	echo json_encode($potenciaActualizada);
	}

	public function listaDispositivopdf(){
		$this->load->model('Monitoreo_model');
		$lista=$this->monitoreo_model->informacionDispositivospdf();
		$data['dispositivos']=$lista;
	
		$nombre = $this->session->userdata('nombre');
		
		$this->pdf=new pdf();
		
		// Establecer la orientación a horizontal
		$this->pdf->SetAutoPageBreak(true, 15);
		
		$this->pdf->AddPage('L');  // 'L' indica orientación horizontal
		$this->pdf->AliasNbPages();
		$this->pdf->SetTitle("Reporte Dispositivos");
	
		$this->pdf->SetLeftMargin(15);
		$this->pdf->SetRightMargin(15);
	
		$this->pdf->Ln(20);
		$this->pdf->Cell(30);
		//$this->pdf->SetFillColor(210,210,210);
		$this->pdf->SetFont('helvetica','B',20);
		$this->pdf->Cell(200, 10, 'TOTAL DE DISPOSITIVOS ', 0, 1, 'C');
	
		$fechaActual = date("d/m/Y");
		// Agregar el nombre completo en una línea después del título
		$this->pdf->Cell(15);
		$this->pdf->SetFont('Arial','B',11);
		$this->pdf->Cell(120, 10, "Nombre: $nombre", 0, 0, 'L', 0);
		$this->pdf->Ln(10);    

		$this->pdf->Cell(15);
		$this->pdf->Cell(120, 10, "Fecha: $fechaActual", 0, 0, 'L', 0);
		$this->pdf->Ln(10);    

		$this->pdf->SetFont('courier','U', 15);
		$this->pdf->Cell(260, 10, 'Dispositivos Registrados', 0, 1, 'C');
	
		$this->pdf->Ln(5);
	
		$this->pdf->SetFillColor(210,210,210);
		$this->pdf->SetFont('Arial','B',9);
	
		$this->pdf->Cell(-2);
		$this->pdf->Cell(7, 10, 'No.', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(22, 10, 'Dispositivo', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(50, 10, 'Propietario', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(37, 10, 'Email', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(90, 10, 'Ubicacion', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(13, 10, 'Estado', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(29, 10, 'Fecha Instalacion', 'TBLR', 0, 'C', 1);
		$this->pdf->Cell(22, 10, 'Potencia [W]', 'TBLR', 0, 'C', 1);
		$this->pdf->Ln(10);
	
		$this->pdf->SetFont('Arial','',9);
	
		
		$num=1;
	
		foreach($lista as $row)
		{
			$codigo= $row->codigo;
			$nombre = $row->nombre;
			$primerApellido = $row->primerApellido;
			$segundoApellido = $row->segundoApellido;
			$nombreCompleto = "$nombre $primerApellido $segundoApellido";
			$email= $row->email;
			$ubicacion= $row->ubicacion;
			$ubicacionFormateada = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ubicacion);
			$estado = ($row->estado_dispositivo == 1) ? 'Activo' : 'Inactivo';
			$fechaInstalacion= $row->fechaInstalacion;
			$fechaFormateada = date('d-m-Y', strtotime($fechaInstalacion));
			$suma_potencia= $row->suma_potencia;
	
			$this->pdf->Cell(-2);
			$this->pdf->Cell(7, 10, $num, 'TBLR', 0, 'C', 1);
			$this->pdf->Cell(22, 10, $codigo, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(50, 10, $nombreCompleto, 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(37, 10, ($email ? substr($email, 0, 22) : ''), 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(90, 10, ($ubicacionFormateada ? substr($ubicacionFormateada, 0, 58) :''), 'TBLR', 0, 'L', 0);
			$this->pdf->Cell(13, 10, $estado, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(29, 10, $fechaFormateada, 'TBLR', 0, 'C', 0);
			$this->pdf->Cell(22, 10, $suma_potencia, 'TBLR', 0, 'C', 0);
			$this->pdf->Ln(10);
			$num++;
		} 
		$this->pdf->Output("energiagenerada.pdf","I");
	}

	public function aviso(){
		$this->load->model('Monitoreo_model');
		$lista=$this->monitoreo_model->obtenerDispositivosClientes();
		$data['clientes']=$lista;

		$this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('adm_listbill', $data);
		$this->load->view('inc_footer'); 
	}
	
	//=====================================

	
}
