<?php

/**
 * Enter description here ...
 * @author ruben
 *
 */
require_once 'Sql.php';
class Aplicacion extends Sql
{
    public function __construct ()
    {
        parent::__construct();
    }
    
   
    public function listadoCategorias(){
        
    }
    
    public function pagina($pagina){
        $sql = sprintf("Select pagina from menus where id like '%s'",
        parent::escape($pagina));
        parent::consulta($sql);
    }
    
    public function buscador($vars){
        if($vars['tabla']=='clientes')
           $sql = sprintf("SELECT * FROM `%s` 
           WHERE `Nombre` LIKE '%s' 
           OR `Contacto` LIKE '%s' 
           ORDER BY `Nombre`",
           parent::escape($vars['tabla']),
           parent::escape("%".utf8_encode($vars['texto'])."%"),
           parent::escape("%".utf8_encode($vars['texto'])."%")
           );
		else
            $sql = sprintf("SELECT * FROM `%s` 
        	WHERE `Nombre` LIKE '%s' 
        	ORDER BY `Nombre`",
            parent::escape($vars['tabla']),
            parent::escape("%".utf8_encode($vars['texto'])."%")
            );
        parent::consulta($sql);    
    }
}
?>