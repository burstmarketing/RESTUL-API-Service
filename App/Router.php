<?php

class Router {
  
  protected $_api_definitions = array();

  protected function _getAPIDefinition( $key ){
	if( empty( $this->_api_definitions ) ){
	  // This should probably be in its own config file or something
	  // for now we'll just hard code it.
	  $this->_api_definitions["assembla"] = array( "controller_class" => "Assembla_Router" );	  
	}
	
	if( array_key_exists( $key, $this->_api_definitions ) ){
	  return $this->_api_definitions[$key];
	} else {
	  throw new Exception('No definition for API: "' . $key . '"!' );
	}
									   
	
  }

  public function dispatch($type, $uri){

	$uri = ltrim( $uri, "/" );	
	$uri_parts = explode('/',$uri);
	$api_key = array_shift($uri_parts);	
	$uri = implode('/', $uri_parts );
	
	if( $_definition = $this->_getAPIDefinition( $api_key ) ){
	  extract( $_definition );
	  if( isset($controller_class) ){
		$_controller = new $controller_class;
		if( $_controller->match( $type, $uri ) ){
		  return $_controller->dispatch( $type, $uri );
		} else {
		  throw new Exception('Service: "' . $uri . '" does not match any defined in: "' . get_class( $_controller ) . '"');
		}
	  }	  
	} else {
	  throw new Exception('Definition for key "' . $key . '" is incomplete!');
	}
	


  }

  }


?>