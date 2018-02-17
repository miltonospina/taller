<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion_cargos extends Aplicacion{
/**
 * controlador de gestión de usuarios.
 */
 
	var $roles;

	function __construct()
	{
		parent::__construct();
		$this->appcode=16;
		$this->titulo2="Administración de cargos y funciones";
		
		$this->roles[]="Administrador";
		$this->roles[]="Standar";
		$this->load->model("cargo");
	}
	
	
	
	
	
	//Carga la vista principal del controlador de usuarios
	function index()
	{
		$this->login();
		$this->args['contenidoVista']=$this->load->view("personal/cargos_v",$this->datos,true);
		$this->generarVista();
	}
	
	
	
	
	
	
	function lista($rol="")
	{
		$this->login();
		$rol=urldecode($rol);
		$args['datos']= json_encode( $this->cargo->getAll($rol));
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->view('blanco',$args);
	}
	
	
	
	
	function insertar()
	{
		
		$this->login();
	
		$this->cargo->codigo_ipsa=$this->input->post("codigo_ipsa");
		
		$this->cargo->dependencia= array(
			"vicepresidencia"=>$this->input->post("viceprecidencia"),
			"gerencia"=>$this->input->post("gerencia"),
			"direccion"=>$this->input->post("direccion"),
			"departamento"=>$this->input->post("departamento"),
			"seccion"=>$this->input->post("seccion"));
			
		if(!is_null($this->input->post("jefe")))
		{
			$this->cargo->jefe->codigo=$this->input->post("jefe");
		}
		
		$this->cargo->primera_edicion=date_create($this->input->post("primera_edicion"));
		$this->cargo->actualizacion=date_create($this->input->post("actualizacion"));
		$this->cargo->nombre=$this->input->post("nombre");
		$this->cargo->edicion=$this->input->post("edicion");
		$this->cargo->mision=$this->input->post("mision");
		$this->cargo->status="activo";
		$this->cargo->autor= $this->usuario;
		
		if($this->cargo->crear()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"Cargo creado exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible crear el Cargo.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}
	
	
	function eliminar()
	{
		$this->login();
		
		$this->cargo->codigo=$this->input->post("codigo");
		if($this->cargo->eliminar()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"cargo eliminado exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible eliminar el cargo.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}
	
	
	
	function editar()
	{
		$this->login();
		
		//Pendiente validacion en servidor
		$this->usuario->codigo=$this->input->post("codigo");
		$this->usuario->nombre=$this->input->post("nombre");
		$this->usuario->username=$this->input->post("username");
		//$this->usuario->password=$this->input->post("password");
		$this->usuario->identificacion=$this->input->post("identificacion");
		$this->usuario->rol=$this->input->post("rol");
		$this->usuario->correo=$this->input->post("correo");
		$this->usuario->telefono=$this->input->post("telefono");
		
		if($this->usuario->editar()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"Usuario editado exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible editar el usuario.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}
	
	
	
	function buscar()
	{
		$this->login();	
		$term=$this->input->get("term");
		
		
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		
		$args['datos']= json_encode( $this->cargo->get_por_nombre($term));
		$this->load->view('blanco',$args);
	}
	
	
	
	
	
	
	//Carga la vista principal del controlador de usuarios
	function ver_detalle($cargo)
	{
		$this->titulo2="Detalle del Cargo";
		$this->cargo->codigo=$cargo;
		$this->cargo->cargar();
		$this->datos['cargo']=$this->cargo;
		$this->login();
		$this->args['contenidoVista']=$this->load->view("personal/detalle_cargo_v",$this->datos,true);
		$this->generarVista();
	}
	
	
	
		function detalle($cargo)
	{
		$this->login();
		$this->cargo->codigo=$cargo;
		$this->cargo->cargar();
		$args['datos']= json_encode( $this->cargo);
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->view('blanco',$args);
	}
	
	
}