<?php
/**
 * public/index.php: Pagina principal de la aplicación
 * 
 * Esta es el fichero principal de la aplicacion en el si se ha
 * iniciado la session se mostrara el entrono de trabajo, si no saldra el
 * formulario de acceso
 * 
 * PHP Version 5.3+
 * 
 * @author Ruben Lacasa Mas <rubendx@gmail.com>
 * @version 3.0
 * 
 * @todo: Que se pueda modificar la contraseña de acceso
 * @todo: Agregar un nuevo campo a la factura: Nº Pedido
 * @todo: Revision del estilo general
 * @todo: Migracion a jQuery
 * @todo: Migración a HTML5 y CSS3
 * @todo: Utilizar estandares de codigo
 * @todo: Eliminar etiquetas no compatibles
 * @todo: Limpieza de todo lo no necesario
 * @todo: Comprimir copias de seguridad (Si es posible)
 * @todo: Propiedades HTML entre ""
 * @todo: Generar Documentacion
 */

session_start(); 
$mensaje = '';
if ( isset( $_GET[ 'exit' ] ) )
    $mensaje = '<p><span class="ok">Sesion Cerrada</span></p>';
if ( isset( $_GET[ 'error' ] ) )
    $mensaje = '<p><span class="ko">Usuario/Contraseña Incorrecta</span></p>';
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Reenie+Beanie">
		<link rel="stylesheet" href="estilo/perfectplace.css">
		<link rel="stylesheet" href="estilo/custom-theme/jquery-ui-1.8.8.custom.css">
		<script src="js/jquery-1.4.4.min.js" type="text/javascript" charset="utf-8" async defer></script>
		<script src="js/jquery-ui-1.8.8.custom.min.js" type="text/javascript" charset="utf-8" async defer></script>
		<script src="js/cni.js" type="text/javascript" charset="utf-8" async defer></script>
		<title>Aplicación Gestión Independencia Centro Negocios 3.0</title>
	</head>
	<body>
		<section id="container">
			<header>
				<img src="imagenes/logotipo2.png" alt="The Perfect Place">
			</header>
			<section>
				<div class='mensaje'><?php echo $mensaje; ?></div>
				<form action="../application/inc/validacion.php" name="loginUsuario" method="post" accept-charset="utf-8">
				
					<p><input type="submit" value="submit"></p>
				</form>
			</section>
			
		</section>
		<footer>
			<a href="http://sbarrat.wordpress.com" target="_blank">
			devel by &copy;sbarrat::<?php echo date( 'Y' ); ?>
			</a>
		</footer>
	</body>

</html>












<div id="cuerpo">
<div id="registro">
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