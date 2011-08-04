<?php
/**
 * 
 * application/config.inc.php: Valores de configuración
 * 
 * Se establecen valores por defecto de la aplicación
 * 
 * PHP Version 5.1.4
 * 
 * @author Ruben Lacasa Mas <rubendx@gmail.com>
 * @version 3.0
 */
date_default_timezone_set( 'Europe/Madrid' );

$SID = session_id();
if ( empty( $SID ) ) session_start();

set_include_path( get_include_path() . PATH_SEPARATOR . __DIR__ );
set_include_path( get_include_path() . PATH_SEPARATOR . __DIR__ . '/inc' );

/**
 * Autocarga de las clases
 * @param string $classname Nombre de la clase
 */
function __autoload( $classname ) {
    include_once 'clases/' . $classname . '.php';
}
