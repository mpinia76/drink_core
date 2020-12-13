<?php

namespace Drink\Core\Test\empleados;

use Drink\Core\model\Empleado;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\EmpleadoCriteria;

include_once dirname(__DIR__). '/conf/init.php';

class AddEmpleadoTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getEmpleadoService();
		
		\Logger::getLogger(__CLASS__)->info("agregando empleado");		
		
		$empleado = new Empleado();
		$empleado->setNombre("TITULAR COMERCIO");
		$empleado->setApellido("");
		$empleado->setNumero("0");
		$empleado->setFechaIngreso( new \DateTime() );
		$service->add( $empleado );
		
		$empleado = new Empleado();
		$empleado->setNombre("José Marcos");
		$empleado->setApellido("Iribarne");
		$empleado->setNumero("1");
		$empleado->setFechaIngreso( new \DateTime() );
		$service->add( $empleado );
		
		
	}
}
?>