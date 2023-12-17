<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Factura extends CI_Controller {

    public function detalles() {
        // Obtener los valores del formulario
        $idUsuario = $this->input->post('idUsuario');
        $idDispositivo = $this->input->post('idDispositivo');

        // Cargar el modelo
        $this->load->model('Factura_model');

        // Obtener los datos de la factura mediante la consulta al modelo
        $data['row'] = $this->factura_model->obtenerDatosFactura($idUsuario, $idDispositivo);

        $this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('adm_factura', $data);
		$this->load->view('inc_footer');
        
    }

    public function generarFacturaParaDispositivo() {
        // Obtener los valores del formulario
        $codigo = $this->input->post('codigo');
        $fechaEmision = $this->input->post('fechaEmision');
        $mesLeturacion = $this->input->post('mes');
        $potenciaGenerada = $this->input->post('lanterior');
        $potenciaConsumida = $this->input->post('lactual');
        $nombre = $this->input->post('name');
        $primerApellido = $this->input->post('firstName');
        $segundoApellido = $this->input->post('lastName');
        $direccion = $this->input->post('add');
        $tarifa = $this->input->post('tarifa');
        $montoTotal = $this->input->post('montoTotal');
        $idDispositivo = $this->input->post('idDispositivo'); // Nuevo
        $idCliente = $this->input->post('idCliente'); // Nuevo

        // Verificar si la potenciaGenerada es igual a cero
        if ($potenciaGenerada == 0) {
            // Si la potenciaGenerada es cero, mostrar un mensaje de error y salir de la función
            $this->session->set_flashdata('error', 'No existen datos para el mes y/o el dispoitivo es nuevo.');
            redirect('monitoreo/aviso');
        }

        // Verificar si ya existe una factura para el mes y dispositivo
        if (!$this->factura_model->existeFacturaParaMesYDispositivo($mesLeturacion, $idDispositivo)) {
            // Iniciar la transacción
            $this->db->trans_start();
    
            // Insertar en la tabla "factura"
            $facturaData = array(
                'fechaEmision' => $fechaEmision,
                'montoTotal' => $montoTotal,
                'detallesFactura' => $mesLeturacion,
                'idCliente' => $idCliente,
                'idDispositivo' => $idDispositivo,
                // Añade más campos según la estructura de tu tabla "factura"
            );
            $this->db->insert('factura', $facturaData);
    
            // Obtener el ID de la última factura insertada
            $idFactura = $this->db->insert_id();
    
            // Obtener el mes anterior para fechaConsumo
            $fechaConsumo = date('Y-m-d', strtotime('-1 month'));

            // Separar la fecha en mes y año
            $mesAnio = explode('-', $fechaConsumo);
            $mes = $mesAnio[1]; // Obtiene el mes (formato numérico)
            $anio = $mesAnio[0]; // Obtiene el año

            // Insertar en la tabla "consumo" ahora que el ID de factura existe
            $consumoData = array(
                'fechaConsumo' => $fechaConsumo,
                'mes' => $mes,
                'anio' => $anio,
                'consumoAnterior' => $potenciaGenerada,
                'consumoActual' => $potenciaConsumida,
                'idDispositivo' => $idDispositivo,
                'idFactura' => $idFactura, // Asociar con el ID de la factura recién insertada
                // Añade más campos según la estructura de tu tabla "consumo"
            );
            $this->db->insert('consumo', $consumoData);
    
            // Finalizar la transacción
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                // Si hay un error, revierte la transacción
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Error al generar la factura. Por favor, inténtalo de nuevo.');
            } else {
                // Si la transacción fue exitosa, confirma la transacción
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Recibo generada exitosamente.');
            }
        } else {
            // Si ya existe una factura para el mes y dispositivo, muestra un mensaje de error
            $this->session->set_flashdata('error', 'Ya existe una recibo para el mes y dispositivo seleccionados.');
        }
    
        // Redirigir a la página de monitoreo/facturas
        redirect('monitoreo/aviso');
    }
    
    public function estadoFactura(){
        $this->load->model('Factura_model');

        $data['facturas'] = $this->factura_model->obtenerTodasLasFacturas();

        /*
        // Verifica si hay resultados antes de pasarlos a la vista
        if ($data['facturas']->num_rows() > 0) {
            $this->load->view('inc_head');
            $this->load->view('inc_sidebaradmin');
            $this->load->view('inc_navbar');
            $this->load->view('adm_estadofactura', $data);
            $this->load->view('inc_footer');
        } else {
            // Puedes manejar la lógica cuando no hay facturas, por ejemplo, mostrar un mensaje o redirigir a otra página.
            echo "No hay facturas disponibles.";
        }
        */
        $this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
        $this->load->view('adm_estadofactura', $data);
        $this->load->view('inc_footer');
    }

    public function facturapdf($idFactura){
        // Obtener el valor del dispositivo seleccionado
        //$idFactura = $this->input->post('idFactura');
        //var_dump($idFactura); // Verificar el valor del ID

        $this->load->model('factura_model');

        $lista=$this->factura_model->obtenerInformacionFactura($idFactura);
		$data['informacion']=$lista;
        
        $nombre = $data['informacion']->nombre;

        // Obtener datos de energía generada para el dispositivo seleccionado
        //$lista = $this->monitoreo_model->obtenerDatosEnergiaGenerada($dispositivoSeleccionado);
        //$lista = $lista->result();

    
        
        $estadoFactura = $data['informacion']->estadoFactura;

        // Verificar si el estado de la factura es igual a 1
        if ($estadoFactura == 1) {
            $this->pdf=new pdf();
            //$this->pdf->AddPage();
            // Ajustar el tamaño de la página a la mitad de una hoja estándar (210x297 mm)
            $this->pdf->AddPage('L', array(215, 170));
            $this->pdf->AliasNbPages();
            $this->pdf->SetTitle("Recibo");
        
            $this->pdf->SetLeftMargin(15);
            $this->pdf->SetRightMargin(15);
        
            $this->pdf->Ln(20);
            $this->pdf->Cell(30);
            $this->pdf->SetFont('helvetica','B',20);
            $this->pdf->Cell(120, 10, 'RECIBO DE ENERGIA', 0, 1, 'C');
        

            $this->pdf->Cell(15);
            $this->pdf->SetFont('Arial','B',11);
            $this->pdf->Cell(150, 10, 'Detalles de Recibo', 0, 1, 'C');
            //$this->pdf->Ln(10);

            // Obtener datos del cliente
            $nombreUsuario = $data['informacion']->nombreUsuario;
            $nombre = $data['informacion']->nombre;
            $primerApellido = $data['informacion']->primerApellido;
            $segundoApellido = $data['informacion']->segundoApellido;
            $ci = $data['informacion']->ci;
            $direccion = $data['informacion']->direccion;
            
            $estadoFactura = "CANCELADO";
            // Concatenar nombre y apellidos
            $nombreCompleto = "$nombre $primerApellido $segundoApellido";

            // Insertar datos en una sola celda
            $this->pdf->Cell(120, 10, "Usuario: $nombreUsuario", 0, 1, 'L');
            $this->pdf->Cell(120, 10, "Nombre Completo: $nombreCompleto", 0, 1, 'L');
            $this->pdf->Cell(120, 10, "Direccion: $direccion", 0, 1, 'L');
            $this->pdf->Cell(120, 10, "CI: $ci", 0, 1, 'L');
            $this->pdf->Cell(120, 10, "Estado: $estadoFactura", 0, 1, 'L');
            //$this->pdf->Ln(10);

            $fechaEmision = $data['informacion']->fechaEmision;
            $fechaEmisionFormateada = date("d/m/Y", strtotime($fechaEmision));

            $fechaActual = date("d/m/Y");

            $this->pdf->Cell(120, 10, "Fecha Cancelacion: $fechaActual", 0, 1, 'L');


        // Insertar celdas centrando el contenido
            $this->pdf->Cell(28, 10, 'Dispositivo:', 1, 0, 'C');
            $this->pdf->Cell(42, 10, 'Potencia Consumida:', 1, 0, 'C');
            $this->pdf->Cell(42, 10, 'Potencia Generada:', 1, 0, 'C');
            $this->pdf->Cell(32, 10, 'Monto Total:', 1, 0, 'C');
            $this->pdf->Cell(40, 10, 'Fecha:', 1, 1, 'C'); // Cambiado a '1' para agregar un salto de línea al final

            // Obtener detalles de la factura
            $dispositivo = $data['informacion']->codigo;
            $consumoAnterior = $data['informacion']->consumoGen;
            $consumoActual = $data['informacion']->consumoMes;
            $montoTotal = $data['informacion']->montoTotal;
            $detallesFactura = $data['informacion']->detallesFactura;
            $anioMes = date("Y", strtotime($fechaEmision));

            // Insertar datos en las celdas centrando el contenido
            $this->pdf->Cell(28, 10, $dispositivo, 1, 0, 'C');
            $this->pdf->Cell(42, 10, "$consumoAnterior [KWH]", 1, 0, 'C');
            $this->pdf->Cell(42, 10, "$consumoActual [KWH]", 1, 0, 'C');
            $this->pdf->Cell(32, 10, "$montoTotal [Bs.]", 1, 0, 'C');
            $this->pdf->Cell(40, 10, "$detallesFactura / $anioMes", 1, 1, 'C'); // Cambiado a '1' para agregar un salto de línea al final

            // Añadir marcador de agua (imagen)
            /*
            $watermarkImage = FCPATH . 'assets/images/cancelado.png';

            if (file_exists($watermarkImage)) {
                $this->pdf->Image($watermarkImage, 30, 50, 150, 0, 'PNG');
            } else {
                echo "La imagen no existe en la ruta especificada.";
            }
            */
        }else{
            $this->pdf=new pdf();
            //$this->pdf->AddPage();
            $this->pdf->AddPage('L', array(215, 170));
            $this->pdf->AliasNbPages();
            $this->pdf->SetTitle("Aviso de Cobranza");
        
            $this->pdf->SetLeftMargin(15);
            $this->pdf->SetRightMargin(15);
        
            $this->pdf->Ln(20);
            $this->pdf->Cell(30);
            $this->pdf->SetFont('helvetica','B',20);
            $this->pdf->Cell(120, 10, 'AVISO DE COBRANZA', 0, 1, 'C');
        

            $this->pdf->Cell(15);
            $this->pdf->SetFont('Arial','B',11);
            $this->pdf->Cell(150, 10, 'Detalles ', 0, 1, 'C');
            //$this->pdf->Ln(10);

            // Obtener datos del cliente
            $nombreUsuario = $data['informacion']->nombreUsuario;
            $nombre = $data['informacion']->nombre;
            $primerApellido = $data['informacion']->primerApellido;
            $segundoApellido = $data['informacion']->segundoApellido;
            $ci = $data['informacion']->ci;
            $direccion = $data['informacion']->direccion;

            // Concatenar nombre y apellidos
            $nombreCompleto = "$nombre $primerApellido $segundoApellido";

            // Insertar datos en una sola celda
            $this->pdf->Cell(120, 10, "Usuario: $nombreUsuario", 0, 1, 'L');
            $this->pdf->Cell(120, 10, "Nombre Completo: $nombreCompleto", 0, 1, 'L');
            $this->pdf->Cell(120, 10, "Direccion: $direccion", 0, 1, 'L');
            $this->pdf->Cell(120, 10, "CI: $ci", 0, 1, 'L');

            //$this->pdf->Ln(10);

            $fechaEmision = $data['informacion']->fechaEmision;
            $fechaEmisionFormateada = date("d/m/Y", strtotime($fechaEmision));

            $this->pdf->Cell(120, 10, "Fecha Emision: $fechaEmisionFormateada", 0, 1, 'L');
            

        // Insertar celdas centrando el contenido
            $this->pdf->Cell(28, 10, 'Dispositivo:', 1, 0, 'C');
            $this->pdf->Cell(42, 10, 'Potencia Consumida:', 1, 0, 'C');
            $this->pdf->Cell(42, 10, 'Potencia Generada:', 1, 0, 'C');
            $this->pdf->Cell(32, 10, 'Monto Total:', 1, 0, 'C');
            $this->pdf->Cell(40, 10, 'Fecha:', 1, 1, 'C'); // Cambiado a '1' para agregar un salto de línea al final
            //$this->pdf->Cell(40, 10, 'Año:', 1, 1, 'C');

            // Obtener detalles de la factura
            $dispositivo = $data['informacion']->codigo;
            $consumoAnterior = $data['informacion']->consumoGen;
            $consumoActual = $data['informacion']->consumoMes;
            $montoTotal = $data['informacion']->montoTotal;
            $detallesFactura = $data['informacion']->detallesFactura;
            $anioMes = date("Y", strtotime($fechaEmision));

            // Insertar datos en las celdas centrando el contenido
            $this->pdf->Cell(28, 10, $dispositivo, 1, 0, 'C');
            $this->pdf->Cell(42, 10, "$consumoAnterior [KWH]", 1, 0, 'C');
            $this->pdf->Cell(42, 10, "$consumoActual [KWH]", 1, 0, 'C');
            $this->pdf->Cell(32, 10, "$montoTotal [Bs.]", 1, 0, 'C');
            $this->pdf->Cell(40, 10, "$detallesFactura / $anioMes", 1, 1, 'C'); // Cambiado a '1' para agregar un salto de línea al final
            //$this->pdf->Cell(40, 10, $anioMes, 1, 1, 'C'); // Cambiado a '1' para agregar un salto de línea al final

        }

       
    
        $this->pdf->Output("energiagenerada.pdf","I");
    }

    /* En tu controlador de facturas
    public function generarFacturaParaDispositivo($idDispositivo) {
        $this->load->model('Factura_model');
        $this->load->model('Consumo_model');
        $this->load->model('Dispositivo_model');

        // Obtener información del dispositivo
        $dispositivo = $this->Dispositivo_model->obtenerInformacionDispositivo($idDispositivo);

        // Obtener consumos pendientes para el dispositivo
        $consumosPendientes = $this->Consumo_model->obtenerConsumosPendientesPorDispositivo($idDispositivo);

        // Iniciar transacción
        $this->db->trans_start();

        foreach ($consumosPendientes as $consumo) {
            // Realizar cálculos y operaciones necesarias para la factura
            // ...

            // Crear factura
            $facturaDatos = array(
                // ... Detalles de la factura
            );
            $idFactura = $this->Factura_model->crearFactura($facturaDatos);

            // Actualizar estado del consumo
            $this->Consumo_model->actualizarEstadoConsumo($consumo['idConsumo'], 'Facturado');
        }

        // Completar transacción
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            // Si hay un error, revertir la transacción
            $this->db->trans_rollback();
            echo 'Error al generar la factura para el dispositivo.';
        } else {
            // Éxito, confirmar la transacción
            $this->db->trans_commit();
            echo 'Facturas generadas con éxito para el dispositivo.';
        }
    }
    */



    //================ Pagos ==========
    public function pago(){
        $this->load->view('inc_head');
        $this->load->view('inc_sidebaradmin');
        $this->load->view('inc_navbar');
		$this->load->view('adm_generarpago');
		$this->load->view('inc_footer');
    }

    public function obtenerUsuarioPorCI() {
        $ci = $this->input->post('ci');
    
        // Carga el modelo necesario
        $this->load->model('factura_model');
    
        // Llama al método del modelo para obtener los detalles del usuario por CI
        $usuario = $this->factura_model->obtenerUsuarioPorCI($ci);
    
        // Envia los detalles del usuario como respuesta JSON
        echo json_encode($usuario);
    }
    
    public function buscarDispositivosPorCI() {
        $ci = $this->input->post('ci');
    
        // Carga el modelo necesario
        $this->load->model('factura_model');
    
        // Llama al método del modelo para buscar dispositivos por CI
        $dispositivos = $this->factura_model->buscarDispositivosPorCI($ci);
    
        // Devuelve los dispositivos como respuesta JSON
        echo json_encode($dispositivos);
    }

    /*
    public function pagar() {
        // Recibe los valores del formulario
        $ci = $this->input->post('ci');
        $idsSeleccionados = $this->input->post('idsSeleccionados');
        $idsFactura = $this->input->post('idsFactura');
    
        // Imprime los valores en la consola del navegador
        echo '<pre>';
        print_r($ci);
        print_r($idsSeleccionados);
        print_r($idsFactura);
        echo '</pre>';
    
        // Realiza las acciones necesarias con los valores recibidos
        // (por ejemplo, guardar en la base de datos, realizar cálculos, etc.)
    
        // Redirige a la página principal u otra página según sea necesario
    }
    */

    public function pagar() {
        // Recibe los valores del formulario
        $idsSeleccionados = explode(",", $this->input->post('idsSeleccionados'));
        $idsFactura = explode(",", $this->input->post('idsFactura'));
        // Imprime los valores en la consola del navegador
        /*
        echo '<pre>';
        print_r($idsSeleccionados);
        print_r($idsFactura);
        echo '</pre>';
        */
        // Inicia la transacción
        $this->db->trans_start();
    
        try {
            // Realiza las acciones necesarias con los valores recibidos
            // (por ejemplo, cambiar el estado en la tabla factura)
    
            foreach ($idsFactura as $idFactura) {
                // Actualiza el estado a 1 en la tabla factura
                $this->db->where('idFactura', $idFactura);
                $this->db->update('factura', array('estado' => 1));
            }
    
            // Realiza otras acciones si es necesario
    
            // Confirma la transacción
            $this->db->trans_complete();
    
            // Agrega mensaje de éxito
            $this->session->set_flashdata('success', 'Aviso de Cobro pagadas exitosamente.');
    
            // Redirige a la página principal u otra página según sea necesario
            redirect('factura/pago');
        } catch (Exception $e) {
            // Ocurrió un error, realiza alguna acción de manejo de errores si es necesario
            $this->db->trans_rollback();
    
            // Agrega mensaje de error
            $this->session->set_flashdata('error', 'Error al procesar el pago.');
    
            // Redirige a la página principal u otra página según sea necesario
            redirect('factura/pago');
        }
        
    }
    
}