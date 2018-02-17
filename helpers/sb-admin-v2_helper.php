<?php
//
	function notificacion($clase,$mensaje)
	{
		$html="<div class=\"alert alert-{$clase} alert-dismissable\">";
		$html.="<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
		$html.=$mensaje;
		$html.="</div>";

		return $html;
	}



	function arrayToUL(array $menu,$padreactivo=null)
	{
		$html='';
		foreach($menu as $menu_item)
		{
			if(isset($menu_item->texto))
			{
			
			//echo($padreactivo."~~~~~~~: ".$menu_item->padre."</br>");
			
				if($padreactivo==$menu_item->padre)
				{
					$html.="<li class='{$menu_item->clases} active'><a href='{$menu_item->href}'><i class='fa fa-{$menu_item->icono} fa-fw'></i>{$menu_item->texto}";
				}
				else
				{
					$html.="<li class='{$menu_item->clases}'><a href='{$menu_item->href}'><i class='fa fa-{$menu_item->icono} fa-fw'></i>{$menu_item->texto}";
				}
			}

			if(!empty($menu_item->hijos))
			{
				$html.='<span class="fa arrow "></span></a>'."\n"."\n";
				
			}
			else
			{
				$html.="</a>"."\n";
			}

			if(!empty($menu_item->hijos) && is_array($menu_item->hijos))
			{
				$html.="<ul class='nav nav-second-level'>"."\n";
				$html.=arrayToUL($menu_item->hijos,$padreactivo);
				$html.="</ul>"."\n";
			}
			$html.="</li>"."\n";
		}
		return $html;
	}





	function modal($titulo="",$contenido="")
	{
		$html="<div class=\"modal fade \" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
	<div class=\"modal-dialog\">
		<div class=\"modal-content modal-primary\">
			<div class=\"modal-header modal-heading\">
				<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
				<h4 class=\"modal-title\" id=\"myModalLabel\">{$titulo}</h4>
			</div>
			<div class=\"modal-body\">
				<div class=\"row\">
					{$contenido}
			</div>
		<!-- /.row (nested) -->
			</div>
			<div class=\"modal-footer\">
				<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cerrar</button>
				<button type=\"button\" class=\"btn btn-success\">Crear</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->";

		return $html;
	}
?>
