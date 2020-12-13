<?php
namespace Drink\Core\dao\impl;

use Drink\Core\dao\IPackDAO;

use Drink\Core\model\Pack;

use Cose\Crud\dao\impl\CrudDAO;

use Cose\criteria\ICriteria;

use Cose\exception\DAOException;
use Doctrine\ORM\QueryBuilder;

/**
 * dao para Pack
 *  
 * @author Marcos
 * 
 */
class PackDoctrineDAO extends CrudDAO implements IPackDAO{
	
	protected function getClazz(){
		return get_class( new Pack() );
	}
	
	protected function getQueryBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select(array('pack', 'p'))
	   				->from( $this->getClazz(), "pack")
					->leftJoin('pack.producto', 'p')
					->leftJoin('p.tipoProducto', 'tp')
					->leftJoin('p.marcaProducto', 'mp');
		
					
		return $queryBuilder;
	}

	protected function getQueryCountBuilder(ICriteria $criteria){
		
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		
		$queryBuilder->select('count(pack.oid)')
	   				->from( $this->getClazz(), "pack")
					->leftJoin('pack.producto', 'p')
					->leftJoin('p.tipoProducto', 'tp')
					->leftJoin('p.marcaProducto', 'mp');
	   				
								
		return $queryBuilder;
	}

	protected function enhanceQueryBuild(QueryBuilder $queryBuilder, ICriteria $criteria){
	
		$codigo = $criteria->getCodigo();
		if( !empty($codigo) ){
			$queryBuilder->andWhere("upper(pack.codigo)  like :codigo");
			$queryBuilder->setParameter( "codigo" , "%$codigo%" );
		}
		
		$codigoExacto = $criteria->getCodigoExacto();
		if( !empty($codigoExacto) ){
			$queryBuilder->andWhere("pack.codigo= '$codigoExacto'");
			
		}
		
		$nombre = $criteria->getNombre();
		if( !empty($nombre) ){
			$queryBuilder->andWhere("upper(pack.nombre)  like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombre%" );
		}
		
		
		
		$producto = $criteria->getProducto();
		if( !empty($producto) && $producto!=null){
			if (is_object($producto)) {
				$productoOid = $producto->getOid();
				if(!empty($productoOid))
					$queryBuilder->andWhere( "p.oid= $productoOid" );
			}
			else $queryBuilder->andWhere( "p.nombre like '%$producto%'");
			
		}
		
		
		
		$fechaDesde = $criteria->getFechaDesde();
		if( !empty($fechaDesde) ){
			$queryBuilder->andWhere("upper(pack.fecha)  >= :fechaDesde");
			$desde = $fechaDesde->format("Y-m-d");
			$queryBuilder->setParameter( "fechaDesde" , "$desde" );
		}
	
		$fechaHasta = $criteria->getFechaHasta();
		if( !empty($fechaHasta) ){
			$queryBuilder->andWhere("upper(pack.fecha)  <= :fechaHasta");
			$hasta = $fechaHasta->format("Y-m-d");
			$queryBuilder->setParameter( "fechaHasta" , "$hasta" );
		}
		
		$nombreOTipoOMarca = $criteria->getNombreOTipoOMarca();
		if( !empty($nombreOTipoOMarca) ){
			$queryBuilder->orWhere("upper(pack.nombre)  like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombreOTipoOMarca%" );
			$queryBuilder->orWhere("upper(p.nombre)  like :nombre");
			$queryBuilder->setParameter( "nombre" , "%$nombreOTipoOMarca%" );
			$queryBuilder->orWhere("upper(tp.nombre)  like :nombre1");
			$queryBuilder->setParameter( "nombre1" , "%$nombreOTipoOMarca%" );
			$queryBuilder->orWhere("upper(mp.nombre)  like :nombre2");
			$queryBuilder->setParameter( "nombre2" , "%$nombreOTipoOMarca%" );
		}
	}	
	
	protected function getFieldName($name){
		
		$hash = array();
		
		if( array_key_exists($name, $hash) )
			return $hash[$name];
		else{
			return "pack.$name";	
		}	
		
	}	
}