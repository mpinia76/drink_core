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

class AddPreventaRecurrenteTest extends GenericTest{
	
	
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getPreventaRecurrenteService();
		
		\Logger::getLogger(__CLASS__)->info("agregando PreventaRecurrente");		
		
		$empleado = ServiceFactory::getEmpleadoService()->get( DrinkUtils::CTS_EMPLEADO_DEFAULT );
		$cliente = ServiceFactory::getClienteService()->get( DrinkUtils::CTS_CLIENTE_DEFAULT );
		$sucursal = ServiceFactory::getSucursalService()->get( DrinkUtils::CTS_SUCURSAL_DEFAULT );
		
		$preventaRecurrente = new PreventaRecurrente();
		$preventaRecurrente->setCliente($cliente);
		$preventaRecurrente->setVendedor($empleado);
		$preventaRecurrente->setLunes(1);
		$preventaRecurrente->setMiercoles(1);
		
		$detalle = new DetallePreventaRecurrente();
		$detalle->setCantidad(1);
		$detalle->setObservaciones("8 9 13 22 30 31");
		$detalle->setPrecioUnitario(20);
		$detalle->setProducto( ServiceFactory::getProductoService()->get(1) );
		$preventaRecurrente->addDetalle($detalle);
		
		$this->persistenceContext->beginTransaction();
		
		$service->add( $preventaRecurrente );
		
		
		$this->persistenceContext->commit();
	}
}
?>