<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ayuda extends Aplicacion{
/**
 * controlador de gestión de usuarios.
 */
 

	function __construct()
	{
		parent::__construct();
		$this->appcode=911;
		$this->titulo2="Manual de operación de Energy+";
	}
	
	
	
	
	
	//Carga la vista principal del controlador de usuarios
	function index()
	{
		$this->login();
		$this->args['contenidoVista']=$this->load->view("ayuda_v",$this->datos,true);
		$this->generarVista();
	}

}	