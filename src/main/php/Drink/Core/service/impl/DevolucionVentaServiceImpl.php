<?php
namespace Drink\Core\service\impl;


use Drink\Core\service\ServiceFactory;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\model\DevolucionVenta;



use Drink\Core\service\IDevolucionVentaService;

use Drink\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;
use Cose\Security\model\User;

/**
 * servicio para DevolucionVenta
 *  
 * @author Marcos
 * @since 15-08-2020
 *
 */
class DevolucionVentaServiceImpl extends CrudService implements IDevolucionVentaService {

	
	protected function getDAO(){
		return DAOFactory::getDevolucionVentaDAO();
	}
	
	
	function validateOnAdd( $entity ){
	
		//TODO		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


	
	
}	