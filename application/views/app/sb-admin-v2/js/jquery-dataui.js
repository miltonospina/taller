;(function($)
{

	//funcion para llenar una tabla con datos vía ajax
	$.fn.tablaAjax = function(options)
	{
		var cuerpotabla = $(this).children("tbody");
		// guarda la configuracion en una variable global, para habilitar la funcion de regarga rapida.
		if(!options)
		{
			options= window.configtabla[$(this).attr('id')];
		}
		else
		{
			window.configtabla=Array();
			window.configtabla[$(this).attr('id')]=options;
		}
		cuerpotabla.html("");

		options = $.extend(true, {
			urldatos: "",
			fuente:"",
			tipodatos:"",
			animacion: "",
			columnas:""
		}, options);

		var listaTextos ={};
		var listaVariables=[];

		for( var j in options.columnas )
		{
			reg = new RegExp("\{[^{}]*\}","gi");

			var result;

			var columna =[];

			var k=0;
			listaTextos[j]=options.columnas[j].toString();

			while ((result = reg.exec(options.columnas[j])) !== null)
			{

				listaTextos[j]=listaTextos[j].replace(result,"$");
				result=result.toString().replace("{","");
				result=result.toString().replace("}","");
				columna[k]=result;
				k++;
			}
			listaVariables.push(columna);
		}

		return this.each(function()
		{
		//Desplegar animación
		$(options.animacion).fadeIn( 'fast' );

		$.ajax({
			statusCode:
				{
					404: function()
					{
						alert('Error 404: Origen '+options.tipodatos+' no encontrada: '+options.urldatos);
						$(options.animacion).fadeOut( 'slow' );
					},
					505: function()
					{
						alert('Error 505: aplicación no disponible');
						$(options.animacion).fadeOut( 'slow' );
					}
				},
			url: options.urldatos,
			dataType: options.fuente,
			success: function( response )
				{
					//Genera el HTML del contenido de la tabla
					textRs="";
					console.log(response);
					for( var i in response )
					{//por cada uno de los resultados obtenidos
						textRs+="<tr>";
						console.log(i.length);
						for( var j in options.columnas )
						{	//po cada una de las columnas
							var salida=listaTextos[j];

							for (var k=0; k<listaVariables[j].length;k++)
							{
							//Por cada variable en la columna
								var arr = listaVariables[j][k].split(".");
								objeto=response[i];
								while(arr.length && (objeto = objeto[arr.shift()]));

								if(!isNaN(objeto) && listaVariables[j][k].indexOf("codigo")==-1 && objeto!=0)
								{

									$.format.locale({
										number: {
											groupingSeparator: '\'',
											decimalSeparator: '.'
										}
									});
									salida=salida.replace("$", $.format.number(objeto, "#.###"));
									//console.log(">>>>");
									//console.log(">>>>"+ numberWithCommas(objeto));
								}
								else
								{
								salida=salida.replace("$",objeto);
								}
							}
							textRs+=salida;
						}
						textRs+="</tr>";
					}

					//Agrega el HTML al tbody
					window.prueba1=$(this);
					cuerpotabla.append(textRs);
					cuerpotabla.trigger("update");

					//Oculta la animación
					$(options.animacion).fadeOut( 'slow' );
				}
			});
		});
	}





	//funcion para llenar una select con datos vía ajax
	$.fn.selectAjax = function(options)
	{
		var cuerposelect = $(this).children("select");

		// guarda la configuracion en una variable global, para habilitar la funcion de regarga rapida.
		if(!options)
		{
			options= window.configselect;
			cuerposelect.html("");
		}
		else
		{
			window.configselect=options;
		}

		options = $.extend(true, {
			urldatos: "",
			tipodatos:"",
			animacion: "",
			columnas:"",
			seleccionado:"",
			identificador: ""
		}, options);




		var listaTextos ={};
		var listaVariables=[];

		for( var j in options.columnas )
		{
			reg = new RegExp("\{[^{}]*\}","gi");

			var result;

			var columna =[];

			var k=0;
			listaTextos[j]=options.columnas[j].toString();

			while ((result = reg.exec(options.columnas[j])) !== null)
			{
				listaTextos[j]=listaTextos[j].replace(result,"$");

				result=result.toString().replace("{","");
				result=result.toString().replace("}","");
				columna[k]=result;
				k++;
			}
			listaVariables.push(columna);
		}

		return this.each(function()
		{
		//Desplegar animación
		$(options.animacion).fadeIn( 'fast' );

		$.ajax({
			statusCode:
				{
					404: function()
					{
						alert('Error 404: Origen '+options.tipodatos+' no encontrada: '+options.urldatos);
						$(options.animacion).fadeOut( 'slow' );
					},
					505: function()
					{
						alert('Error 505: aplicación no disponible');
						$(options.animacion).fadeOut( 'slow' );
					}
				},
			url: options.urldatos,
			dataType: options.tipodatos,
			success: function( response )
				{
					//Genera el HTML del contenido de la tabla
					textRs="";

					//por cada uno de los resultados obtenidos
					for( var i in response )
					{
						//por cada una de las columnas
						for( var j in options.columnas )
						{
							var salida=listaTextos[j];

							//selecciona la conincidencia de codigo
							console.log(">>");

							if(response[i][options.identificador]!=options.seleccionado)
							{
								salida=salida.replace("selected","");
							}

							//Por cada variable en la columna
							for (var k=0; k<listaVariables[j].length;k++)
							{
								adicional="";
								var arr = listaVariables[j][k].split(".");
								objeto=response[i];
								while(arr.length && (objeto = objeto[arr.shift()]));

								salida=salida.replace("$",objeto);
							}
							textRs+=salida;
						}
					}

					//Agrega el HTML al tbody
					window.configselect=$(this);
					cuerposelect.append(textRs);
					cuerposelect.trigger("update");

					//Oculta la animación
					$(options.animacion).fadeOut( 'slow' );
				}
			});
		});
	}






	//funcion para enviar formulario a traves de ajax
	$.fn.enviarModalAjax = function(options)
	{

		options = $.extend(true, {
			animacion: "",
			divNotificaciones:"",
			funcionActualizar:"",
			cerrar: true
		}, options);

		window.configModal=options;
		modal = $(this);

		if(options.cerrar==true)
		{
			$(modal).modal('hide');
		}
		formularioModal= modal.find('form');
		$(options.animacion).fadeIn( 'fast' );


		$.ajax(
		{
			url: formularioModal.attr('action'),
			type: 'POST',
			dataType: 'json',
			data: formularioModal.serialize(),
			success: function( response )
			{
				rshtml="";
				response.forEach(function(notificacion)
				{
					rshtml+='<div class="alert alert-'+notificacion.clase+' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><p>'+notificacion.mensaje+'</p></div>';
					if(notificacion.clase!="danger")
					{
						rshtml+='<script>window.setTimeout(function() { $(".alert").alert("close"); }, 2000);</script>';
					}
				});

				$(options.divNotificaciones).append(rshtml);
				eval(options.funcionActualizar);
				$( options.animacion ).fadeOut( 'fast' );
				formularioModal.reset();

			}, //end success
			statusCode:
			{
				404: function()
				{
					alert('Error 404: página no encontrada: '+ formularioModal.attr('action'));
					$( animacion).fadeOut( 'slow' );
				},
				505: function()
				{
					alert('Error 505');
					$(options.animacion).fadeOut( 'slow' );
				}
			}
		});
	}




	//Funcion para resetear un formulario.
	$.fn.reset = function () {
		$(this).each (function() {
			this.reset();
		});
	}





	$.fn.redirigir = function (options) {

		window.setTimeout(function(){window.location.href = options.url;}, 500);
	}

})(jQuery);
