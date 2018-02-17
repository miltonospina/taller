<?
//
public function notificacion($clase,$contenido)
{
	$html="<div class=\"alert alert-{$clase} alert-dismissable\">";
	$html.="<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
	$html.=$contenido;
	$html.="</div>";
}
?>