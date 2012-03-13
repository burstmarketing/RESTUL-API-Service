<?php

class Assembla_Controller_Test extends Assembla_Controller_Abstract {

  public function __construct() {
	//override Abstract constructor - we don't need an api object in this controller
  }
  
  public function testBed($args){
	return '<html><head><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script></head><body></body></html>';
  }
  
  }
?>