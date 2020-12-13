<?php
namespace Drink\Core\service;

/**
 * Factory de servicios
 *  
 *  
 * @author Marcos
 * @since 27-02-2018
 *
 */

use Drink\Core\service\impl\PaisServiceImpl;
use Drink\Core\service\impl\MarcaProductoServiceImpl;
use Drink\Core\service\impl\IvaServiceImpl;
use Drink\Core\service\impl\TipoProductoServiceImpl;

use Drink\Core\service\impl\ConceptoGastoServiceImpl;
use Drink\Core\service\impl\ConceptoMovimientoServiceImpl;
use Drink\Core\service\impl\ProvinciaServiceImpl;
use Drink\Core\service\impl\LocalidadServiceImpl;
use Drink\Core\service\impl\ClienteServiceImpl;


use Drink\Core\service\impl\ProductoServiceImpl;

use Drink\Core\service\impl\AnulacionServiceImpl;
use Drink\Core\service\impl\CuentaServiceImpl;
use Drink\Core\service\impl\GastoServiceImpl;

use Drink\Core\service\impl\MovimientoGastoServiceImpl;
use Drink\Core\service\impl\VentaServiceImpl;
use Drink\Core\service\impl\MovimientoVentaServiceImpl;
use Drink\Core\service\impl\MovimientoCajaServiceImpl;
use Drink\Core\service\impl\CuentaCorrienteServiceImpl;
use Drink\Core\service\impl\BancoServiceImpl;
use Drink\Core\service\impl\CajaServiceImpl;
use Drink\Core\service\impl\PagoServiceImpl;
use Drink\Core\service\impl\MovimientoPagoServiceImpl;
use Drink\Core\service\impl\TarjetaServiceImpl;

use Drink\Core\service\impl\ParametroServiceImpl;

use Drink\Core\service\impl\PackServiceImpl;

use Drink\Core\service\impl\PresupuestoServiceImpl;

use Drink\Core\service\impl\ComboServiceImpl;

use Drink\Core\service\impl\ActualizacionServiceImpl;

use Drink\Core\service\impl\MovimientoActualizacionServiceImpl;

use Drink\Core\service\impl\VendedorServiceImpl;

use Drink\Core\service\impl\DetalleVentaServiceImpl;

use Drink\Core\service\impl\DevolucionVentaServiceImpl;

use Drink\Core\service\impl\PedidoServiceImpl;

use Drink\Core\service\impl\ProveedorServiceImpl;

use Drink\Core\service\impl\MovimientoPedidoServiceImpl;

class ServiceFactory {


	
	
	
	
	
	
	/**
	 * Service para Pais.
	 * 
	 * @return IPaisService
	 */
	public static function getPaisService(){
	
		return new PaisServiceImpl();	
	}
	
	/**
	 * Service para MarcaProducto.
	 * 
	 * @return IMarcaProductoService
	 */
	public static function getMarcaProductoService(){
	
		return new MarcaProductoServiceImpl();	
	}
	
	/**
	 * Service para Iva.
	 * 
	 * @return IIvaService
	 */
	public static function getIvaService(){
	
		return new IvaServiceImpl();	
	}
	
	/**
	 * Service para TipoProducto.
	 * 
	 * @return ITipoProductoService
	 */
	public static function getTipoProductoService(){
	
		return new TipoProductoServiceImpl();	
	}
	
	
	
	
	/**
	 * Service para ConceptoGasto.
	 * 
	 * @return IConceptoGastoService
	 */
	public static function getConceptoGastoService(){
	
		return new ConceptoGastoServiceImpl();	
	}
	
	/**
	 * Service para ConceptoMovimiento.
	 * 
	 * @return IConceptoMovimientoService
	 */
	public static function getConceptoMovimientoService(){
	
		return new ConceptoMovimientoServiceImpl();	
	}
	
	
	/**
	 * Service para Provincia.
	 * 
	 * @return IProvinciaService
	 */
	public static function getProvinciaService(){
	
		return new ProvinciaServiceImpl();	
	}
	
	/**
	 * Service para Localidad.
	 * 
	 * @return ILocalidadService
	 */
	public static function getLocalidadService(){
	
		return new LocalidadServiceImpl();	
	}
	
	/**
	 * Service para Cliente.
	 * 
	 * @return IClienteService
	 */
	public static function getClienteService(){
	
		return new ClienteServiceImpl();	
	}
	
	
	
	
	
	
	
	/**
	 * Service para Producto.
	 * 
	 * @return IProductoService
	 */
	public static function getProductoService(){
	
		return new ProductoServiceImpl();	
	}
	
	
	
	/**
	 * Service para Anulacion.
	 * 
	 * @return IAnulacionService
	 */
	public static function getAnulacionService(){
	
		return new AnulacionServiceImpl();	
	}
	
