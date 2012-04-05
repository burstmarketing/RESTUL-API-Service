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

  protected function _processGet($service, $method, $args){
	$method = "load" . $this->_camelize($method);
	if( isset( $args[0] ) && is_array($args[0] ) ){
	  return $this->_api->$method( $args[0] )->toJSON();
	} else {
	  return $this->_api->$method()->toJSON();
	}	
  }

  protected function _processPut( $service, $method, $args ){
	if( count($this->getRequest()->getPut()) ){
	  if( isset($service['classname'] ) ){

		$object = new $service['classname']();
		$object->setData( Core_API_XML_Helper::underscoreToHyphenKeys($this->getRequest()->getParams()) );

		$xml = $object->toXml();
		
		$method = "load" . $this->_camelize($method);
		if( isset( $args[0] ) && is_array($args[0] ) ){
		  return $this->_api->$method( $args[0], $xml)->toJSON();
		} else {
		  return $this->_api->$method( array(), $xml)->toJSON();
		}	
		
		return '';
	  }
	}
  }


  public function __call($method, $args){
	if( ($service = $this->_api->getService($method) ) !== null ){
	  switch( $service['type'] ){
	  case 'GET':
		return $this->_processGet( $service, $method, $args );
		break;
	  case 'PUT':
		return $this->_processPut( $service, $method, $args );
		break;
		
	  }
	} else {
	  throw new Exception( 'Service: ' . $method . ' is not defined in the api config!' ); 
	}
  }
  
  }
?>