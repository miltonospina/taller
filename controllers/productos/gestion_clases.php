<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion_clases extends Aplicacion{
/**
 * controlador de gestión de usuarios.
 */

	var $roles;

	function __construct()
	{
		parent::__construct();
		$this->appcode=802;
		$this->titulo2="Gestión de clases de productos";

		$this->roles[]="Administrador";
    $this->load->model("clase");
	}





	//Carga la vista principal del controlador de clases
	function index()
	{
		$this->login();
		$this->datos['roles']=$this->roles;
		$this->args['contenidoVista']=$this->load->view("productos/clases_v",$this->datos,true);
		$this->generarVista();
	}




  //Carga la vista detallada de la clase de productos
  function ver_detalle($clase)
	{
		$this->titulo2="Detalle de la clase";
		$this->clase->codigo=$clase;
		$this->clase->cargar();
		$this->datos['clase']=$this->clase;
		$this->login();
		$this->args['contenidoVista']=$this->load->view("productos/detalle_clases_v",$this->datos,true);
		$this->generarVista();
	}



  //Devuelve los datos JSON de la clases vista en detalle
	function detalle($clase)
	{
		$this->login();
		$this->clase->codigo=intval($clase);
		$this->clase->cargar();
		$args['datos'] = json_encode($this->clase->atributos);
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->view('blanco',$args);
	}



	function lista()
	{
		$this->login();
		$args['datos']= json_encode( $this->clase->getAll());
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->view('blanco',$args);
	}




	function insertar()
	{
		$this->login();

		//Pendiente validacion en servidor
		$this->clase->nombre=$this->input->post("nombre");


		if($this->clase->crear()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"Clase de producto creada exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible crear la clase.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}


	function eliminar()
	{
		$this->login();

		$this->clase->codigo=$this->input->post("codigo");
		if($this->clase->eliminar()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"Clase de producto eliminada exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible eliminar la clase de producto.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}



	function editar()
	{
		$this->login();

		//Pendiente validacion en servidor
		$this->clase->codigo=$this->input->post("codigo");
		$this->clase->nombre=$this->input->post("nombre");

		if($this->usuario->editar()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"Clase de producto modificada exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible editar la clase de producto.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}


	function agregar_atributo()
	{
		$this->login();
		//$atributo = array('clave' => $this->input->post("clave"),'valor'=>$this->input->post("valor")) ;
		//$atributo= array($this->input->post("clave") => $this->input->post("valor") );
		$this->clase->codigo=intval($this->input->post("clase"));
		$this->clase->cargar();

		$att=$this->clase->atributos;
		$att[$this->input->post("clave")]=$this->input->post("valor");
		$this->clase->atributos=$att;

		if($this->clase->editar()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"Atributo agregado exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible agregar el atributo.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}


}
