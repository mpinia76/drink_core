<?php
namespace Drink\Core\service\impl;


use Drink\Core\service\ServiceFactory;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\model\DetalleVenta;



use Drink\Core\service\IDetalleVentaService;

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
 * servicio para DetalleVenta
 *  
 * @author Marcos
 * @since 15-08-2020
 *
 */
class DetalleVentaServiceImpl extends CrudService implements IDetalleVentaService {

	
	protected function getDAO(){
		return DAOFactory::getDetalleVentaDAO();
	}
	
	
	function validateOnAdd( $entity ){
	
		//TODO		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


	
	
}	