<?php
namespace Drink\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Vendedor
 *  
 * @author Marcos
 *
 */
class VendedorCriteria extends Criteria{

	
	private $nombre;
	
	

	

	

	

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}
}