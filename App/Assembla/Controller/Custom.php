<?php
class Assembla_Controller_Custom extends Assembla_Controller_Abstract {

  public function getConfig(){
	return file_get_contents( RESTFUL_API_LOADER::getBaseDir() . "/Assembla/etc/config.json");
  }

  public function getActiveTickets(){
	$_spaces = $this->_api->loadMySpacesList();
	foreach( $_spaces AS $_space ){
	  $_space->setActiveTickets( $this->_api->loadTicketReport( array( "report_id" => 8, 
																	   "space_id" => $_space->getId())) );
	}

	return $_spaces->toJSON();
	
  }
  
  }


?>