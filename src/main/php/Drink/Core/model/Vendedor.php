<?php

namespace Drink\Core\model;

use Cose\model\impl\Entity;

use Cose\Security\model\User;

use Cose\utils\Logger;

/**
 * Vendedor
 * 
 
 * 
 * @Entity @Table(name="drink_vendedor")
 * 
 * @author Marcos
 * @since 21-07-2020
 */

class Vendedor extends Entity{

	//variables de instancia.

	
	
	
	
	/**
	 * @Column(type="float", nullable=true)
	 * 
	 */
	private $comision;
	
	
	
	
	
	
	
	
	
	 /**
	 * @Column(type="string", length=50)
	 */
	private $nombre;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $mail;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $telefono;
	
	
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $direccion;
	
	/** @Column(type="boolean") **/
	private $mayorista;
    
	public function __construct(){
		
	}
	
	public function __toString(){
		 return $this->getNombre();
	}




	
	
	

	
	

	public function getComision()
	{
	    return $this->comision;
	}

	public function setComision($comision)
	{
	    $this->comision = $comision;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getMail()
	{
	    return $this->mail;
	}

	public function setMail($mail)
	{
	    $this->mail = $mail;
	}

	public function getTelefono()
	{
	    return $this->telefono;
	}

	public function setTelefono($telefono)
	{
	    $this->telefono = $telefono;
	}

	public function getDireccion()
	{
	    return $this->direccion;
	}

	public function setDireccion($direccion)
	{
	    $this->direccion = $direccion;
	}

	public function getMayorista()
	{
	    return $this->mayorista;
	}

	public function setMayorista($mayorista)
	{
	    $this->mayorista = $mayorista;
	}
}
?>