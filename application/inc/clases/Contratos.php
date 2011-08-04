<?php
require_once 'Sql.php';
class Contratos extends Sql
{
    public function __construct ()
    {
        parent::__construct();
    }
    
    function DatosContratos(){
        $sql = "SELECT  
	     `facturacion`.`idemp`, 
	     `clientes`.`Nombre`,
	     `facturacion`.`renovacion`
	     FROM `facturacion` 
         INNER JOIN `clientes` 
         ON `facturacion`.`idemp` = `clientes`.`Id`
         WHERE (CURDATE() <= `facturacion`.`renovacion`) 
         AND (DATE_ADD(CURDATE(),INTERVAL 60 DAY)) >= `facturacion`.`renovacion` 
         AND `clientes`.`Estado_de_cliente` != 0 
         ORDER BY MONTH(`facturacion`.`renovacion`) ASC, 
         DAY(`facturacion`.`renovacion`) ASC";
        
        parent::consulta($sql);
        $registros = array();
        foreach(parent::datos() as $datos){
            $partfecha = explode('-',$datos['renovacion']);
            $registros[] = array(
            'stamp' =>  mktime(0, 0, 0, $partfecha[1]  , $partfecha[2], $partfecha[0]),
            'id' => $datos['idemp'],
            'nombre' => utf8_encode($datos['Nombre']),
            'fecha' => "{$partfecha[2]}-{$partfecha[1]}"
            );
        }
        return $registros;
    }
}
?>