<?php

class Assembla_Router {
  protected $_routes;
  
  public function __construct(){
	$this->_routes = new Zend_Config_Json( SERVICE_API_LOADER::getBaseDir() . "Assembla/etc/routes.json" );
  }
  
  protected function _getRoutes(){
	return $this->_routes->routes;
  }


  public function match( Zend_Controller_Request_Http $request ){
	foreach( $this->_getRoutes() AS $_type => $_routes ){	  
	  if( $_type == $request->getMethod() ){		
		foreach( $_routes AS $_uri => $_service ){
		  $regex = $this->_uriAsRegex( $_uri );
		  if( preg_match( $regex, $request->getRequestUri()) ){
			return true;
		  }
		}	
	  }
	}
	return false;
  }


  public function dispatch(Zend_Controller_Request_Http $request){

	foreach( $this->_getRoutes() AS $_type => $_routes ){

	  if( $_type == $request->getMethod() ){
		foreach( $_routes AS $_uri => $_service ){
		  $regex = $this->_uriAsRegex( $_uri );
		  if( preg_match( $regex, $request->getRequestUri()) ){
			if( isset( $_service->controller ) && isset( $_service->action ) ){

			  $_controller = new $_service->controller($request);
			  $_args = $this->_parseUriArgs( $_uri, $request->getRequestUri()  );
			  return $_controller->{$_service->action}( $_args );
			  			  
			} else {
			  throw new Exception( 'Service associated with route: "' . $_uri . '" must have "controller" and "action" set');
			}
		  }
		}
	  }	
	}

	throw new Exception( 'Failed to match service with uri: "' . $uri . "'" );
	 
  }

  
  protected function _parseUriArgs( $route, $request ){
	
	$_array_keys = explode('/', $route );
	$_array_values = explode('/', $request);

	//strip variblaes ( ${} ) from array_keys
	$_array_keys = array_map( function( $key ){ return trim( $key,'${}'); }, $_array_keys );
	$_return_array = array();

	foreach( array_combine($_array_keys, $_array_values) AS $_key => $_value ){
	  if( $_key !== $_value ){
		$_return_array[$_key] = $_value;
	  }
	}
   
	return $_return_array;
  }


  protected function _uriAsRegex($uri){	
	  $uri = preg_replace('/\//', '\/', $uri );
	  $uri = preg_replace('/\$\{([^\$}]+)\}/', '([^\/])+', $uri );
	  return "/^" . $uri . "$/";
  }



  }

?>