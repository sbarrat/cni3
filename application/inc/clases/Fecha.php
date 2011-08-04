<?php
class Fecha
{
    
    public $mesesLargos = array( "", "Enero", "Febrero", "Marzo", "Abril", "Mayo", 
        "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", 
        "Diciembre" );
    public $mesesCortos = array( "", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", 
        "Ago", "Sep", "Oct", "Nov", "Dic" );
        
	
	/**
	 * Devuelve el array con el valor de los meses en formato largo
	 * @return array
	 */
	public static function getMeses ()
    {
        return $this->mesesLargos;
    }
    /*
	 * Funcion que devuelve un array con el nombre de los meses cortos
	 */
    public static function getMesesCortos ()
    {
        return $this->mesesCortos;
    }
    /*
	 * Funcion Auxiliar que cambia la fecha del formato MySQl al 
	 * castellano y viceversa
	 */
    public static function cambiaf( $fecha )
    {
        $dia = explode( '-', $fecha );
        return $dia[2] . '-' . $dia[1] . '-' . $dia[0];
    }
    /*
	 * Funcion Auxiliar que devuelve el dia pasado por parametro
	 */
    public static function verDia( $fecha )
    {
        return date('j', strtotime( $fecha ) );
    }
    
    /*
	 * Funcion Auxiliar que devuelve el mes pasado por parametro
	 */
    public static function verMes( $fecha )
    {
        return date("n", strtotime($fecha));
    }
    /*
	 * Funcion Auxiliar que devuelve el año pasado como parametro
	 */
    public static function verAnyo ($fecha)
    {
        return date('Y', strtotime($fecha));
    }
    public static function today()
    {
        return mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
    }
    public static function tomorrow()
    {
        return mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")); 
    }
   
}