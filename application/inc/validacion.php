<?php 
/**
 * PHP Version 5.1.4
 * Valida al usuario en la aplicacion
 * 
 * @author Ruben Lacasa Mas <ruben@ensenalia.com>
 * @version 3.0
 * 
 */
session_start ();
if ( isset( $_POST ["usuario"] ) && isset( $_POST ["password"] ) ) {
	require_once '../config.inc.php';
	
	$consulta = new Sql();
	$sql = sprintf( 
	"SELECT 1 from usuarios WHERE nick like '%s' and contra like sha1('%s')", 
	$consulta->escape( $_POST ["usuario"] ), 
	$consulta->escape( $_POST ["password"] ) );
	$consulta->consulta( $sql );
	if ( $consulta->totalDatos() == 1 ) {
		$_SESSION ["usuario"] = $_POST ["usuario"];
		header ( "Location:../../public/index.php" );
	} else
		header ( "Location:../../public/index.php?error=1" );
} else
	header ( "Location:../../public/index.php?error=1" );





