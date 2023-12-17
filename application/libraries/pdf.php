<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once APPPATH."/third_party/fpdf/fpdf.php";
    class Pdf extends FPDF {		
		
        public function Header(){
            //si se requiere agregar una imagen
            //$ruta=base_url()."img/back.jpg";
            //$this->Image($ruta,0,0,220,220);
            
            //$this->SetFont('Arial','B',10);
            //$this->Cell(30);
            //$this->Cell(120,10,'TITULO CABECERA',0,0,'C');
            //$this->Ln('5');

            // Obtén la ruta completa de la imagen utilizando base_url() de CodeIgniter.
            $image_path = base_url('/assets/images/logo.png');

            // Reemplaza el directorio en la función Image con la ruta completa de la imagen.
            $this->Ln('5');
            $this->Image($image_path, 0, 0, 40);
            $this->SetFont('helvetica','B',35);
            $this->Cell(25);
            $this->Cell(120,10,'SolEnergy',0,0,'L');
       }

	   public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',7);
           $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
      }
}
?>