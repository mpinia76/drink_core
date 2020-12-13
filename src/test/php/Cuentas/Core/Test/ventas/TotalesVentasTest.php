<?php

namespace Drink\Core\Test\ventas;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\SucursalCriteria;

include_once dirname(__DIR__). '/conf/init.php';

class TotalesVentasTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getVentaService();
		
		\Logger::getLogger(__CLASS__)->info("totales de venta del día");		
		
		$totales = $service->getTotalesDia( new \Datetime() );
		
		\Logger::getLogger(__CLASS__)->info( "cantidad: " . $totales["cantidad"]);
		\Logger::getLogger(__CLASS__)->info( "monto: " . $totales["monto"]);

		\Logger::getLogger(__CLASS__)->info("totales de venta del mes");		
		
		$totales = $service->getTotalesMes( new \Datetime() );
		
		\Logger::getLogger(__CLASS__)->info( "cantidad: " . $totales["cantidad"]);
		\Logger::getLogger(__CLASS__)->info( "monto: " . $totales["monto"]);
		
	}
}
?>