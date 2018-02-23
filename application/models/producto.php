<?php

class Producto extends CI_Model {


	var $codigo;
	var $nombre;
	var $descripcion;
	var $clase;
	var $atributos;






	public function __construct()
	{
		$this->load->model("clase","objetoClase");
		$this->clase=clone $this->objetoClase;

		$this->atributos=Array();
	}





	function crear()
	{
	//json_encode()
		$sqlCrear= array(
			'nombre'=>$this->nombre,
			'descripcion'=>$this->descripcion,
			'clase'=>$this->clase->codigo,
			'atributos'=>serialize($this->atributos),
			);


		$this->db->insert('productos', $sqlCrear);
		return $this->db->_error_number();
	}






	public function getAll()
	{

		$query = $this->db->select('*')->get( 'productos' );


		$productos=array();
		if( $query->num_rows() > 0 )
		{
			$indice=0;
			foreach ($query->result() as $row)
			{
				$productos[$indice]=$this;
				$productos[$indice]->codigo=$row->codigo;
				$productos[$indice]->cargar();
				$productos[$indice]=clone $this;

				$indice++;
			}
			return $productos;
		}
		else
		{
			return $productos;
		}

    } //end getAll






	public function eliminar()
	{
		$this->db->delete( 'productos', array( 'codigo' => intval($this->codigo)) );
		return $this->db->_error_number();
	}






	public function getByCodigo( $id )
	{
		$id = intval( $id );

		$query = $this->db->select('codigo')->where( 'codigo', $id )->limit( 1 )->get( 'productos' );

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
		$query = $this->db->where( 'codigo', $this->codigo)->limit( 1 )->get( 'productos' );
		if( $query->num_rows() > 0 )
		{
			foreach ($query->result() as $row)
			{
				$this->codigo=$row->codigo;
				$this->nombre=$row->nombre;
				$this->descripcion=$row->descripcion;

				$this->clase->codigo=$row->clase;
				$this->clase->cargar();

				//$this->atributos=clone $this->clase->atributos;
				$this->atributos=unserialize($row->atributos);


			}
		}
		else
		{
			return false;
		}
	}





	public function editar()
	{
		$data = array(
			'nombre'=>$this->nombre,
			'descripcion'=>$this->descripcion,
			'clase'=>$this->clase,
			'atributos'=>serialize($this->atributos)
			);

		$this->db->update( 'productos', $data, array( 'productos' => $this->codigo ));
		return $this->db->_error_number();
	}




	public function get_por_nombre($nombre)
	{

		$query = $this->db->select('codigo')->like("nombre",$nombre)->or_like("descripcion",$descripcion)->get( 'productos' );

		$productos=array();
		if( $query->num_rows() > 0 )
		{
			$indice=0;
			foreach ($query->result() as $row)
			{
				$productos[$indice]=$this;
				$productos[$indice]->codigo=$row->codigo;
				$productos[$indice]->cargar();
				$productos[$indice]=clone unserialize(serialize($this));

				$indice++;
			}

		}
		return $productos;

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
			$this->clase=$obj->clase;
			$this->atributos=$obj->atributos;
		}
	}

}
