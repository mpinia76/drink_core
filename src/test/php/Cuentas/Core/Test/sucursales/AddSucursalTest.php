<?php

namespace Drink\Core\Test\sucursals;

use Drink\Core\model\Sucursal;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\SucursalCriteria;

include_once dirname(__DIR__). '/conf/init.php';

class AddSucursalsTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getSucursalService();
		
		\Logger::getLogger(__CLASS__)->info("agregando sucursal");		
		
		$sucursal = new Sucursal();
		$sucursal->setNombre("CASA MATRIZ");
		$service->add( $sucursal );
		
		
	}
}
?>