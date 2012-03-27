<?php

class Assembla_Controller_Abstract {

  protected $_request;

  public function getRequest(){
	return $this->_request;
  }

  public function __construct(){

	if (!isset($_SERVER['PHP_AUTH_USER'])) {
	  $response = new Zend_Controller_Response_Http();
	  $response->setHeader('WWW_Authenticate', "Basic realm='Assembla JSON API'" )
		->setHttpResponseCode(401)
		->sendResponse();
	  exit;
	} 

	$a = func_get_args();
	if( count($a) && $a[0] instanceof Zend_Controller_Request_Abstract ){
	  $this->_request = $a[0];
	}

	$this->_api = new Assembla_API;
	$this->_api->loadConfig( 'Assembla/etc/config.json' );
	if( isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) ){
	  $this->_api->setUserName($_SERVER['PHP_AUTH_USER'])->setPassword($_SERVER['PHP_AUTH_PW']);
	} else {
	  throw new Exception('PHP_AUTH_USER or PHP_AUTH_PW are not set in $_SERVER');
	}
  }

  }
?>