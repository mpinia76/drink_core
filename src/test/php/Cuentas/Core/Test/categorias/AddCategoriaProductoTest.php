<?php

namespace Drink\Core\Test\categorias;

use Drink\Core\model\CategoriaProducto;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\Test\GenericTest;

use Cose\Security\service\SecurityContext;

use Drink\Core\service\ServiceFactory;
use Drink\Core\criteria\CajaCriteria;

include_once dirname(__DIR__). '/conf/init.php';

class AddCategoriaProductoTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getCategoriaProductoService();
		
		\Logger::getLogger(__CLASS__)->info("agregando CategoriaProducto");		
		
		$cp = new CategoriaProducto();
		$cp->setNombre("RUBRO GENERAL");
		$service->add( $cp );
		
		
	}
}
?>