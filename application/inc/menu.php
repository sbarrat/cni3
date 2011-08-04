<?php
/**
 * Funcion que devuelve el Menu de la aplicacion
 * @return string
 */
require_once '../config.inc.php';
if (isset ( $_SESSION ["usuario"] )) {
	echo menu ();
}

function menu()
{
	$sql = new Sql ();
	$sql->consulta ( "SELECT * FROM `menus`" );
	$menu = '<div id="menu">';
	foreach ( $sql->datos () as $resultado ) {
		switch ($resultado['id'])
		{
		    
		    case '7':break; //opciones deshabilitadas del menu
		    case '8':break; //opciones deshabilitadas del menu
		    
		    case '9': $menu .='<div class="datos">
		    		   <acronym title="' . $resultado['nombre'] .'">
				       <img src="' . $resultado['imagen'] . '" 
				       alt="' . $resultado['nombre'] . '" />
				       <br />' . $resultado['nombre'] . ' - 
				       ' . $resultado['id'] . '
				       </acronym>
				       </div>';
		    break;
		    default:  $menu .= '<div class="menu">
		    			<acronym title="' . $resultado['nombre'] .'">
		    	       <img src="' . $resultado['imagen'] . '" 
				       alt="' . $resultado['nombre'] . '"/>
				       <br />' . $resultado['nombre'] . ' - 
				       ' . $resultado['id'] . '
				       </acronym>
				       </div>';
		    break;
		}
	}
	$menu .='
	 <div>
	  <a href="logout.php">
	   <acronym title="Salir">
	   <img src="imagenes/salir.png" width="32" alt="Salir">
	   </acronym>
	   <br/>Salir
	  </a>
	 </div>';
	$menu .= '</div><div id="principal"></div>';
	return $menu;
}