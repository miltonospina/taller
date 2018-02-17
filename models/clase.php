<?php

class Clase extends CI_Model {


	var $codigo;
	var $nombre;
	var $atributos;






	public function __construct()
	{
		$this->atributos=Array();
	}





	function crear()
	{
	//json_encode()
		$sqlCrear= array(
			'nombre'=>$this->nombre,
			'atributos'=>json_encode($this->atributos),
			);

		$this->db->insert('clases', $sqlCrear);
		return $this->db->_error_number();
	}






	public function getAll()
	{

		$query = $this->db->select('*')->get( 'clases' );


		$clase=array();
		if( $query->num_rows() > 0 )
		{
			$indice=0;
			foreach ($query->result() as $row)
			{
				$clase[$indice]=$this;
				$clase[$indice]->codigo=$row->codigo;
				$clase[$indice]->cargar();
				$clase[$indice]=clone $this;

				$indice++;
			}
			return $clase;
		}
		else
		{
			return $clase;
		}

    } //end getAll






	public function eliminar()
	{
		$this->db->delete( 'clases', array( 'codigo' => intval($this->codigo)) );
		return $this->db->_error_number();
	}






	public function getByCodigo( $id )
	{
		$id = intval( $id );

		$query = $this->db->select('codigo')->where( 'codigo', $id )->limit( 1 )->get( 'clases' );

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
		$query = $this->db->where( 'codigo', $this->codigo)->limit( 1 )->get( 'clases' );
		if( $query->num_rows() > 0 )
		{
			foreach ($query->result() as $row)
			{
				$this->codigo=$row->codigo;
				$this->nombre=$row->nombre;
				$this->atributos=json_decode($row->atributos);
			}
		} else
		{
			return false;
		}
	}





	public function editar()
	{
		$data = array(
			'nombre'=>$this->nombre,
			'atributos'=>json_encode($this->atributos)
			);
		$this->db->update( 'clases', $data, array( 'codigo' => $this->codigo ));
		return $this->db->_error_number();
	}




	public function get_por_nombre($nombre)
	{

		$query = $this->db->select('codigo')->like("nombre",$nombre)->get( 'clases' );

		$clase=array();
		if( $query->num_rows() > 0 )
		{
			$indice=0;
			foreach ($query->result() as $row)
			{
				$clase[$indice]=$this;
				$clase[$indice]->codigo=$row->codigo;
				$clase[$indice]->cargar();
				$clase[$indice]=clone unserialize(serialize($this));

				$indice++;
			}

		}
		return $clase;

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
			$this->atributos=$obj->atributos;
		}
	}

}
