<?php
namespace Drink\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de devolucion
 *  
 * @author Marcos
 * @since 15-08-2020
 *
 */
class DevolucionVentaCriteria extends Criteria{

	
	
	
	
	private $ventas;
	
	private $productos;
	
	
	
	

	

	public function getProductos()
	{
	    return $this->productos;
	}

	public function setProductos($productos)
	{
	    $this->productos = $productos;
	}

	public function getVentas()
	{
	    return $this->ventas;
	}

	public function setVentas($ventas)
	{
	    $this->ventas = $ventas;
	}
}