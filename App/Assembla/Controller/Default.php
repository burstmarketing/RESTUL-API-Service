<?php

class Assembla_Controller_Default extends Assembla_Controller_Abstract {
  
  protected $_api;

  protected function _uc_words($str, $destSep='_', $srcSep='_')
  {
    return str_replace(' ', $destSep, ucwords(str_replace($srcSep, ' ', $str)));
  }

  protected function _camelize($name)
  {
	return $this->_uc_words($name, '');
  }

  public function __call($method, $args){
	if( ($service = $this->_api->getService($method) ) !== null ){
	  $method = "load" . $this->_camelize($method);
	  if( isset( $args[0] ) && is_array($args[0] ) ){
		return $this->_api->$method( $args[0] )->toJSON();
	  } else {
		return $this->_api->$method()->toJSON();
	  }	  
	} else {
	  throw new Exception( 'Service: ' . $method . ' is not defined in the api config!' ); 
	}
  }
  
  }
?>