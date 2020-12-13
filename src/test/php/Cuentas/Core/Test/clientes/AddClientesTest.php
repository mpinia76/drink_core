<?php

namespace Drink\Core\Test\clientes;

use Drink\Core\model\Cliente;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\ClienteCriteria;

include_once dirname(__DIR__). '/conf/init.php';

class AddClientesTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getClienteService();
		
		\Logger::getLogger(__CLASS__)->info("agregando cliente");		
		
		$cliente = new Cliente();
		$cliente->setNombre("CLIENTE MOSTRADOR");
		$cliente->setApellido("");
		$service->add( $cliente );
		
		
	}
}
?>