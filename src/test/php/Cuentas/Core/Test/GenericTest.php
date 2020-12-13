<?php

namespace Drink\Core\Test;



use Cose\utils\Logger;
use Drink\Core\conf\DrinkConfig;
use Cose\persistence\PersistenceContext;

class GenericTest extends \PHPUnit_Framework_TestCase{
	
	/**
	 * 
	 * @var \Cose\persistence\PersistenceContext
	 */
	protected $persistenceContext;
	
	protected function setUp() {

		//inicializamos cuentas core.
		DrinkConfig::getInstance()->initialize();
		DrinkConfig::getInstance()->initLogger(dirname(__DIR__) . "/Test/conf/log4php.xml");
				
		$this->persistenceContext =  PersistenceContext::getInstance();
		
	}
	
	protected function tearDown() {

		$this->log("successful!", __CLASS__);
		
        //cerramos la conexión a la base.
        $this->persistenceContext->close();
    }
    
    protected function log($msg, $clazz=__CLASS__){
    	Logger::log($msg, $clazz);
    }
    
}
?>