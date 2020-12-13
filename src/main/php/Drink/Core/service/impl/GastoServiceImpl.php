<?php
namespace Drink\Core\service\impl;


use Drink\Core\criteria\GastoCriteria;

use Drink\Core\criteria\MovimientoGastoCriteria;

use Drink\Core\service\ServiceFactory;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\model\MovimientoGasto;

use Drink\Core\model\EstadoGasto;

use Drink\Core\model\Cuenta;

use Drink\Core\model\Gasto;

use Drink\Core\service\IGastoService;

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
 * servicio para Gasto
 *  
 * @author Marcos
 * @since 12-03-2018
 *
 */
class GastoServiceImpl extends CrudService implements IGastoService {

	
	protected function getDAO(){
		return DAOFactory::getGastoDAO();
	}
	
	
	/**
	 * redefino el add
	 * @param $entity
	 * @throws ServiceException
	 */
	public function add($entity){

		$entity->setEstado( EstadoGasto::Impago );
		
		//agregamos el gasto.
		parent::add($entity);
		
	}	
	
	function validateOnAdd( $entity ){
	
		//TODO		
	}
		
	
	function validateOnUpdate( $entity ){
	
		$this->validateOnAdd($entity);
	}
	
	function validateOnDelete( $oid ){}

	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Drink/Core/service/Drink\Core\service.IGastoService::pagar()
	 */
	public function pagar(Gasto $gasto, Cuenta $cuenta, User $user){
	
		$this->validateOnPagar($gasto, $cuenta);
		
		//seteamos el gasto como pagado
		$gasto->setEstado( EstadoGasto::Pagado );
		
		//obtenemos lo que hay que pagar.
		$monto = $gasto->getMonto();
		
		//creo un movimiento gasto "debe" por el monto a pagar.
		$movimiento = new MovimientoGasto();
		$movimiento->setDebe($monto);
		$movimiento->setHaber( 0 );
		$movimiento->setFecha( new \Datetime() );
		$movimiento->setObservaciones( $gasto->getConcepto()->getNombre() );
		$movimiento->setGasto($gasto);
		$movimiento->setCuenta($cuenta);
		$movimiento->setConcepto( DrinkUtils::getConceptoMovimientoGasto() );
		$movimiento->setUser($user);
		
		ServiceFactory::getMovimientoGastoService()->add( $movimiento );
		
	}
	
	function validateOnPagar( Gasto $gasto, Cuenta $cuenta){
	
		//el estado debe ser "Impago"
		if( EstadoGasto::Impago != $gasto->getEstado() ){
			throw new ServiceException("gasto.pagar.impaga.required");
		}
		
		//TODO algo sobre la cuenta??
		
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Drink/Core/service/Drink\Core\service.IGastoService::anular()
	 */
	public function anular(Gasto $gasto, User $user){
	
		
		//validamos si se puede
		$this->validateOnAnular($gasto);
		
		
		//si fue pagado, hay que generar un contramovimiento.
		if( $gasto->getEstado() == EstadoGasto::Pagado ){
		
			//generar contramovimiento.
			
			//hay que buscar el movimiento de cuenta realizado para este gasto
			//generar uno igual con el monto en haber, fecha actual y concepto "anulación gasto"
			$criteria = new MovimientoGastoCriteria();
			$criteria->setGasto($gasto);
			$movimiento = ServiceFactory::getMovimientoGastoService()->getSingleResult( $criteria );
			
			$contramovimiento = $movimiento->buildContramovimiento();
			$contramovimiento->setConcepto( DrinkUtils::getConceptoMovimientoAnulacionGasto() );
			$contramovimiento->setUser($user);
			
			ServiceFactory::getMovimientoGastoService()->add( $contramovimiento );
			
			
		}
		
		//modificamos el estado del gasto
		$gasto->setEstado(EstadoGasto::Anulado);
		
		//persistimos los cambios.
		try {
			
			$this->getDAO()->update( $gasto );
			
		} catch (DAOException $e){
			
			throw new ServiceException( $e->getMessage() );
			
		} catch (\Exception $e) {

			throw new ServiceException( $e->getMessage() );
		
		}
	
	}
	
	function validateOnAnular( Gasto $gasto ){
	
		//que no esté anulado
		if( $gasto->getEstado() == EstadoGasto::Anulado ){
			throw new ServiceException("gasto.anular.anulado");
		}
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Drink/Core/service/Drink\Core\service.IGastoService::getGastosPorVencer()
	 */
	public function getGastosPorVencer(){
	
		$fechaVencimientoHasta = new \Datetime();
		$fechaVencimientoHasta->modify("+30 day");
		
		$criteria = new GastoCriteria();
		$criteria->setFechaVencimientoHasta($fechaVencimientoHasta);
		$criteria->setEstadosNotIn( array( EstadoGasto::Pagado, EstadoGasto::Anulado ) );
		$criteria->addOrder("fechaVencimiento", "ASC");
		return $this->getList( $criteria );
	}
	
}	