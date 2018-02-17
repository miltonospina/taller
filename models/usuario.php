<?php

class Usuario extends CI_Model {


	var $codigo;
	var $nombre;
	var $username;
	var $password;
	var $fecharegistro;
	var $telefono;
	var $identificacion;
	var $correo;
	var $rol;
	
	
	
	
	
	
	public function __construct()
	{
	}
	
	
	
	
	
	/*Comprueba el usuario vs la base de datos. para autenticacion*/
	function validar($sal,$psw)
	{
		$this->db->where('username', $this->username);
		$query = $this->db->get('usuarios');
		//echo $this->db->last_query();
		
		if($query->num_rows == 1)
		{
			foreach ($query->result() as $row)
			{
				$this->codigo=$row->codigo;
				$this->nombre=$row->nombre;
				$this->password=$row->password;
				$this->username=$row->username;
				$this->rol=$row->rol;
			}
			if(md5($this->password.$sal)==$psw){//md5(md5(psw).sal)
				//echo 'el usuario es válido';
				return true;
				
			}
			else{
				//echo 'existe el usuario pero la contraseña no coincide o la sal está vencida';
				return false;
				
			}
		}
		else{
			echo 'no existe en usuario en la base de datos';
			return false;
			
		}
	}
	
	
	
	
	
	function crear()
	{
		$sqlCrear= array(
			'nombre' => $this->nombre,
			'username' => $this->username,
			'password' => md5($this->password),
			'fecharegistro' => date('Y-m-d H:i:s'),
			'telefono' => $this->telefono,
			'identificacion' => $this->identificacion,
			'correo' => $this->correo,
			'telefono' => $this->telefono,
			'rol' => $this->rol);
		
		$this->db->insert('usuarios', $sqlCrear);
		return $this->db->_error_number();
	}
	
	
	
	
	
	
	public function getAll($rol='')
	{
		$query='';
		if($rol=='')
		{
			$query = $this->db->select('codigo,nombre, username, rol')->get( 'usuarios' );
		}
		else
		{
			$query = $this->db->select('codigo,nombre, username, rol')->where('rol',$rol)->get( 'usuarios' );
		}
		
		$usuarios=array();
		if( $query->num_rows() > 0 )
		{
			$indice=0;
			foreach ($query->result() as $row)
			{
				$usuarios[$indice]=$this;
				$usuarios[$indice]->codigo=$row->codigo;
				$usuarios[$indice]->cargar();
				$usuarios[$indice]=clone $this;
				
				$indice++;
			}
			return $usuarios;
		} 
		else
		{
			return $usuarios;
		}
 
    } //end getAll
	
	
	
	
	
	
	public function eliminar()
	{
		$this->db->delete( 'usuarios', array( 'codigo' => intval($this->codigo)) );
		return $this->db->_error_number();
	}

	
	
	
	
	
	public function getByCodigo( $id )
	{
		$id = intval( $id );
	 
		$query = $this->db->select('codigo,nombre, username, rol')->where( 'codigo', $id )->limit( 1 )->get( 'usuarios' );
	 
		if( $query->num_rows() > 0 )
		{
			foreach ($query->result() as $row)
			{
				$this->codigo=$row->codigo;
				$this->cargar();
				return $this;
			}
		} else
		{
			return array();
		}
	}
	
	
	
	
	
	
	public function cargar()
	{
		$query = $this->db->where( 'codigo', $this->codigo)->limit( 1 )->get( 'usuarios' );
		if( $query->num_rows() > 0 )
		{
			foreach ($query->result() as $row)
			{
				$this->codigo=$row->codigo;
				$this->nombre=$row->nombre;
				$this->password=$row->password;
				$this->username=$row->username;			
				$this->fecharegistro=$row->fecharegistro;
				$this->telefono=$row->telefono;
				$this->identificacion=$row->identificacion;
				$this->correo=$row->correo;
				$this->rol=$row->rol;
			}
		} else
		{
			return false;
		}
	}

	
	
	
	
	public function editar()
	{
		$data = array(
			'nombre' => $this->nombre,
			'username' => $this->username,
			'telefono' => $this->telefono,
			'identificacion' => $this->identificacion,
			'correo' => $this->correo,
			'telefono' => $this->telefono,
			'rol' => $this->rol);

		$this->db->update( 'usuarios', $data, array( 'codigo' => $this->codigo ));
		return $this->db->_error_number();
	}


	
	
	
	public function editar_contrasena()
	{
		$data = array('password' => $this->password);

		$this->db->update( 'usuarios', $data, array( 'codigo' => $this->codigo ));
		return $this->db->_error_number();
	}
	
	
	
	
	public function serialize()
	{
		$obj = null;
		$obj= serialize($this);
		return $obj;
    }

	
	
	
	
	
	public function unserialize($obj)
	{
		$obj=unserialize($obj);
		if($obj!=null)
		{
			$this->codigo=$obj->codigo;
			$this->nombre=$obj->nombre;
			$this->username=$obj->username;
			$this->password=$obj->password;
			$this->rol=$obj->rol;
		}
	}
	
}