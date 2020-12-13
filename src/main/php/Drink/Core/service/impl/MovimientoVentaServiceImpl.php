<?php
namespace Drink\Core\service\impl;


use Drink\Core\model\CategoriaProducto;

use Drink\Core\model\Cuenta;

use Drink\Core\service\IMovimientoCuentaService;

use Drink\Core\model\MovimientoVenta;

use Drink\Core\service\ServiceFactory;

use Drink\Core\model\Caja;

use Drink\Core\model\Venta;

use Drink\Core\model\EstadoVenta;

use Drink\Core\service\IVentaService;

use Drink\Core\dao\DAOFactory;

use Cose\Crud\service\impl\CrudService;

use Cose\Security\service\SecurityContext;
use Cose\Security\model\User;

use Cose\exception\ServiceException;
use Cose\exception\ServiceNoResultException;
use Cose\exception\ServiceNonUniqueResultException;
use Cose\exception\DuplicatedEntityException;
use Cose\exception\DAOException;

/**
 * servicio para MovimientoVenta
 *  
 * @author Marcos
 * @since 12-03-2018
 *
 */
class MovimientoVentaServiceImpl extends MovimientoCajaServiceImpl {

	
	protected function getDAO(){
		return DAOFactory::getMovimientoVentaDAO();
	}
		
	public function getTotalesCajaVentasOnlineCtaCte( Caja $caja ){
		
		$result = $this->getDAO()->getTotalesCajaVentasOnlineCtaCte($caja);
		$totales = $result[0];
		return $totales["haber"] - $totales["debe"];
		
	}
	
	function getTotales( Cuenta $cuenta=null, \Datetime $fecha = null){
		
		$result = $this->getDAO()->getTotales($cuenta, $fecha);
		$totales = $result[0];
		return $totales["haber"] - $totales["debe"];
		
	}
	
	
	
	function getTotalesPorCategoria( Cuenta $cuenta=null, \Datetime $fecha = null){
		
		$result = $this->getDAO()->getTotalesPorCategoria($cuenta, $fecha);
		return $result;
		
	}
	
	function getTotalesMes( Cuenta $cuenta=null, \Datetime $fecha = null){
		
		$result = $this->getDAO()->getTotalesMes($cuenta, $fecha);
		return $result;
		
	}
	
	function getTotalesAnioPorMes( Cuenta $cuenta=null, $anio){
		
		$result = $this->getDAO()->getTotalesAnioPorMes($cuenta, $anio);
		return $result;
		
	}
	
}	