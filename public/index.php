<?php
/**
 * public/index.php: Pagina principal de la aplicación
 * 
 * Esta es el fichero principal de la aplicacion en el si se ha
 * iniciado la session se mostrara el entrono de trabajo, si no saldra el
 * formulario de acceso
 * 
 * PHP Version 5.1.4
 * 
 * @author Ruben Lacasa Mas <rubendx@gmail.com>
 * @version 3.0
 * 
 * FIXME! Arreglar todos los enlaces de la nueva estructura
 * FIXME! No salen los clientes de oficina móvil en el listado de clientes para facturación.
 * FIXME! Ana no puede ver el cuadro de E/S, agenda…varias cosas desde su ordenador. Es como si estuviera vacío.
 * FIXME! Habrá que añadir un cliente de dom. integral en el acumulado a 31/12/2007.
 * FIXME! Seprotec: sale duplicado (código actual 2058).
 * FIXME! Salen en cumpleaños los clientes que ya no están activos.
 * FIXME! Modificar contraseña de gestión y poder hacerlo nosotras (si es fácil y cuesta poco).
 * FIXME! Volcar a búsqueda avanzada lo que se ponga en casilla “nombre comercial” de Apdo. proveedores.
 * FIXME! Al sacar los listados filtrando por categorías, a la hora de imprimir, no sale el nombre del primer cliente.
 * FIXME! Al hacer clic en los clientes en la pantalla de avisos deberian abrirse los clientes
 * @todo: Que se pueda modificar la contraseña de acceso
 * @todo: Agregar un nuevo campo a la factura: Nº Pedido
 * @todo: Revision del estilo general
 * @todo: Migracion a jQuery
 * @todo: Eliminar etiquetas no compatibles
 * @todo: Limpieza de todo lo no necesario
 * @todo: Comprimir copias de seguridad (Si es posible)
 * @todo: Propiedades HTML entre ""
 * @todo: Generar Documentacion
 */

session_start(); 
$mensaje = '';
if ( isset( $_GET['exit'] ) )
    $mensaje = '<p><span class="ok">Sesion Cerrada</span></p>';
if ( isset( $_GET['error'] ) )
    $mensaje = '<p><span class="ko">Usuario/Contraseña Incorrecta</span></p>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="http://fonts.googleapis.com/css?family=Reenie+Beanie"
	rel="stylesheet" type="text/css" media="screen"></link>
<link href="estilo/perfectplace.css" rel="stylesheet" type="text/css"
	media="screen"></link>
<link href="estilo/custom-theme/jquery-ui-1.8.8.custom.css"
	rel="stylesheet" type="text/css" media="sceen"></link>
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
<script type="text/javascript" src="js/cni.js"></script>
<title>Aplicacion Gestión Independencia Centro Negocios 3.0</title>
</head>
<body>
<div id="cuerpo">
<div id="registro"><img src="imagenes/logotipo2.png" width="538px"
	alt="The Perfect Place" />
    <?php echo $mensaje; ?>
	<form action="../application/inc/validacion.php" name="loginUsuario"
	method="post">
<p><label for="usuario">Usuario:</label> <acronym
	title="Introduce tu usuario"> <input type="text" id="usuario"
	name="usuario" tabindex="10" /> </acronym></p>
<p><label for="passwd">Contraseña:</label> <acronym
	title="Introduce tu contraseña"> <input type="password" id="password"
	name="password" tabindex="20" /> </acronym></p>
<p><label>&nbsp;</label> <acronym title="Haz clic para acceder"> <input
	type="submit" class="boton" tabindex="30" value="[->]Entrar" /> </acronym>
</p>
</form>
<div id="devel"><a href="http://www.ensenalia.com" target="_blank"> <img
	src="imagenes/ensenalia.jpg" width="64" alt="ensenalia.com" /> </a> <a
	href="http://sbarrat.wordpress.org" target="_blank">
  	&copy;sbarrat::<?php echo date( 'Y' ); ?>
  	</a></div>
</div>
</div>
<div id="datos_interesantes"></div>
<div id="debug"></div>
<?php
if ( isset( $_SESSION['usuario'] ) ) :
	echo '<div id="avisos">';
	echo '</div>';
	echo '<div id="resultados"></div>';
	echo '<div id="formulario"></div>';
?>	
<script type="text/javascript">
	abrirAvisos();
	verMenu();
</script>
<?php 
endif;
?>
</body>
</html>