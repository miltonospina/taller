<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends Aplicacion{
/**
 * controlador de gestión de usuarios.
 */
 

	function __construct()
	{
		parent::__construct();
		$this->appcode=0;
	}
	
	
	
	
	
	//Carga la vista principal del controlador de usuarios
	function index()
	{
		$this->login();
		$this->args['contenidoVista']=$this->load->view("inicio_v",$this->datos,true);
		$this->generarVista();
	}

}