<?php
namespace Drink\Core\service;


use Drink\Core\model\Cuenta;

use Drink\Core\model\Caja;

use Drink\Core\model\Presupuesto;

use Cose\Crud\service\ICrudService;

use Cose\Security\model\User;

/**
 * interfaz para el servicio de Presupuesto
 *  
 * @author Marcos
 * @since 29-03-2019
 *
 */
interface IPresupuestoService extends ICrudService {
	
	
	
	/**
	 * se anula la presupuesto
	 * @param $presupuesto
	 */
	public function anular(Presupuesto $presupuesto, User $user);
	
	/**
	 * totales de presupuestos del día.
	 * @param \Datetime $fecha
	 */
	public function getTotalesDia(\Datetime $fecha);

	/**
	 * totales de presupuestos del mes
	 * @param $fecha
	 */
	public function getTotalesMes(\Datetime $fecha);
	
	
}