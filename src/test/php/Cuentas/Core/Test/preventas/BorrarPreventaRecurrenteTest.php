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

class BorrarPreventaRecurrenteTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getPreventaRecurrenteService();
		
		\Logger::getLogger(__CLASS__)->info("borrando PreventaRecurrente");		
		
		$this->persistenceContext->beginTransaction();
		
		$service->delete( 5 );
		
		
		$this->persistenceContext->commit();
	}
}
?>