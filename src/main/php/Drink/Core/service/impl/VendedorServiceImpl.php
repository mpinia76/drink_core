<?php
namespace Drink\Core\service\impl;






use Drink\Core\utils\DrinkUtils;



use Drink\Core\service\ServiceFactory;



use Drink\Core\model\Vendedor;



use Drink\Core\service\IVendedorService;

use Drink\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;


use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

use Rasty\utils\Logger;

/**
 * servicio para Vendedor
 *  
 * @author Marcos
 * @since 28-08-2018
 *
 */
class VendedorServiceImpl extends CrudService implements IVendedorService {

	
	protected function getDAO(){
		return DAOFactory::getVendedorDAO();
	}
	
	
	/**
	 * redefino el add
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){

		
		
		parent::add($entity);
		
	}	
	
	
	
	
	function validateOnAdd( $entity ){
	
		
		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}

	
	
	
	
	
	
	
	
	
}	