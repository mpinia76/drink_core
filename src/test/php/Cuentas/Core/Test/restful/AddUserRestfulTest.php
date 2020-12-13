<?php

namespace Drink\Core\Test\sucursales;

use Drink\Core\criteria\TareaCriteria;


include_once dirname(__DIR__). '/conf/init.php';

use Drink\Core\Test\GenericTest;
use Cose\Security\Restful\service\ServiceFactory;

use Cose\Security\service\SecurityContext;
use Cose\Security\Restful\exception\UserRestfulNotFoundException;
use Cose\Security\Restful\exception\UserRestfulExpiredException;

use Cose\Security\Restful\model\UserRestful;

class AddUserRestulTest extends GenericTest{
	
	/**
	 */
	public function test(){

		
		$securityContext =  SecurityContext::getInstance();
		$securityContext->login( "bernardo", "bernardo");
		
		$service = ServiceFactory::getUserRestfulService();
		
		$this->log("add user restfull", __CLASS__);
		
		try {

			$u = new UserRestful();
			$u->setUserOid(1);
			
			$service->add( $u );

			$this->log("User: " . $u->getUserId(), __CLASS__);
			
		} catch (Exception $e) {
			$this->log( $e->getMessage(), __CLASS__);
		} catch (\Exception $e) {
			$this->log( $e->getMessage(), __CLASS__);
		}
					
		
		
			
		
	}
}
?>