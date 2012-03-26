<?php

class Assembla_Controller_Test extends Assembla_Controller_Abstract {

  public function __construct() {
	//override Abstract constructor - we don't need an api object in this controller
  }
  
  public function testBed($args){   
	return 	file_get_contents( dirname(__FILE__) . '/test.phtml' );
  }
  
  }
?>