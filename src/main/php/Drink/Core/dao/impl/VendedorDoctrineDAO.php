<?php
namespace Drink\Core\dao\impl;

use Drink\Core\utils\DrinkUtils;

use Doctrine\ORM\Query\Expr\Andx;

use Drink\Core\dao\IVendedorDAO;

use Drink\Core\model\Vendedor;



use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
/**
 * dao para Vendedor
 *  
 * @author Marcos
 * @since 28-08-2018
 * 
 */
class VendedorDoctrineDAO extends CrudDAO implements IVendedorDAO{
	
	protected function getClazz(){
		return get_class( new Vendedor() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('v'))
	   				->from( $this->getClazz(), "v");
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(v.oid)')
	   				->from( $this->getClazz(), "v");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere("upper(v.nombre)  like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "v.$name";	
		}	
		
	}	
	
	
	
	
}