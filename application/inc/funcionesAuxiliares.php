<?php
/**
 * PHP Version 5.1.4
 * 
 * @author: Ruben Lacasa Mas ruben@ensenalia.com
 * @version: 2.0e
 * @package: cni
 * @description: Funciones auxiliares utilizadas en la aplicacion
 */

/**
 * Codifica a utf8 el texto
 * @param string $texto
 * @return string
 */
function traduce($texto)
{
    return utf8_encode($texto);
}

/**
 * Decodifica el texto
 * @param string $texto
 * @return string
 */
function codifica($texto)
{
    return utf8_decode($texto);
}

/**
 * Devuelve la clase de celda
 * @return string
 */
function clase()
{
	static $k = 0;
    if($k%2==0)
		$clase = "par";
	else
		$clase = "impar";
	$k++;	
    return $clase;
}

/**
 * Funcion que cambia el formato de español a mysql e inversa
 * @param string $stamp
 * @return string
 */
function cambiaf($stamp) 
{
	$fdia = explode("-",$stamp);
	$fecha = $fdia[2]."-".$fdia[1]."-".$fdia[0];
	return $fecha;
}


/**
 * Devuelve el dia y el mes pasandole la fecha
 * @param string $stamp
 * @return string
 */
function diaMes($stamp)
{
	$fdia = explode("-",$stamp);
	$fecha = $fdia[2]."-".$fdia[1];
	return $fecha;
}

/**
 * Devuelve el año y el dia
 * @param string $fecha
 * @return string
 */
function invierte($fecha)
{
    $reves = explode("-",$fecha);
    return $reves[1]."-".$reves[0];
}	