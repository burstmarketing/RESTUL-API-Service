<?php

class Assembla_Controller_Abstract {

  public function __construct(){

	if (!isset($_SERVER['PHP_AUTH_USER'])) {
	  header('WWW-Authenticate: Basic realm="My Realm"');
	  header('HTTP/1.0 401 Unauthorized');
	  exit;
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