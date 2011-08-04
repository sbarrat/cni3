<?
/*
 * TODO: borrar codigo sobrante si sobra
 */
require_once '../config.inc.php';
if (isset ( $_SESSION ["usuario"] )) {
	echo avisos ();
}

/**
 * Muestra los avisos de cumpleaños y contratos
 * @return string
 */
function avisos()
{
	$texto ='
	<input type="button" class="boton" 
	value="[<]Ocultar Avisos" onclick="cerrarAvisos()"/>
	<table class="tabla">
	 <tr><th colspan="2">Panel de Avisos</th></tr>
	 <tr><th>Cumpleaños</th><th>Finalizan Contratos</th></tr>
	 <tr>';
	 
	$fecha = new Fecha ();
	$cumples = new Cumples (); 
	$texto .='<td valign="top">
		<table width="100%">';
	/*
	 * Cumpleaños de todos
	 */
	$registros = $cumples->DatosCumples();
	foreach($registros as $registro){
	    if($fecha->today() == $registro['stamp'])
	        $clase = "cumplehoy";
	    elseif ($fecha->tomorrow() == $registro['stamp'])
	        $clase = "cumpletomorrow";
	        else     
	        $clase = clase();
	    
	    $texto .="<tr class='{$clase}'>
	    <td>{$registro['nombre']}";
	    if($registro['id']!=0){
	        $texto.= " de <a href='javascript:muestra({$registro['id']})'>
	        {$registro['empresa']}</a>";
	    }
	    $texto .="</td>";
	    $texto .="<td>{$registro['cumple']}</td>
	    </tr>";
	}
	$texto.='</table></td>';
	
	$contratos = new Contratos();
	$registros = $contratos->DatosContratos();
	
	$texto.= '<td valign="top">
		<table width="100%">';
	$k=0;
	foreach($registros as $registro){
	    if($fecha->today() == $registro['stamp'])
            $clase = "cumplehoy";
        elseif ($fecha->tomorrow() == $registro['stamp'])
            $clase = "cumpletomorrow";
        else
            $clase = clase();    
	    $texto .="<tr class='{$clase}'>
		<td>
	 	<a href='javascript:muestra({$registro['id']})'>
	     {$registro['nombre']}
	 	</a>
		</td>
		<td>
	    {$registro['fecha']}
		</td></tr>";
	}
	$texto .= '</table></td>
	</tr></table>';
	return $texto;
}

/*
 * Funciones que no se si se usan ¿Borrar?
 */


//function telefonos()
//{
//	include('variables.php');
//	$cadena.="<input type='button' 
//	value='[v]Ocultar telefonos' onclick='cerrar_tablon_telefonos()'/>";
//	$cadena .= listado('Telefono');
//	$cadena .= listado('Fax');
//	$cadena .= listado('Adsl');
//	return $cadena;
//}
//function listado($servicio)
//{
//	include('variables.php');
//	$cadena .="<p/><u><b>".$servicio." del centro</b></u><p/>";
//	$sql = "SELECT c.Id,c.Nombre, z.valor, z.servicio, 
//	(
//	SELECT valor
//	FROM z_sercont
//	WHERE servicio LIKE 'Codigo Negocio'
//	AND idemp LIKE z.idemp
//	LIMIT 1
//	) AS Despacho, c.Categoria
//	FROM clientes AS c
//	INNER JOIN z_sercont AS z ON c.Id = z.idemp
//	WHERE z.servicio LIKE '$servicio'
//	ORDER BY Despacho";
//	$consulta = mysql_db_query($dbname,$sql,$con);
//	$cadena .="<table><tr>";
//	$i=0;
//	if (mysql_numrows($consulta)!=0)
//		while(($resultado = mysql_fetch_array($consulta))==TRUE)
//		{
//			if(ereg("despacho",$resultado[5]))
//				$color="#69C";
//			else
//			if (ereg("domicili",$resultado[5]))
//				$color="#F90";
//			else
//				$color="#ccc";
//			if($i%4==0)
//			$cadena .="</tr><tr>";
//			$cadena .= "<th bgcolor='".$color."' align='left'>
//			<a href='javascript:muestra($resultado[0])'>".$resultado[4]."-".traduce($resultado[1])."-
//			<u><b>".$resultado[2]."</b></u></a></th>";
//			$i++;
//		}
//	$cadena .="</tr></table>";
//	
//	return $cadena;
//}


