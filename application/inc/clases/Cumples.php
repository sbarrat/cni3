<?php
require_once 'Sql.php';
require_once 'funcionesAuxiliares.php';
class Cumples extends Sql
{
    private $_tablas = array('pcentral','pempresa','empleados');
    private $_dias = array('today','tomorrow','month');
    private $_month = array();
    
    function __construct ()
    {
        parent::__construct();
    }
    
    function DatosCumples()
    {
        
        foreach($this->_tablas as $tabla){
        
            switch($tabla){
                case "pcentral":$nombre = "`{$tabla}`.`persona_central` AS `nombre`";
                            $cumple = "`{$tabla}`.`cumple`";
                            $id = "`{$tabla}`.`idemp`";
                break;
                case "pempresa": $nombre = "CONCAT(`{$tabla}`.`nombre`,' ', 
            							 `{$tabla}`.`apellidos`) AS `nombre`";
                             $cumple = "`{$tabla}`.`cumple`";
                             $id = "`{$tabla}`.`idemp`";
                break;
                case "empleados": $nombre = "CONCAT(`{$tabla}`.`Nombre`, ' ', 
            							   `{$tabla}`.`Apell1`, ' ',
            							   `{$tabla}`.`Apell2`) AS `nombre`";
                              $cumple = "`{$tabla}`.`FechNac`";
                              $id = FALSE;
                break;
                default:return FALSE;
                break;                 
            }
        
        $orden = " ";
        if(date("m")==12)
            $orden = " DESC ";
            
        $sql = "SELECT ";
        if($id)
		    $sql .= "`clientes`.`id`,`clientes`.`Nombre`,"; 
		else
		    $sql .= "0 AS id, 'Centro' as Nombre, ";    
		$sql .= "{$nombre}, 
		DATE_FORMAT( {$cumple}, '%d-%m' ) AS cumple
		FROM ";
		if($id)
			$sql .= "`clientes` INNER JOIN {$tabla} 
					ON `clientes`.`Id` = {$id} ";
		else
		    $sql .= "{$tabla} ";	
		$sql .= "WHERE (
 	     DAY({$cumple}) >= DAY(CURDATE()) 
 	     AND
 	     MONTH({$cumple}) LIKE MONTH(CURDATE())
 	     OR
 		 MONTH({$cumple}) 
 	     LIKE MONTH(DATE_ADD(CURDATE(), INTERVAL 1 MONTH))
		 ) ";
		if($id)
		$sql .= "AND `clientes`.`Estado_de_cliente` != 0 ";
 		
		$sql.=" ORDER BY MONTH({$cumple}) {$orden}, DAY({$cumple}) ";
        
        parent::consulta($sql);
        $this->_month[] = parent::datos();
        
        }
        $this->close();
        
        $i=0;
	    $mes = 0;
	    $anyo = 0;
	    foreach($this->_month as $dia){
	        if(count($dia)>=1){
	            foreach($dia as $datos){
	                 if(count($datos)!=0){
	                     $partfecha = explode("-",$datos['cumple']);
	                 if($mes!= $partfecha[1]){
	                     if($partfecha[1]< $mes){
	                         $anyo = 1;
	                     }
	                     $mes == $partfecha[1];
	                 }
	         $dia = 
	         mktime(0, 0, 0, $partfecha[1]  , $partfecha[0], date("Y")+$anyo);    
	             
	         $registros[] = array(
	         'stamp'=>$dia,
	         'id'=>$datos['id'],
	         'empresa'=> utf8_encode($datos['Nombre']),
	         'nombre' => utf8_encode($datos['nombre']),
	         'cumple' => $datos['cumple']);
	         }
	       }
	    }
	}
	array_multisort($registros);
    return $registros;   
        
    }
    function close(){
        parent::close();
    }
    
    
   
}
?>