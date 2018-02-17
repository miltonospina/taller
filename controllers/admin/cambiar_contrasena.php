<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cambiar_contrasena extends Aplicacion{
/**
 * controlador de gestión de usuarios.
 */
 

	function __construct()
	{
		parent::__construct();
		$this->appcode=30;
		$this->titulo2="Cambiar Contraseña";
		//$this->load->model("maquina");
	}
	
	
	
	
	function lista()
	{
		$this->login();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		
		$args['datos']= json_encode( $this->maquina->getAll());
		$this->load->view('blanco',$args);
	}
	
	
	
	
	
	function insertar()
	{
		$this->login(array("Administrador"));
		//Pendiente validacion en servidor
		$this->maquina->nombre=$this->input->post("nombre");
		$this->maquina->proceso=$this->input->post("proceso");
		
		
		if($this->maquina->crear()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"Máquina creada exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible crear la máquina.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}
	
	
	
	function editar()
	{
		$this->login(array("Administrador"));
		
		//Pendiente validacion en servidor
		$this->maquina->codigo=$this->input->post("codigo");
		$this->maquina->nombre=$this->input->post("nombre");
		$this->maquina->proceso=$this->input->post("proceso");
		
		if($this->maquina->editar()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"máquina editada exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible editar la máquina.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}

}