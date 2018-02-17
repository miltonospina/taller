<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion_usuarios extends Aplicacion{
/**
 * controlador de gestión de usuarios.
 */
 
	var $roles;

	function __construct()
	{
		parent::__construct();
		$this->appcode=27;
		$this->titulo2="Administración de usuarios del sistema";
		
		$this->roles[]="Administrador";
		$this->roles[]="Standar";
	}
	
	
	
	
	
	//Carga la vista principal del controlador de usuarios
	function index()
	{
		$this->login();
		$this->datos['roles']=$this->roles;
		$this->args['contenidoVista']=$this->load->view("admin/usuarios_v",$this->datos,true);
		$this->generarVista();
	}
	
	
	
	
	
	
	function lista($rol="")
	{
		$this->login();
		$rol=urldecode($rol);
		$args['datos']= json_encode( $this->usuario->getAll($rol));
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->view('blanco',$args);
	}
	
	
	
	
	function insertar()
	{
		$this->login();
		
		//Pendiente validacion en servidor
		$this->usuario->nombre=$this->input->post("nombre");
		$this->usuario->username=$this->input->post("username");
		$this->usuario->password=$this->input->post("password");
		$this->usuario->identificacion=$this->input->post("identificacion");
		$this->usuario->rol=$this->input->post("rol");
		$this->usuario->correo=$this->input->post("correo");
		$this->usuario->telefono=$this->input->post("telefono");
		
		if($this->usuario->crear()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"Usuario creado exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible crear el usuario.</p><p><code>".$this->db->_error_message()."</code>");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
	}
	
	
	function eliminar()
	{
		$this->login();
		
		$this->usuario->codigo=$this->input->post("codigo");
		if($this->usuario->eliminar()==0)
		{
			$notificaciones[0]=array("clase"=>"success","mensaje"=>"Usuario eliminado exitosamente");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
		}
		else
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Imposible eliminar el usuario.</p><p><code>".$this->db->_error_message()."</code>");
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
	
	
	function form_cambiar_contrasena()
	{
		$this->login();
		
		//$this->usuario->codigo=$usuario;
		//$this->usuario->cargar();
		$this->datos["usuario"]=$this->usuario;
		$this->args['contenidoVista']=$this->load->view("admin/cambiar_contrasena_v",$this->datos,true);
		$this->generarVista();
	}
	
	
	function cambiar_contrasena()
	{
		$this->login();
		
		
		if($this->input->post("password1") != $this->input->post("password2"))
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Contraseña de confirmacion diferente de contraseña nueva");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
			die($this->output->get_output());			
		}
		
		$this->load->model("usuario","usuarioeditar");
		$this->usuarioeditar->codigo=$this->input->post("codigo");
		$this->usuarioeditar->cargar();

		
		if($this->usuarioeditar->password != md5($this->input->post("password0")))
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Contraseña de ultimo acceso no coincide con contraseña ingresada");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
			die($this->output->get_output());	
		}
		
		
		if($this->input->post("password1") == null)
		{
			$notificaciones[0]=array("clase"=>"danger","mensaje"=>"Contraseña nueva no puede debe estar vacia");
			$args['datos']=json_encode($notificaciones);
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->load->view('blanco',$args);
			die($this->output->get_output());	
		}
		
		
		//$args['datos']="<pre>".print_r($this->usuarioeditar,1)."</pre>";
		
		$this->usuarioeditar->password=md5($this->input->post("password1"));
		//$this->usuarioeditar->editar_contrasena();
		
		
		if($this->usuarioeditar->editar_contrasena()==0)
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
		
		//$args['datos'].="<pre>".print_r($this->usuarioeditar,1)."</pre>";
		
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->view('blanco',$args);	
		
		
		
	
	}
	
}