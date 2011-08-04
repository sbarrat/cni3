<?php
require_once 'Sql.php';
class Busqueda extends Sql
{
    public function __construct ()
    {
        parent::__construct();
    }
    
    public function BusquedaClientes($var){
        $sql = sprintf("SELECT `clientes`.`id` AS ID, 
        `clientes`.`Nombre` AS Empresa, 
		CONCAT(`pempresa`.`nombre`, ' ',`pempresa`.`apellidos`) AS Contacto
		FROM `clientes`
		JOIN pempresa 
		ON `clientes`.`id` = `pempresa`.`idemp`
		WHERE (`clientes`.`Nombre` LIKE '%s'
		OR `clientes`.`Contacto` LIKE '%s'
		OR `pempresa`.`nombre` LIKE '%s'
		OR `pempresa`.`apellidos` LIKE '%s'
		OR CONCAT(
		`pempresa`.`nombre`,' ',`pempresa`.`apellidos`,'%s'
		) LIKE '%s')
    	and `clientes`.`Estado_de_cliente` = '-1'
		",
	    parent::escape("%{$var}%"),
	    parent::escape("%{$var}%"),
	    parent::escape("%{$var}%"),
	    parent::escape("%{$var}%"),
		"%",
	    parent::escape("%{$var}%")
	    );
	    parent::consulta($sql);
    }
    
    public function TelefonosEmpresas($var){
        $sql = sprintf("SELECT `id` AS ID, 
        `Nombre` AS Empresa,
        ' ' AS Contacto 
        FROM `clientes` 
		WHERE 
		(
			REPLACE(`Tfno1`, ' ', '') LIKE '%s' OR
			REPLACE(`Tfno2`, ' ', '') LIKE '%s' OR
			REPLACE(`Tfno3`, ' ', '') LIKE '%s'
		)
    	AND `Estado_de_cliente` = '-1'",
	    parent::escape("%{$var}%"),
	    parent::escape("%{$var}%"),
	    parent::escape("%{$var}%"),
	    parent::escape("%{$var}%")
	    );
	    parent::consulta($sql);
    }
    
    public function TelefonosEmpleadosEmpresas($var){
        $sql = sprintf("SELECT `clientes`.`id` AS ID, 
        CONCAT(`pempresa`.`nombre`,' ',`pempresa`.`apellidos`) AS Contacto,
        `clientes`.`Nombre` AS Empresa
		FROM `pempresa`  
		INNER JOIN `clientes` ON `clientes`.`id` = `pempresa`.`idemp`
		WHERE REPLACE(`pempresa`.`telefono`, ' ', '') LIKE '%s'
		AND `clientes`.`Estado_de_cliente` = '-1'",
	    parent::escape("%{$var}%")
	    );
	    parent::consulta($sql);
    }
    
    public function TelefonosPersonalCentral($var){
        $sql = sprintf("SELECT `clientes`.`id` AS ID,
        `pcentral`.`persona_central` AS Contacto,
		`clientes`.`Nombre` AS Empresa 
		FROM `pcentral` 
		INNER JOIN `clientes` ON `clientes`.`id` = `pcentral`.`idemp` 
    	WHERE REPLACE(`pcentral`.`telefono`, ' ', '') LIKE '%s'
    	and `clientes`.`Estado_de_cliente` = '-1'",
	    parent::escape("%{$var}%")
	    );
	    parent::consulta($sql);
    }
    
    public function Proveedores($var){
        $sql = sprintf("SELECT `proveedores`.`Id` AS ID, 
		`proveedores`.`Nombre` AS Empresa, 
		CONCAT(
		`pproveedores`.`nombre`, ' ', `pproveedores`.`apellidos`
		) AS Contacto 
		FROM `proveedores` 
		LEFT JOIN `pproveedores` 
		ON `proveedores`.`id` = `pproveedores`.`idemp` 
		WHERE `proveedores`.`Nombre` LIKE '%s' 
		OR `pproveedores`.`nombre` LIKE '%s' 
		OR `pproveedores`.`apellidos` LIKE '%s' 
		OR 
		CONCAT( `pproveedores`.`nombre`, ' ', `pproveedores`.`apellidos`, '%s' )
	 	LIKE '%s'",
	    parent::escape("%{$var}%"),
	    parent::escape("%{$var}%"),
	    parent::escape("%{$var}%"),
		"%",
	    parent::escape("%{$var}%")
	    );
	    parent::consulta($sql);
    }
    
    public function Telecomunicaciones($var){
        $sql = sprintf("SELECT `clientes`.`ID` AS ID, 
        `clientes`.`Nombre` AS Empresa, 
		`z_sercont`.`valor`, `z_sercont`.`servicio` 
		FROM clientes INNER JOIN `z_sercont` 
		ON `clientes`.`ID` =  `z_sercont`.`idemp`
		WHERE REPLACE(`valor`, ' ', '') LIKE '%s'
		AND `clientes`.`Estado_de_cliente` = '-1'",
	    parent::escape("%{$var}%")
	    );
	    parent::consulta($sql);
    }
}
?>