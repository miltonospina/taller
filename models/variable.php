<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Clase que define las variables instantanes de proceso
*/
class Variable extends CI_Model
{
	var $codigo;
	var $tag;
	var $nombre;
	var $unidad;
	var $valor;
	var $lim_superior;
	var $lim_inferior;
	var $time_up;
	var $hist_sample;
	var $hist_enable;// se va
	
	
	
	
	
	
	/*Método constructor*/
	public function __construct()
	{
		parent::__construct();
	}
	
	
	
	
	
	/* Función que regresa un arreglo de variables de proceso o una variable especifica */
	public function get_vars($id = null)
	{
		$dbwincc=$this->load->database("winccMSSQL", true);
		//si no se le proporciona un ID de variable (traer todas)
		if($id==null)
		{
		
			$query = $dbwincc->get('variables');
			$rs= $query->result_array();
			
			$respuesta=array();
			
			foreach ($rs as $rs_item)
			{
				$this->codigo=$rs_item['codigo']+0;
				$this->tag=$rs_item['tag'];
				$this->nombre=$rs_item['nombre'];
				$this->unidad=$rs_item['unidad'];
				$this->valor=$rs_item['valor']+0;
				$this->lim_superior=$rs_item['limite_superior']+0;
				$this->lim_inferior=$rs_item['limite_inferior']+0;
				$this->time_up= date($rs_item['ultima_actualizacion']);
				$this->hist_sample=$rs_item['periodo_historico'];
				$this->hist_enable=$rs_item['activa'];
				
				$respuesta[]= clone $this;
			}
			return $respuesta;
		}
		//si se le proporciona un ID de variable (traer una)
		else if(is_int($id))
		{
			$query = $dbwincc->get_where('variables', array('codigo' => $id));
			$rs=$query->result_array();
			foreach ($rs as $rs_item)
			{
				$this->codigo=$rs_item['codigo']+0;
				$this->tag=$rs_item['tag'];
				$this->nombre=$rs_item['nombre'];
				$this->unidad=$rs_item['unidad'];
				$this->valor=$rs_item['valor']+0;
				$this->lim_superior=$rs_item['limite_superior']+0;
				$this->lim_inferior=$rs_item['limite_inferior']+0;
				$this->time_up= date($rs_item['ultima_actualizacion']);
				$this->hist_sample=$rs_item['periodo_historico'];
				$this->hist_enable=$rs_item['activa'];
			}
			
			return $this;
		}
		//si se le proporciona un array de ID de variables (traer varias)
		else
		{
			$query = $dbwincc>select()->where_in('codigo', $id)->get( 'variables' );
			
			$respuesta=array();
			
			foreach ($query->result() as $rs_item)
			{
				$respuesta=$query->result();
			}
			return $respuesta;
		}	
	}
	
	
	
	
	
	
	/* Función para actualizar el valor de una variable del proceso; es usada por el enlaceWinCC*/
	public function actualizarParcial()
	{
		$data = array('valor' => $this->valor);
		$this->db->update( 'variables', $data, array( 'codigo' => $this->codigo ));
		return $this->db->_error_number();
	}
	
	
	
	
	
	
	/* Devuelve datos parciales de las variables seleccionadas*/
	public function listaParcial($variables)
	{
		$query = $this->db->select("codigo,nombre,tag, valor, unidad")->where_in('codigo', $variables)->get( 'variables' );
		return  $query->result();
	}
	
	
	
	
	
	
	
	/* Devuelve datos parciales de las variables seleccionadas*/
	public function listaBase()
	{
		$query = $this->db->select("codigo,nombre,tag, valor, unidad")->get( 'variables' );
		return  $query->result();
	}
}