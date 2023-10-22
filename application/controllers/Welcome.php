<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	//empieza con metodo
	public function index()
	{
		$this->load->view('inc_head'); //cargar cabecera
		$this->load->view('welcome_message'); //cargar vista
		$this->load->view('inc_footer'); //cargar pie
	}
	public function vista2()
	{
		$this->load->view('inc_head'); //cargar cabecera
		$this->load->view('formulario'); //cargar vista
		$this->load->view('inc_footer'); //cargar pie
	}
	
}
