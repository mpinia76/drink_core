<?php

namespace Drink\Core\Test\conceptosMovimiento;

include_once dirname(__DIR__). '/conf/init.php';

use Drink\Core\criteria\ConceptoMovimientoCriteria;

use Drink\Core\Test\GenericTest;
use Drink\Core\service\ServiceFactory;

use Cose\Security\service\SecurityContext;

class ListConceptosMovimientoTest extends GenericTest{
	
	/**
	 * @Security( permission="listar_conceptosMovimiento" )
	 */
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getConceptoMovimientoService();
		
		$this->log("listando conceptos de movimiento", __CLASS__);
		
		$criteria = new ConceptoMovimientoCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		
		$entities = $service->getList( $criteria );
		
		foreach ($entities as $entity) {
			
			$this->log("Concepto movimiento: " . $entity, __CLASS__);
			
		}
		
	}
}
?>