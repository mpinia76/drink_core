<?php
namespace Drink\Core\service\impl;


use Drink\Core\model\MovimientoCuenta;

use Drink\Core\model\Cuenta;

use Drink\Core\criteria\CuentaCriteria;

use Drink\Core\model\Empleado;

use Drink\Core\service\ICuentaService;

use Drink\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para cuenta
 *  
 * @author Marcos
 * @since 09-03-2018
 *
 */
class CuentaServiceImpl extends CrudService implements ICuentaService {

	
	protected function getDAO(){
		return DAOFactory::getCuentaDAO();
	}
	
	function validateOnAdd( $entity ){
	
		//unicidad (numero + fecha + horaApertura )
		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}


	
	
}	