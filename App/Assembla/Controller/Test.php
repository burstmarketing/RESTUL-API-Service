<?php

class Assembla_Controller_Test extends Assembla_Controller_Abstract {

  public function __construct() {
	parent::__construct();	
  }


  
  public function testBed($args){   
	
	/*
	$obj = $this->_api->loadShowTicket( array("space_id" => "c1S7xKBKGr34KceJe5cbLr",
											  "ticket_number" => "314" ) );
	var_dump($obj->toXml());
	die();
	*/
	
	ob_start();
	include( dirname(__FILE__) . '/test.phtml' );
	$html = ob_get_contents();
	ob_end_clean();
	return 	$html;
	
  }
  
  }
?>