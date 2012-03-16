<?php
class Assembla_Controller_Custom extends Assembla_Controller_Abstract {

  public function getConfig(){
	return file_get_contents( RESTFUL_API_LOADER::getBaseDir() . "/Assembla/etc/config.json");
  }
  
  }


?>