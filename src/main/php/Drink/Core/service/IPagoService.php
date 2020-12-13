<?php
namespace Drink\Core\service;


use Drink\Core\model\Pago;
use Cose\Security\model\User;

use Cose\Crud\service\ICrudService;

/**
 * interfaz para el servicio de Pago
 *  
 * @author Marcos
 * @since 23-03-2018
 *
 */
interface IPagoService extends ICrudService {

	function anular(Pago $pago, User $user);
}