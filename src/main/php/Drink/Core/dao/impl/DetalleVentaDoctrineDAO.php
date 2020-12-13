<?php
namespace Drink\Core\dao\impl;

use Drink\Core\utils\DrinkUtils;

use Doctrine\ORM\Query\Expr\Andx;

use Drink\Core\dao\IDetalleVentaDAO;

use Drink\Core\model\DetalleVenta;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;
/**
 * dao para DetalleVenta
 *  
 * @author Marcos
 * @since 15-08-2020
 * 
 */
class DetalleVentaDoctrineDAO extends CrudDAO implements IDetalleVentaDAO{
	
	protected function getClazz(){
		return get_class( new DetalleVenta() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('dv'))
	   				->from( $this->getClazz(), "dv")
					;
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(dv.oid)')
	   				->from( $this->getClazz(), "dv");
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		
		
		$ventas = $criteria->getVentas();
		if( !empty($ventas)  ){
			
			$strVentas = implode(",", $ventas );
			
			$queryBuilder->andWhere( $queryBuilder->expr()->in("dv.venta", $strVentas) );
		}
		
		$productos = $criteria->getProductos();
		if( !empty($productos) ){
			
			$strProductos = implode(",", $productos );
			
			$queryBuilder->andWhere( $queryBuilder->expr()->in("dv.producto", $strProductos) );
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