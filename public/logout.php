<?php
/**
 * public/logout.php: Fichero que cierra la sesion
 * 
 * Este fichero cierra la sesión del usuario y redirige a la principal
 * 
 * PHP Version 5.1.4
 * 
 * @author Ruben Lacasa Mas <rubendx@gmail.com>
 * @version 3.0
 *  
 */
session_start();
session_destroy();
header( 'Location:index.php?exit=0' );

