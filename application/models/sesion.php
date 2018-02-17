<?php
class Sesion extends CI_Model {
	var $usuario;
	var $visita;
	var $llave_privada;
	
	public function __construct()
	{
		parent::__construct();
		$this->llave_privada="fuckyeah!!!";
		
		
		$this->load->model("usuario","objetoUsuario"); 
		//$this->load->model("visita","objetoVisita"); 
		
		$this->usuario=clone $this->objetoUsuario;
		//$this->visita=clone $this->objetoVisita;
		
		$this->load->library('session');
	}
	
	
	
	
	
	public function login()
	{
		$sal=$this->_generarSal();
		$this->session->set_userdata('sal', $sal);
		return $sal;
	}
	
	
	
	
	
	
	
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	
	
	
	
	
	private function _generarSal($length=40)
	{
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$sal = '';

		if ($length > 0) {
			$totalChars = strlen($characters) - 1;
			for ($i = 0; $i <= $length; ++$i) {
				$sal .= $characters[rand(0, $totalChars)];
			}
		}
		return $sal;
	}
	
	
	
	
	public function validar($usename, $password)
	{
		$this->usuario->username=$usename;
		
		if($this->usuario->validar($this->session->userdata('sal'),$password))
		{
			//crear sesion;
			$this->session->unset_userdata('sal');
			$this->session->set_userdata('usuario', $this->usuario->serialize());
			$this->session->set_userdata('isLogged', true);
			//redirect(base_url());
			return true;
		}
		else
		{
			//devuelve al usuario a la pantalla de login
			return false;
			//$this->login("Los datos proporcionados no coinciden con ningún registro");
		}
	}
	
	
	
	public function isLogged()
	{
		$this->isLogged=$this->session->userdata('isLogged');
		return $this->isLogged;
	}
	
	
	
	
	
	
	public function cumpleRol($roles)
	{
		if(in_array($this->usuario->rol, $roles))
		{
			$this->cumpleRol=true;
			return $this->cumpleRol;
		}
		else
		{
			$this->cumpleRol=false;
			return $this->cumpleRol;
		}
		
	}
	
}