<?php

namespace Drink\Core\Test\conceptosGasto;

use Drink\Core\model\Loteria;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;

include_once dirname(__DIR__). '/conf/init.php';

class AddLoteriaTest extends GenericTest{
	
	
	public function test(){
		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getLoteriaService();
		
		\Logger::getLogger(__CLASS__)->info("agregando Loteria");		
		
		$concepto = new Loteria();
		$concepto->setNombre("Provincia");
		$service->add( $concepto );
		
		$concepto = new Loteria();
		$concepto->setNombre("Nacional");
		$service->add( $concepto );
		
		$concepto = new Loteria();
		$concepto->setNombre("Santa Fé");
		$service->add( $concepto );
		
		$concepto = new Loteria();
		$concepto->setNombre("Montevideo");
		$service->add( $concepto );
		
		$concepto = new Loteria();
		$concepto->setNombre("Córdoba");
		$service->add( $concepto );
		
		$concepto = new Loteria();
		$concepto->setNombre("Entre Ríos");
		$service->add( $concepto );
		
		$concepto = new Loteria();
		$concepto->setNombre("Mendoza");
		$service->add( $concepto );
		
		$concepto = new Loteria();
		$concepto->setNombre("Santiago");
		$service->add( $concepto );
		
	}
}
?>