	/**
	 * Service para Cuenta.
	 * 
	 * @return ICuentaService
	 */
	public static function getCuentaService(){
	
		return new CuentaServiceImpl();	
	}
	
	/**
	 * Service para Gasto.
	 * 
	 * @return IGastoService
	 */
	public static function getGastoService(){
	
		return new GastoServiceImpl();	
	}
	
	/**
	 * Service para MovimientoGasto.
	 * 
	 * @return IMovimientoCuentaService
	 */
	public static function getMovimientoGastoService(){
	
		return new MovimientoGastoServiceImpl();	
	}
	
	/**
	 * Service para Venta.
	 * 
	 * @return IMovimientoCuentaService
	 */
	public static function getVentaService(){
	
		return new VentaServiceImpl();	
	}	
	
	/**
	 * Service para MovimientoVenta.
	 * 
	 * @return IMovimientoCuentaService
	 */
	public static function getMovimientoVentaService(){
	
		return new MovimientoVentaServiceImpl();	
	}
	
	/**
	 * Service para MovimientoCaja.
	 * 
	 * @return IMovimientoCuentaService
	 */
	public static function getMovimientoCajaService(){
	
		return new MovimientoCajaServiceImpl();	
	}
	
	/**
	 * Service para CuentaCorriente.
	 * 
	 * @return IMovimientoCuentaService
	 */
	public static function getCuentaCorrienteService(){
	
		return new CuentaCorrienteServiceImpl();	
	}
	
	/**
	 * Service para Banco.
	 * 
	 * @return IMovimientoCuentaService
	 */
	public static function getBancoService(){
	
		return new BancoServiceImpl();	
	}
	
	/**
	 * Service para Caja.
	 * 
	 * @return IMovimientoCuentaService
	 */
	public static function getCajaService(){
	
		return new CajaServiceImpl();	
	}
	
	/**
	 * Service para Pago.
	 * 
	 * @return IMovimientoCuentaService
	 */
	public static function getPagoService(){
	
		return new PagoServiceImpl();	
	}
	
	/**
	 * Service para MovimientoPago.
	 * 
	 * @return IMovimientoPagoService
	 */
	public static function getMovimientoPagoService(){
	
		return new MovimientoPagoServiceImpl();	
	}
	
	/**
	 * Service para Tarjeta.
	 * 
	 * @return ITarjetaService
	 */
	public static function getTarjetaService(){
	
		return new TarjetaServiceImpl();	
	}
	
	
	
	/**
	 * Service para Parametro.
	 * 
	 * @return IParametroService
	 */
	public static function getParametroService(){
	
		return new ParametroServiceImpl();	
	}
	
	/**
	 * Service para Pack.
	 * 
	 * @return IPackService
	 */
	public static function getPackService(){
	
		return new PackServiceImpl();	
	}
	
	/**
	 * Service para Presupuesto.
	 * 
	 * @return IPresupuestoService
	 */
	public static function getPresupuestoService(){
	
		return new PresupuestoServiceImpl();	
	}
	
	/**
	 * Service para Combo.
	 * 
	 * @return IComboService
	 */
	public static function getComboService(){
	
		return new ComboServiceImpl();	
	}
	
	/**
	 * Service para Actualizacion.
	 * 
	 * @return IActualizacionService
	 */
	public static function getActualizacionService(){
	
		return new ActualizacionServiceImpl();	
	}
	
	
	/**
	 * Service para MovimientoActualizacion.
	 * 
	 * @return IMovimientoActualizacionService
	 */
	public static function getMovimientoActualizacionService(){
	
		return new MovimientoActualizacionServiceImpl();	
	}
	
	/**
	 * Service para Vendedor.
	 * 
	 * @return IVendedorService
	 */
	public static function getVendedorService(){
	
		return new VendedorServiceImpl();	
	}
	
	/**
	 * Service para DetalleVenta.
	 * 
	 * @return IDetalleVentaService
	 */
	public static function getDetalleVentaService(){
	
		return new DetalleVentaServiceImpl();	
	}
	
	/**
	 * Service para DevolucionVenta.
	 * 
	 * @return IDevolucionVentaService
	 */
	public static function getDevolucionVentaService(){
	
		return new DevolucionVentaServiceImpl();	
	}
	
	/**
	 * Service para Pedido.
	 * 
	 * @return IPedidoService
	 */
	public static function getPedidoService(){
	
		return new PedidoServiceImpl();	
	}
	
	/**
	 * Service para Proveedor.
	 * 
	 * @return IProveedorService
	 */
	public static function getProveedorService(){
	
		return new ProveedorServiceImpl();	
	}

	/**
	 * Service para MovimientoGasto.
	 * 
	 * @return IMovimientoPedidoService
	 */
	public static function getMovimientoPedidoService(){
	
		return new MovimientoPedidoServiceImpl();	
	}
	
}