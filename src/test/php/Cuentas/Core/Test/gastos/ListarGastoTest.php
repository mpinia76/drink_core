<?php

namespace Drink\Core\Test\gastos;


include_once dirname(__DIR__). '/conf/init.php';

use Drink\Core\Test\GenericTest;
use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\GastoCriteria;

use Cose\Security\service\SecurityContext;

class ListGastoTest extends GenericTest{
	
	/**
	 */
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getGastoService();
		
		$this->log("listando gastoss", __CLASS__);
		
		$criteria = new GastoCriteria();
		
		$entities = $service->getList( $criteria );
		
		foreach ($entities as $entity) {
			
			$this->log("Gasto: " . $entity, __CLASS__);
			
		}
		
	}
}
?>