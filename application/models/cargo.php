<?php

class Cargo extends CI_Model {


	var $codigo;
	var $codigo_ipsa;
	var $dependencia;
	var $primera_edicion;
	var $actualizacion;
	var $edicion;
	var $nombre;
	var $jefe;
	var $mision;
	var $funciones;
	var $relaciones;
	var $riesgos;
	var $jornada;
	var $requisitos;
	var $anexos;
	var $autor;
	var $fecha_carga;
	var $status;

	
	
	
	
	
	public function __construct()
	{
		$this->jefe= clone $this;
		$this->dependencia=array();
		$this->funciones=array();
		$this->relaciones=array();
		$this->riegos=array();
		$this->jornada=array();
		$this->requisitos=array();
		$this->anexos=array();
		
	}
	
	
	
	
	
	function crear()
	{
	//json_encode()
		$sqlCrear= array(
			'codigo_ipsa'=>$this->codigo_ipsa,
			'primera_edicion'=>date_format($this->primera_edicion,'Y-m-d H:i:s'),
			'actualizacion'=>date_format($this->actualizacion,'Y-m-d H:i:s'),
			'edicion'=>$this->edicion,
			'dependencia'=>json_encode($this->dependencia),
			'nombre'=>$this->nombre,
			'jefe'=>$this->jefe->codigo,
			'mision'=>$this->mision,
			'funciones'=>json_encode($this->funciones),
			'relaciones'=>json_encode($this->relaciones),
			'riesgos'=>json_encode($this->riesgos),
			'jornada'=>json_encode($this->jornada),
			'requisitos'=>json_encode($this->requisitos),
			'anexos'=>json_encode($this->anexos),
			'autor'=>$this->autor->codigo,
			'fecha_carga'=> date('Y-m-d H:i:s'),
			'status'=>$this->status
			);

		
		
		$this->db->insert('cargos', $sqlCrear);
		return $this->db->_error_number();
	}
	
	
	
	
	
	
	public function getAll()
	{

		$query = $this->db->select('*')->get( 'cargos' );

		
		$cargos=array();
		if( $query->num_rows() > 0 )
		{
			$indice=0;
			foreach ($query->result() as $row)
			{
				$cargos[$indice]=$this;
				$cargos[$indice]->codigo=$row->codigo;
				$cargos[$indice]->cargar();
				$cargos[$indice]=clone $this;
				
				$indice++;
			}
			return $cargos;
		} 
		else
		{
			return $cargos;
		}
 
    } //end getAll
	
	
	
	
	
	
	public function eliminar()
	{
		$this->db->delete( 'cargos', array( 'codigo' => intval($this->codigo)) );
		return $this->db->_error_number();
	}

	
	
	
	
	
	public function getByCodigo( $id )
	{
		$id = intval( $id );
	 
		$query = $this->db->select('codigo')->where( 'codigo', $id )->limit( 1 )->get( 'cargos' );
	 
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
		$query = $this->db->where( 'codigo', $this->codigo)->limit( 1 )->get( 'cargos' );
		if( $query->num_rows() > 0 )
		{
			foreach ($query->result() as $row)
			{
				$this->codigo=$row->codigo;
				$this->codigo_ipsa=$row->codigo_ipsa;
				$this->primera_edicion=$row->primera_edicion;
				$this->actualizacion=$row->actualizacion;
				$this->dependencia=json_decode($row->dependencia);
				$this->edicion=$row->edicion;
				$this->nombre=$row->nombre;
				
				if( $row->jefe!=null || $row->jefe==0)
				{
					$this->jefe->codigo=$row->jefe;
					$this->jefe->cargar();
				}
				else
				{
					$this->jefe=null;
				}
				
				$this->mision=$row->mision;
				
				$this->funciones=json_decode($row->funciones);
				$this->relaciones=json_decode($row->relaciones);
				$this->riesgos=json_decode($row->riesgos);
				$this->jornada=json_decode($row->jornada);
				$this->requisitos=json_decode($row->requisitos);
				
				$this->anexos=json_decode($row->anexos);
				
				$this->autor=$this->usuario;
				$this->autor->codigo=$row->autor;
				$this->autor->cargar();
				$this->fecha_carga=$row->fecha_carga;
				$this->status=$row->status;

			}
		} else
		{
			return false;
		}
	}

	
	
	
	
	public function editar()
	{
		$data = array(
			'primera_edicion'=>$this->primera_edicion,
			'actualizacion'=>$this->actualizacion,
			'edicion'=>$this->edicion,
			'dependencia'=>json_encode($this->dependecia),
			'nombre'=>$this->nombre,
			'jefe'=>$this->jefe->codigo,
			'mision'=>$this->mision,
			'funciones'=>json_encode($this->funciones),
			'relaciones'=>json_encode($this->relaciones),
			'riesgos'=>json_encode($this->riesgos),
			'jornada'=>$this->jornada,
			'requisitos'=>json_encode($this->requisitos),
			'anexos'=>json_encode($this->anexos),
			'autor'=>$this->autor->codigo,
			'status'=>$this->status
			);

		$this->db->update( 'cargos', $data, array( 'codigo' => $this->codigo ));
		return $this->db->_error_number();
	}


	
	
	public function get_por_nombre($nombre)
	{

		$query = $this->db->select('codigo')->like("codigo_ipsa",$nombre)->or_like("nombre",$nombre)->get( 'cargos' );

		$articulos=array();
		if( $query->num_rows() > 0 )
		{
			$indice=0;
			foreach ($query->result() as $row)
			{
				$articulos[$indice]=$this;
				$articulos[$indice]->codigo=$row->codigo;
				$articulos[$indice]->cargar();
				$articulos[$indice]=clone unserialize(serialize($this));
				
				$indice++;
			}
			
		} 
		//$articulos[]=$this->db->last_query();
		return $articulos;
 
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