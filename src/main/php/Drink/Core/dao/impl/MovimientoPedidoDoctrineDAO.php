<?php
namespace Drink\Core\dao\impl;

use Drink\Core\dao\IMovimientoPedidoDAO;

use Drink\Core\model\MovimientoPedido;

use Drink\Core\model\ConceptoMovimiento;

use Drink\Core\dao\IConceptoMovimientoDAO;

use Drink\Core\criteria\ConceptoMovimientoCriteria;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

use Drink\Core\model\Cuenta;
use Doctrine\ORM\Query\Expr\Andx;

/**
 * dao para MovimientoPedido
 *  
 * @author Marcos
 * @since 27-08-2020
 * 
 */
class MovimientoPedidoDoctrineDAO extends CrudDAO implements IMovimientoPedidoDAO{
	
	protected function getClazz(){
		return get_class( new MovimientoPedido() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('mp', 'p', 'c'))
	   				->from( $this->getClazz(), "mp")
					->leftJoin('mp.cuenta', 'c')
					->leftJoin('mp.pedido', 'p');
		
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(mp.oid)')
	   				->from( $this->getClazz(), "mp")
					->leftJoin('mp.cuenta', 'c')
					->leftJoin('mp.pedido', 'p');
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
//		$oid = $criteria->getOidNotEqual();
//		if( !empty($oid) ){
//			$queryBuilder->andWhere( "mp.oid <> $oid");
//		}
		
		//TODO filtrar por cuenta y fecha.
		
		$pedido = $criteria->getPedido();
		if( !empty($pedido) && $pedido!=null){
			$pedidoOid = $pedido->getOid();
			if(!empty($pedidoOid))
				$queryBuilder->andWhere( "p.oid= $pedidoOid" );
		}
		
		
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "mp.$name";	
		}	
		
	}

	public function getTotales(Cuenta $cuenta=null, \Datetime $fecha = null){
	
		try {
			
			$movimientoClass = get_class( new MovimientoPedido() );
			
			
			
			$emConfig = $this->getEntityManager()->getConfiguration();
			$emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
    		$emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
    		$emConfig->addCustomDatetimeFunction('DAY', 'DoctrineExtensions\Query\Mysql\Day');

			$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
			$queryBuilder->select('SUM(mc.debe) as debe, SUM(mc.haber) as haber')
	   				->from( $movimientoClass, "mc")
					->leftJoin('mc.cuenta', 'c');
					
			if( $cuenta != null )		
				$queryBuilder->andWhere( "c.oid=" .  $cuenta->getOid() );
			
			if($fecha != null ){
				$queryBuilder->andWhere( "MONTH(mc.fecha) = " . $fecha->format("m") );
				$queryBuilder->andWhere( "YEAR(mc.fecha) = " . $fecha->format("Y") );
				$queryBuilder->andWhere( "DAY(mc.fecha) = " . $fecha->format("d") );
			}
			
			
			$q = $queryBuilder->getQuery();
			
			$r = $q->getScalarResult();
		
			return $r;
			
		} catch (\Doctrine\ORM\Query\QueryException $e) {
			
			throw new DAOException( $e->getMessage() );
			
		} catch (\Exception $e) {
			
			throw new DAOException( $e->getMessage() );
			
		}
	}
}