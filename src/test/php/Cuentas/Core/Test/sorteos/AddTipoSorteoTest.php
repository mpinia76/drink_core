<?php

namespace Drink\Core\Test\conceptosGasto;

use Drink\Core\model\TipoSorteo;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;

include_once dirname(__DIR__). '/conf/init.php';

class AddTipoSorteoTest extends GenericTest{
	
	
	public function test(){
		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getTipoSorteoService();
		
		\Logger::getLogger(__CLASS__)->info("agregando TipoSorteo");		
		
		$concepto = new TipoSorteo();
		$concepto->setNombre("Primera");
		$service->add( $concepto );
		
		$concepto = new TipoSorteo();
		$concepto->setNombre("Matutina");
		$service->add( $concepto );
		
		$concepto = new TipoSorteo();
		$concepto->setNombre("Vespertina");
		$service->add( $concepto );
		
		$concepto = new TipoSorteo();
		$concepto->setNombre("Nocturna");
		$service->add( $concepto );
		
	}
}
?>