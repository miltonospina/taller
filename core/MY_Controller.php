<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aplicacion extends CI_Controller {

	var $appcode; /*Codigo de la aplicacion registrado en la DB*/
	var $codigopadre=null;
	var $titulo;
	var $titulo2;
	var $jerarquia;
	var $documento;
	//var $tema="default";
	var $tema="sb-admin-v2";
	var $args;
	var $datos;
	var $repositorio='';
	var $sesion;
	var $privilegios="";
	var $scripts="";
	
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','text')); 
		
		$this->load->database(); 
		
		$this->load->model("link"); 
		$this->load->model("sesion","objetoSesion"); 
		$this->load->model("usuario","objetoUsuario"); 
		$this->sesion= clone $this->objetoSesion;
		$this->usuario= clone $this->objetoUsuario;

		$this->usuario->unserialize($this->session->userdata('usuario'));
		
		$this->datos["ruta_tema"]=base_url()."application/views/app/{$this->tema}";
		$this->datos["tema"]=$this->tema;
		$this->datos["usuario"]=$this->usuario;
		
		setlocale(LC_TIME, 'es_CO');
		setlocale(LC_MONETARY, 'es_CO');
		
		
		
	}
	
	
	
	
	
	/* Carga la jerarquía de la pantalla para armar el menú de navegación*/
	function cargarJerarquia($codigo =NULL)
	{
		$consulta="";
		if($codigo==NULL)
		{
			$query = $this->db->select('codigo,titulo,descripcion,padre,uri,icono')->where( 'padre', NULL)->get( 'pantallas');
		}
		else
		{
			$query = $this->db->select('codigo,titulo,descripcion,padre,uri,icono')->where( 'padre', $codigo)->get( 'pantallas');
		}
		$arr = array();
		foreach ($query->result_array() as $row)
		{	
			$arr[$row['codigo']]=new Link($row['codigo'],base_url().$row['uri'],$row['descripcion'],"",$row['titulo'],$row['icono']);
			
			
			$arr[$row['codigo'] ]->hijos=$this->cargarJerarquia($row['codigo']);
			$arr[$row['codigo'] ]->padre=$row['padre'];
			if($arr[$row['codigo'] ]->padre=="")
			{
				$arr[$row['codigo'] ]->padre=$row['codigo'] ;
			}
			
			
			
			//Asigna al vínculo de la aplicación la clase activo
			if($row['codigo']==$this->appcode)
			{
				$arr[$row['codigo'] ]->clases="activo";
				
				$this->titulo=$arr[$row['codigo']];
			}
		}
		$this->jerarquia=$arr;
		return $arr;
	}
	
	
	
	
	
	
	/* Imprime el html de la aplicación*/
	public function generarVista()
	{
		header("Content-type: text/html; charset=UTF-8");
		//carga la jerarquia de pantallas desde la base de datos
		$this->cargarJerarquia();
		
		//obtener el codigo padre
		$query = $this->db->select('codigo,padre')->where( 'codigo',$this->appcode)->get( 'pantallas');
		
		foreach ($query->result_array() as $row)
		{
			$this->codigopadre=$row['padre'];
		}
		//echo($this->db->last_query());
		

		//asigna las variables a los argumentos para las vistas
		$this->args["appcode"]=$this->appcode;
		$this->args["titulo"]=$this->titulo;
		$this->args["titulo2"]=$this->titulo2;
		$this->args["jerarquia"]=$this->jerarquia;
		$this->args["usuario"]=$this->usuario;
		$this->args["codigopadre"]=$this->codigopadre;
		
		
		//cargar Header
		$this->load->helper("sb-admin-v2_helper");
		$documento["header"]=$this->load->view("app/{$this->tema}/header.php",$this->args,true);
		
		//cargar Footer
		$documento["footer"]=$this->load->view("app/{$this->tema}/footer.php",$this->args,true);
		
		//cargar Body
		$documento["content"]=$this->load->view("app/{$this->tema}/content.php",$this->args['contenidoVista'],true);
		$documento["scripts"]=$this->scripts;
		
		//carga 
		$this->load->view("app/{$this->tema}/document.php",$documento);
	}
	
	
	
	
	/* Lo del login y eso*/
	/*recibe un array con los nombres de los roles permitidos y un texto con un mensaje
	Si hay sesion de usuario,continua al controlador solicitado
	Sino, presenta el formulario de login
	*/
	public function login($roles=null,$mensaje=null)
	{
		if($this->sesion->isLogged())
		{
			if($roles==null)
			{
				return true;
			}
			else
			{
				if(in_array($this->usuario->rol, $roles))
				{
					return true;
				}
				else
				{
					$this->args['contenidoVista']=$this->load->view("permisos_v",$this->datos,true);
					$this->generarVista();
				}
			}
		}
		else
		{
			$this->load->helper('url');
			$this->load->helper('form');
			$sal=$this->sesion->login();
			
			$this->load->view("app/{$this->tema}/login.php",array('sal'=>$sal,'msg'=>$mensaje));
			
			die($this->output->get_output());
		}
	}
	
	
	public function ingresar()
	{
		if($this->input->post('username'))
		{
			$this->sesion->validar($this->input->post('username'),$this->input->post('password'));
			log_message(1, '186');
			redirect(base_url());
		}
		else
		{
			log_message(1, '165');
			$this->login("Debe escribir un usuario y una contraseña válida");
		}
	}
	
	
	
	public function salir()
	{
		$this->sesion->logout();
	}
	
	
	
	
	
	
	
}