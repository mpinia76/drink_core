<?php
namespace Drink\Core\model;

/**
 * Tipo de cliente 
 *  
 * @author Marcos
 * @since 13-08-2020
 */

class TipoCliente  {
    
    const Local = 1;
    const Calle = 2;
    
 
    private static $items = array( self::Local => "tipo.cliente.local.label", 
    								   self::Calle => "tipo.cliente.calle.label",);
    
	public static function getItems(){
		return self::$items;
	}
	
	public static function getLabel($value){
		if(array_key_exists($value, self::$items))
			return self::$items[$value];
	}
}
?>
