<?php

namespace Drink\Core\Test\proveedores;

include_once dirname(__DIR__). '/conf/init.php';

use Drink\Core\Test\GenericTest;
use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\ProveedorCriteria;

use Cose\Security\service\SecurityContext;

class ListProveedoresTest extends GenericTest{
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getProveedorService();
		
		$this->log("listando proveedores", __CLASS__);
		
		$criteria = new ProveedorCriteria();
		$criteria->setMaxResult(5);
		//$criteria->setNombre("Ber");
		
		$proveedores = $service->getList( $criteria );
		
		foreach ($proveedores as $proveedor) {
			
			$this->log("Proveedor: " . $proveedor, __CLASS__);
			
		}
		
		
	}
}
?>