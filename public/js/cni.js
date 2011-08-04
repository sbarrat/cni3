/**
 * Nuevas funciones basadas en jQuery
 */


$('document').ready(function(){
	
	//Abrimos la opcion del menu seleccionada
	$('.menu').click(function(){
		$.post("../application/inc/generator.php",{opcion:"0",codigo:"1"},function(data){
			$("#principal").html(data);
		});
	});
	
	$('.datos').click(function(){
		alert("Adios");
	});

});
/**
 * verMenu() Mostramos el menu de la aplicacion
 */
function verMenu(){
	$("#cuerpo").load("../application/inc/menu.php");
}
/**
 * cerrarAvisos() Cierra el panel de avisos
 */
function cerrarAvisos(){
	$('#avisos').html("<input class='boton' type='button' onclick='abrirAvisos()' value='[>]Ver Avisos' />");
}

/**
 * abrirAvisos() muestra el panel de avisos
 */
function abrirAvisos(){
	$("#avisos").load("../application/inc/avisos.php");
}
