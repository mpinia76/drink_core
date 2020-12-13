<?php
namespace Drink\Core\service\impl;


use Drink\Core\service\ServiceFactory;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\model\Actualizacion;



use Drink\Core\service\IActualizacionService;

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
 * servicio para Actualizacion
 *  
 * @author Marcos
 * @since 13-02-2020
 *
 */
class ActualizacionServiceImpl extends CrudService implements IActualizacionService {

	
	protected function getDAO(){
		return DAOFactory::getActualizacionDAO();
	}
	
	
	function validateOnAdd( $entity ){
	
		//TODO		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


	
	
}	