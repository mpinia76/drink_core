<?php

namespace Drink\Core\Test\ventas;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\SucursalCriteria;

include_once dirname(__DIR__). '/conf/init.php';

class AnularVentaTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getVentaService();
		
		\Logger::getLogger(__CLASS__)->info("anulando");		
		
		$venta = $service->get( 62  );
		
		$service->anular($venta, DrinkUtils::getUserByUsername("bernardo"));
		
		
	}
}
?>