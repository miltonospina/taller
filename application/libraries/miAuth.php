<?php
class miAuth
{
	var $usuario;
	var $isLogged=false;
	var $cumpleRol=false;
	
	public function __construct()
	{
		
		$this->CI =  & get_instance();
		$this->CI->load->library('session');
		$this->CI->load->model('usuario','','usuario');
		$this->usuario=$this->CI->usuario;
		$this->usuario->unserialize($this->CI->session->userdata('usuario'));
		
		
	}
	
	
	function validar($usuario,$password)
	{
		$this->usuario->nombre=$usuario;
		
		if($this->usuario->validar($this->CI->session->userdata('sal'),$password))
		{
			//crear sesion;
			$this->CI->session->unset_userdata('sal');
			$this->CI->session->set_userdata('usuario', $this->usuario->serialize());
			$this->CI->session->set_userdata('isLogged', true);
			redirect(base_url());
		}
		else
		{
			//devuelve al usuario a la pantalla de login
			$this->login("Los datos proporcionados no coinciden con ningún registro");
		}
	}
	
	
	public function login($msg="")
	{
		$sal=$this->_generarSal();
		$this->CI->session->set_userdata('sal', $sal);
		$this->CI->load->view('login',array('sal'=>$sal,'msg'=>$msg));
	}
	
	
	
	public function logout()
	{
		$this->CI->session->sess_destroy();
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
	
	
	
	public function isLogged()
	{
		$this->isLogged=$this->CI->session->userdata('isLogged');
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
?>