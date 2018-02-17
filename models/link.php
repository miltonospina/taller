<?php
/*
Proyecto: cpex
Autor:
Descripcion:
*/
if ( ! defined("BASEPATH")) exit("No se permite el acceso a este documento");

	class Link extends CI_Model
	{
		var $href='#';
		var $texto;
		var $titulo='';
		var $padre;
		var $clases;
		var $icono;
		var $id='';
		
		
		
		
		
		
		function Link($id='',$href='',$titulo='',$clases='',$texto='',$icono="")
		{
			parent::__construct();
			$this->id=$id;
			$this->href=$href;
			$this->titulo=$titulo;
			$this->clases=$clases;
			$this->texto=$texto;
			$this->icono=$icono;
		}
		
		
		
		
		
		
		function generar($prefijo)
		{
			$shtml='<a ';
			if ($this->id!='')
			{
				$shtml.='id="'.$prefijo.$this->id .'" ';
			}
			$shtml.='href="'.$this->href .'" ';
			
			if ($this->titulo!='')
			{
				$shtml.='title="'.$this->titulo .'" ';
			}
			if ($this->clases!='')
			{
				$shtml.='class="'.$this->clases .' '.$this->icono.' " ';
			}
			$shtml.='>'.$this->texto .'</a>';
			
			return $shtml;
		}
	}