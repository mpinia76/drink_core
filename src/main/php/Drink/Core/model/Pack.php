<?php

namespace Drink\Core\model;

use Cose\model\impl\Entity;

use Cose\Security\model\User;

use Cose\utils\Logger;

/**
 * Pack
 * 
 
 * 
 * @Entity @Table(name="drink_pack")
 * 
 * @author Marcos
 * @since 26-03-2019
 */

class Pack extends Entity{

	//variables de instancia.

	
	
	/**
     * @ManyToOne(targetEntity="Producto",cascade={"merge"})
     * @JoinColumn(name="producto_oid", referencedColumnName="oid")
     * @var Producto
     **/
	private $producto;
	
	/**
	 * @Column(type="float", nullable=true)
	 * 
	 */
	private $precioLista;
	
	/**
	 * @Column(type="float", nullable=true)
	 * 
	 */
	private $precioEfectivo;
	
	/**
	 * @Column(type="decimal", precision=10, scale=2, nullable=true)
	 * 
	 */
	private $costo;
	
	/**
	 * @Column(type="float", nullable=true)
	 * 
	 */
	private $porcentajeGanancia;
	
	/**
	 * @Column(type="float", nullable=true)
	 * 
	 */
	private $porcentajeGanancia2;
	
	/**
	 * @Column(type="integer")
	 * @var integer
	 */
	private $cantidad;
	
	/**
	 * @Column(type="datetime")
	 * @var \Datetime
	 */
	private $fecha;
	
	/**
	 * @Column(type="string", length=50)
	 * 
	 */
	private $codigo;
	
	 /**
	 * @Column(type="string", length=50)
	 */
	private $nombre;
	
    
	public function __construct(){
		$this->descuento = 0;
	}
	
	

	public function __toString(){
		 return $this->getNombre().' '.$this->getProducto();
	}


	
	
	public function getPrecioUnitario()
	{
	    return $this->getPrecioLista() / $this->getCantidad() ;
	}
	

	public function getProducto()
	{
	    return $this->producto;
	}

	public function setProducto($producto)
	{
	    $this->producto = $producto;
	}

	

	public function getCantidad()
	{
	    return $this->cantidad;
	}

	public function setCantidad($cantidad)
	{
	    $this->cantidad = $cantidad;
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getCodigo()
	{
	    return $this->codigo;
	}

	public function setCodigo($codigo)
	{
	    $this->codigo = $codigo;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getPrecioLista()
	{
	    return $this->precioLista;
	}

	public function setPrecioLista($precioLista)
	{
	    $this->precioLista = $precioLista;
	}

	public function getPrecioEfectivo()
	{
	    return $this->precioEfectivo;
	}

	public function setPrecioEfectivo($precioEfectivo)
	{
	    $this->precioEfectivo = $precioEfectivo;
	}

	public function getCosto()
	{
	    return $this->costo;
	}

	public function setCosto($costo)
	{
	    $this->costo = $costo;
	}

	public function getPorcentajeGanancia()
	{
	    return $this->porcentajeGanancia;
	}

	public function setPorcentajeGanancia($porcentajeGanancia)
	{
	    $this->porcentajeGanancia = $porcentajeGanancia;
	}

	public function getPorcentajeGanancia2()
	{
	    return $this->porcentajeGanancia2;
	}

	public function setPorcentajeGanancia2($porcentajeGanancia2)
	{
	    $this->porcentajeGanancia2 = $porcentajeGanancia2;
	}
}
?>