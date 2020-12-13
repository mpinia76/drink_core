<?php

namespace Drink\Core\Test\gastos;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\model\EstadoGasto;

use Drink\Core\model\Gasto;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\GastoCriteria;

include_once dirname(__DIR__). '/conf/init.php';

class AddGastoTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getSucursalService();
		
		\Logger::getLogger(__CLASS__)->info("agregando Gasto");		
		
		$gasto = new Gasto();
		$gasto->setEstado(EstadoGasto::Realizado);
		$gasto->setFechaHora( new \Datetime() );
		$gasto->setMonto(380);
		
		$gasto->setVendedor( DrinkUtils::getEmpleadoDefault() );

		$gasto->setUser(DrinkUtils::getUserByUsername("bernardo"));
		$gasto->setConcepto( DrinkUtils::getConceptoGastoVarios() );
		
		$service->add( $gasto );
		
		
	}
}
?>