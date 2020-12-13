<?php
namespace Drink\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Pack
 *  
 * @author Marcos
 *
 */
class PackCriteria extends Criteria{

	private $codigo;
	private $codigoExacto;
	private $fechaDesde;
	private $fechaHasta;
	private $nombre;
	private $producto;
	private $nombreOTipoOMarca;

	

	

	public function getCodigo()
	{
	    return $this->codigo;
	}

	public function setCodigo($codigo)
	{
	    $this->codigo = $codigo;
	}

	public function getCodigoExacto()
	{
	    return $this->codigoExacto;
	}

	public function setCodigoExacto($codigoExacto)
	{
	    $this->codigoExacto = $codigoExacto;
	}

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getProducto()
	{
	    return $this->producto;
	}

	public function setProducto($producto)
	{
	    $this->producto = $producto;
	}

	public function getNombreOTipoOMarca()
	{
	    return $this->nombreOTipoOMarca;
	}

	public function setNombreOTipoOMarca($nombreOTipoOMarca)
	{
	    $this->nombreOTipoOMarca = $nombreOTipoOMarca;
	}
}