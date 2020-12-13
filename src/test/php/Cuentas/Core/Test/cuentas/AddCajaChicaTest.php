<?php

namespace Drink\Core\Test\cajas;

use Drink\Core\model\CajaChica;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\model\Caja;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\CajaCriteria;

include_once dirname(__DIR__). '/conf/init.php';

class AddCajasTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getCajaChicaService();
		
		\Logger::getLogger(__CLASS__)->info("agregando caja chica");		
		
		$caja = new CajaChica();
		$caja->setNumero("1");
		$caja->setFecha( new \Datetime() );
		$caja->setSaldoInicial( 0 );
		$caja->setSaldo( 0 );
		$service->add( $caja );
		
		
	}
}
?>