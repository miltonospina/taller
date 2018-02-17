<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion_productos extends Aplicacion{
/**
 * controlador de gestión de usuarios.
 */

	var $roles;

	function __construct()
	{
		parent::__construct();
		$this->appcode=802;
		$this->titulo2="Gestión de referencias de productos";

		$this->roles[]="Administrador";
    $this->load->model("producto");
	}





	//Carga la vista principal del controlador de productos
	function index()
	{
		$this->login();
		$this->datos['roles']=$this->roles;
		$this->args['contenidoVista']=$this->load->view("productos/productos_v",$this->datos,true);
		$this->generarVista();
	}





	function lista()
	{
		$this->login();
		$args['datos']= json_encode( $this->producto->getAll());
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->view('blanco',$args);
	}




	function insertar()
	{
		$this->login();

		//Pendiente validacion en servidor
		$this->producto->codigo=$this->input->post("codigo");
		$this->producto->nombre=$this->input->post("nombre");
		$this->producto->descripcion=$this->input->post("descripcion");
		$this->producto->clase->codigo=$this->input->post("clase");
		$this->producto->clase->cargar();


		if($this->producto->crear()==0)
		{
			$notificaciones[0]=array("producto"=>"success","mensaje"=>"referencia de producto creada exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("producto"=>"danger","mensaje"=>"Imposible crear la referencia de producto.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}


	function eliminar()
	{
		$this->login();

		$this->producto->codigo=$this->input->post("codigo");
		if($this->producto->eliminar()==0)
		{
			$notificaciones[0]=array("producto"=>"success","mensaje"=>"referencia de producto eliminada exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("producto"=>"danger","mensaje"=>"Imposible eliminar la referencia de producto.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}



	function editar()
	{
		$this->login();

		//Pendiente validacion en servidor
		$this->producto->codigo=$this->input->post("codigo");
		$this->producto->nombre=$this->input->post("nombre");
		$this->producto->descripcion=$this->input->post("descripcion");
		$this->producto->clase->codigo=$this->input->post("clase");
		$this->producto->clase->cargar();

		if($this->usuario->editar()==0)
		{
			$notificaciones[0]=array("producto"=>"success","mensaje"=>"producto de producto modificada exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("producto"=>"danger","mensaje"=>"Imposible editar la referencia de producto.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}





}
