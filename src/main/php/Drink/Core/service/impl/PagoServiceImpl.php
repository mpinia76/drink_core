<?php
namespace Drink\Core\service\impl;


use Drink\Core\service\ServiceFactory;

use Drink\Core\utils\DrinkUtils;

use Drink\Core\model\Pago;

use Drink\Core\model\EstadoPago;

use Drink\Core\service\IPagoService;

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
 * servicio para Pago
 *  
 * @author Marcos
 * @since 23-03-2018
 *
 */
class PagoServiceImpl extends CrudService implements IPagoService {

	
	protected function getDAO(){
		return DAOFactory::getPagoDAO();
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
	 * @see src/main/php/Drink/Core/service/Drink\Core\service.IVentaService::anular()
	 */
	public function anular(Pago $pago, User $user){
	
		
		//validamos si se puede
		$this->validateOnAnular($pago);
		
		
		//si fue pagada, hay que generar un contramovimiento.
		if( $pago->getEstado() == EstadoPago::Realizado ){
		
			//generar contramovimientos.
			
			//TODO generar un contramovmiento de la cta cte del cliente
			//y otro en la caja donde se cobró el pago.
			$criteria = new MovimientoPagoCriteria();
			$criteria->setPago( $pago );
			$movimientos = ServiceFactory::getMovimientoPagoService()->getList( $criteria );
			
			$conceptoAnulacion = DrinkUtils::getConceptoMovimientoAnulacionPago();
			foreach ($movimientos as $movimiento) {
				$contramovimiento = $movimiento->buildContramovimiento();
				$contramovimiento->setConcepto( $conceptoAnulacion );
				$contramovimiento->setUser($user);
				ServiceFactory::getMovimientoPagoService()->add( $contramovimiento );;
			}
			
		}
		
		//modificamos el estado del pago
		$pago->setEstado(EstadoPago::Anulado);
		
		//persistimos los cambios.
		try {
			
			$this->getDAO()->update( $venta );
			
		} catch (DAOException $e){
			
			throw new ServiceException( $e->getMessage() );
			
		} catch (\Exception $e) {

			throw new ServiceException( $e->getMessage() );
		
		}
	
	}
	
	function validateOnAnular( Pago $pago ){
	
		//que no esté anulado
		if( $pago->getEstado() == EstadoPago::Anulado ){
			throw new ServiceException("pago.anular.anulado");
		}
		
	}
	
}	