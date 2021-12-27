<?php
namespace Drink\Core\service\impl;


use Drink\Core\utils\DrinkUtils;

use Drink\Core\model\MovimientoPago;

use Drink\Core\model\MovimientoActualizacion;

use Drink\Core\model\Sucursal;

use Drink\Core\model\EstadoPago;
use Cose\Security\model\User;

use Drink\Core\model\Pago;

use Drink\Core\model\Actualizacion;

use Drink\Core\model\Empleado;

use Drink\Core\model\Cuenta;

use Drink\Core\model\Cliente;

use Drink\Core\service\ServiceFactory;



use Drink\Core\criteria\CuentaCorrienteCriteria;

use Drink\Core\service\ICuentaCorrienteService;

use Drink\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para cuentaCorriente
 *
 * @author Marcos
 * @since 21-03-2018
 *
 */
class CuentaCorrienteServiceImpl extends CrudService implements ICuentaCorrienteService {


	protected function getDAO(){
		return DAOFactory::getCuentaCorrienteDAO();
	}

	function add( $entity ){

		$entity->setSaldo( $entity->getSaldoInicial() );

		$entity->getCliente()->setCuentaCorriente( $entity );

		parent::add( $entity );

//		//le asignamos la cuenta al cliente.
//		$cliente = DAOFactory::getClienteDAO()->get( $entity->getCliente()->getOid() );
//		$cliente->setCuentaCorriente( $entity );
//		DAOFactory::getClienteDAO()->update( $cliente );

	}

	function validateOnAdd( $entity ){

		//TODO que tenga cliente?

		//TODO unicidad (cliente )

	}


	function validateOnUpdate( $entity ){

		$this->validateOnAdd($entity);
	}

	function validateOnDelete( $oid ){}


	public function getByCliente( Cliente $cliente ){

		$criteria = new CuentaCorrienteCriteria();
		$criteria->setCliente($cliente);

		try {

			$cuentaCorriente = $this->getDAO()->getSingleResult( $criteria );

			return $cuentaCorriente;

		} catch (DAOException $e) {

			throw new ServiceException( $e->getMessage() );

		} catch (\Exception $e) {

			throw new ServiceException( $e->getMessage() );
		}



	}

	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Drink/Core/service/Drink\Core\service.ICuentaCorrienteService::getTotalesVenta()
	 */
	public function getTotalesVenta( \DateTime $fecha ){

		$totales=0;

		//obtenemos todas las cuentas corrientes
		$criteria = new CuentaCorrienteCriteria();
		$cuentas = $this->getList( $criteria );
		foreach ($cuentas as $ctacte) {
			$totales += ServiceFactory::getMovimientoVentaService()->getTotales( $ctacte, $fecha );
		}

		return $totales;

	}


	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Drink/Core/service/Drink\Core\service.ICuentaCorrienteService::getTotalesPago()
	 */
	public function getTotalesPago( \DateTime $fecha ){

		$totales=0;

		//obtenemos todas las cuentas corrientes
		$criteria = new CuentaCorrienteCriteria();
		$cuentas = $this->getList( $criteria );
		foreach ($cuentas as $ctacte) {
			$totales += ServiceFactory::getMovimientoPagoPremioService()->getTotales( $ctacte, $fecha );
		}

		return $totales;

	}

	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Drink/Core/service/Drink\Core\service.ICuentaCorrienteService::cobrarDeuda()
	 */
	public function cobrarDeuda(Cliente $cliente, Cuenta $destino, $monto, $observaciones, User $user){

		//generamos un pago por el monto.
		$pago = new Pago();
		$pago->setCliente($cliente);

		$pago->setEstado(EstadoPago::Realizado);
		$pago->setFechaHora(new \DateTime());
		$pago->setMonto($monto);
		$pago->setObservaciones($observaciones);

		$pago->setUser($user);
		ServiceFactory::getPagoService()->add( $pago );

		//luego pagamos ese pago con la cuenta corriente del cliente (movimiento de pago sobre la cta cte).
		//creo un movimiento pago "haber" por el monto a pagar.
		$movimiento = new MovimientoPago();
		$movimiento->setHaber($monto);
		$movimiento->setDebe( 0 );
		$movimiento->setFecha( new \Datetime() );
		$movimiento->setObservaciones($observaciones);
		$movimiento->setPago($pago);
		$movimiento->setCuenta($cliente->getCuentaCorriente());
		$movimiento->setConcepto( DrinkUtils::getConceptoMovimientoPago() );
		$movimiento->setUser($user);
		ServiceFactory::getMovimientoPagoService()->add($movimiento);

		//y generamos también otro movimiento de pago sobre la cuenta destino que es donde va el dinero.(movimiento de pago sobre la cta destino).
		$movimiento = new MovimientoPago();
		$movimiento->setHaber($monto);
		$movimiento->setDebe( 0 );
		$movimiento->setFecha( new \Datetime() );
		$movimiento->setObservaciones("");
		$movimiento->setPago($pago);
		$movimiento->setCuenta($destino);
		$movimiento->setConcepto( DrinkUtils::getConceptoMovimientoPago() );
		$movimiento->setUser($user);
        if(!DrinkUtils::isAdmin($user)){
        //if ($user->getUsername()=='melisa'){

            DrinkUtils::send_whatsapp($user->getUsername().' cobró la cta. cte. de '.$pago->getCliente()->getNombre().'\nMonto: '.DrinkUtils::formatMontoToView($pago->getMonto()).'\nObservaciones: '.$pago->getObservaciones());
        }

		ServiceFactory::getMovimientoPagoService()->add($movimiento);

	}

	/**
	 * (non-PHPdoc)
	 * @see src/main/php/Drink/Core/service/Drink\Core\service.ICuentaCorrienteService::actualizarDeuda()
	 */
	public function actualizarDeuda(Cliente $cliente, Cuenta $destino, $monto, $observaciones, User $user){

		//generamos un actualizacion por el monto.
		$actualizacion = new Actualizacion();
		$actualizacion->setCliente($cliente);


		$actualizacion->setFechaHora(new \DateTime());
		$actualizacion->setMonto($monto);
		$actualizacion->setObservaciones($observaciones);

		$actualizacion->setUser($user);
		ServiceFactory::getActualizacionService()->add( $actualizacion );

		//creo un movimiento "debe" por el monto a actualizar.
		$movimiento = new MovimientoActualizacion();
		$movimiento->setDebe( $monto );
		$movimiento->setFecha( new \Datetime() );
		$movimiento->setHaber( 0 );
		$movimiento->setObservaciones($observaciones);
		$movimiento->setActualizacion($actualizacion);
		$movimiento->setCuenta($cliente->getCuentaCorriente());
		//$movimiento->setCaja($caja);
		$movimiento->setConcepto( DrinkUtils::getConceptoMovimientoActualizacion() );
		$movimiento->setUser($user);

		ServiceFactory::getMovimientoActualizacionService()->add( $movimiento );



	}

}
