<?
/**
 * PHP Version 5.1.4
 * 
 * @author: Ruben Lacasa Mas ruben@ensenalia.com
 * @version: 2.0e
 * @package: cni
 * @description: Fichero que devuelve los resultados de busqueda
 */
require_once '../inc/config.inc.php';

if(isset($_POST["opcion"]))
{
	switch($_POST["opcion"])
	{
		case 0:$resultado = buscaValores($_POST);break;
		case 1:$resultado = busqueda_avanzada();break;
	}
	echo $resultado;
}
/**
 * Muestra el formulario de busqueda avanzada
 * @return string
 */
function busqueda_avanzada()
{
	$cadena ='<form id="busqueda_avanzada" 
	 onsubmit="busqueda_avanzada(); return false" >
	 <input type="button" class="boton" onclick="cierralo()" 
	 onkeypress="cierralo() value="[X]" /><br/>
	 <label for="texto">Busqueda Avanzada</label>
	 <input type="text" name="texto" size="40"/>
	 <input type="submit" name="Buscar" value="Buscar" />
	 <div id="resultados_busqueda_avanzada"></div>
	 </form>';
	 return $cadena;
}

/**
 * Le pasamos un array con datos y nos devuelve el resultado de la busqueda
 * @param array $vars
 */
function buscaValores($vars) {
	
	$cadena = "";
	$resultado = FALSE;
	$busqueda = new Busqueda();
	/*
	 * Chequeamos si es un telefono
	 */
	$token = ereg_replace(" ","",$vars["texto"]);
	if(is_numeric($token) && (strlen($token)==9))
	    $vars["texto"]=$token;
	$vars["texto"] = codifica($vars["texto"]);
	
	/*
	 * Hacemos busqueda de Nombre de clientes
	 */
    $clasesClientes = array("BusquedaClientes","TelefonosEmpresas",
	"TelefonosEmpleadosEmpresas","TelefonosPersonalCentral");
    $cadena.="
    <div><strong><u>Resultados busqueda en Clientes</u></strong></div>";
    
    foreach($clasesClientes as $clases){
        $busqueda->{$clases}($vars["texto"]);
        if($busqueda->totalDatos()>=1){
            $resultado = TRUE;
            $lineas[]=$busqueda->datos();
        }
    }
	if($resultado == TRUE){
        foreach($lineas as $datos){
            foreach($datos as $dato){
	        $clase = clase();
	        $empresa = traduce($dato['Empresa']);
	        $contacto = traduce($dato['Contacto']);
	        $cadena .= "<div class='{$clase}'>
	    	<a href='javascript:muestra({$dato['ID']})'>
	        {$empresa} - {$contacto}
	    	</a></div>";
	        }
        }
	}
	else {
	    $clase = clase();
	    $cadena .= "<div class='{$clase}'>
	    No hay resultados de <strong>{$vars["texto"]}</strong> 
	    en Clientes</div>";
	}
	
	/*
	 * Busqueda en Proveedores
	 */
	$resultado = FALSE;    
	$cadena.="
	<div><strong><u>Resultados busqueda en Proveedores</u></strong></div>";
	
	$busqueda->Proveedores($vars["texto"]);
	if($busqueda->totalDatos()>=1){
	    $resultado = TRUE;
	    
	    foreach($busqueda->datos() as $datos){
	        $clase = clase();
	        $empresa = traduce($datos['Empresa']);
	        $nombre = traduce($datos['Contacto']);
	        $cadena.="<div class='{$clase}'>
	        <a href='javascript:muestra({$datos['ID']})'>
	        {$empresa} - {$nombre}
	        </a></div>";
	    }
	}
	if(!$resultado){
	    $clase = clase();
	    $cadena .= "<div class='{$clase}'>
	    No hay resultados de <strong>{$vars["texto"]}</strong> 
	    en Proveedores</div>";
	}
	    
    /*
     * Busqueda en Telecos
     */
	$resultado = FALSE;
	$cadena.="
	<div><strong><u>Resultados busqueda en Comunicaciones</u></strong></div>";
	
	$busqueda->Telecomunicaciones($vars["texto"]);
    if($busqueda->totalDatos()!=0){
	    $resultado = TRUE;
	    foreach($busqueda->datos() as $datos){
	        $clase = clase();    
	        $empresa = traduce($datos['Empresa']);
	        $valor = traduce($datos['valor']);
	        $servicio = traduce($datos['servicio']);
	        $cadena .= "<div class='{$clase}'>
	        <a href='javascript:muestra({$datos['ID']})'>
	        {$empresa} - {$valor} - {$servicio}
	        </a></div>";
	    }
	}
	if(!$resultado){
	    $clase = clase();
	    $cadena .= "<div class='{$clase}'>
	    No hay resultados de <strong>{$vars["texto"]}</strong> 
	    en Telecomunicaciones</div>";
	}
	
	$busqueda->close();
	echo $cadena;    
}

