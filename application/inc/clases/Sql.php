<?php
/**
 * application/inc/clases/Sql.php Gestión acceso base de datos
 * 
 * Clase que centraliza las operaciones con la base de datos
 * 
 * PHP Version 5.1.4
 * 
 * @author Ruben Lacasa Mas <rubendx@gmail.com>
 * @version 3.0
 * @package clases
 */

class Sql {
	/**
	 * Parametros de la conexion
	 * @var resource
	 */
	private $_conexion = null;
	
	/**
	 * Resultado de la operacion
	 * @var resource
	 */
	private $_result = null;
	
	function __construct() {
		
		$iniArray = parse_ini_file( "configuracion.ini", true );
		$this->_conexion = mysql_connect( $iniArray['db']['host'], 
		$iniArray['db']['username'], $iniArray['db']['password'] );
		if ( !$this->_conexion )
			die( 'Database connection failed: ' . mysql_error() );
		if ( !mysql_select_db( $iniArray['db']['dbname'], $this->_conexion ) )
			die( 'Database selection failed: ' . mysql_error() );
	}
	
	/**
	 * Ejecuta la consulta que le pasamos como parametro
	 * @param string $sql
	 */
	function consulta( $sql ) {
		
		$this->_result = mysql_query( $sql, $this->_conexion );
	}
    
    /**
     * Devuelve el array con los datos de la consulta
     * @return array 
     */
    function datos() {
    	
		$rows = array();
		
		if ( count( $this->totalDatos() > 0 ) ) {
			while ( ($row = mysql_fetch_array( $this->_result, MYSQL_ASSOC ) ) == TRUE ) {
				$rows[] = $row;
			}
		}
		mysql_free_result( $this->_result );
		
		return $rows;
	}
    
    /**
     * Devuelve el total de datos devueltos en la consulta
     * @return number
     */
    function totalDatos() {
    	
		return mysql_affected_rows();
	}
	
	/**
	 * Cierra la conexion
	 */
	function close() {
		mysql_close( $this->_conexion );
	}
	
	/**
	 * Prepara el parametro para la consulta y lo devuelve
	 * @param string $string
	 * @return string
	 */
	function escape( $string ) {
		return mysql_real_escape_string( $string, $this->_conexion );
	}
	
	/**
	 * Devuelve el estado de la conexion
	 * @return string
	 */
	function estado() {
		return mysql_stat( $this->_conexion );
	}
}