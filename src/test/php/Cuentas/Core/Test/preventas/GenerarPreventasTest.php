<?php

namespace Drink\Core\Test\preventas;

use Drink\Core\model\DetallePreventaRecurrente;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\model\PreventaRecurrente;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\PreventaRecurrenteCriteria;

include_once dirname(__DIR__). '/conf/init.php';

class GenerarPreventasTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getPreventaRecurrenteService();
		
		\Logger::getLogger(__CLASS__)->info("generando preventas");		
		
		$this->persistenceContext->beginTransaction();
		
		$fecha = new \DateTime();
		$fecha->modify("+2 days");
		$service->generarPreventas( $fecha );
		
		
		$this->persistenceContext->commit();
	}
}
?>