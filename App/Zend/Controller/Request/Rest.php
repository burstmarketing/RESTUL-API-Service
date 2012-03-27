<?php

class  Zend_Controller_Request_Rest extends Zend_Controller_Request_Http 
{
  protected $_paramSources = array('_GET', '_POST', '_PUT');
  protected $_PUT = array();
  

  public function getPut(){
	return $this->_PUT;
  }

  public function __construct(){
	if( isset( $_SERVER['REQUEST_METHOD'] ) ){
	  switch( $_SERVER['REQUEST_METHOD'] ){
	  case 'PUT':
		parse_str(file_get_contents("php://input"), $this->_PUT);
		break;
	  }
	}
  }


  /**
   * Retrieve a parameter
   *
   * Retrieves a parameter from the instance. Priority is in the order of
   * userland parameters (see {@link setParam()}), $_GET, $_POST. If a
   * parameter matching the $key is not found, null is returned.
   *
   * If the $key is an alias, the actual key aliased will be used.
   *
   * @param mixed $key
   * @param mixed $default Default value to use if key not found
   * @return mixed
   */
  public function getParam($key, $default = null)
  {
	$keyName = (null !== ($alias = $this->getAlias($key))) ? $alias : $key;
	
	$paramSources = $this->getParamSources();
	if (isset($this->_params[$keyName])) {
	  return $this->_params[$keyName];
	} elseif (in_array('_GET', $paramSources) && (isset($_GET[$keyName]))) {
	  return $_GET[$keyName];
	} elseif (in_array('_POST', $paramSources) && (isset($_POST[$keyName]))) {
	  return $_POST[$keyName];
	} elseif (in_array('_PUT', $paramSources) && (isset($this->_PUT[$keyName]))) {
	  return $this->_PUT[$keyName];
	}
	
	return $default;
  }
  
  
  
  /**
   * Retrieve an array of parameters
   *
   * Retrieves a merged array of parameters, with precedence of userland
   * params (see {@link setParam()}), $_GET, $_POST (i.e., values in the
   * userland params will take precedence over all others).
   *
   * @return array
   */
  public function getParams()
  {
	$return       = $this->_params;
	$paramSources = $this->getParamSources();
	if (in_array('_GET', $paramSources)
		&& isset($_GET)
		&& is_array($_GET)
        ) {
	  $return += $_GET;
	}
	if (in_array('_POST', $paramSources)
		&& isset($_POST)
		&& is_array($_POST)
        ) {
	  $return += $_POST;
	}
	if (in_array('_PUT', $paramSources)
		&& isset($this->_PUT)
		&& is_array($this->_PUT)
        ) {
	  $return += $this->_PUT;
	}
	return $return;
  }
  
      public function __get($key)
    {
        switch (true) {
            case isset($this->_params[$key]):
                return $this->_params[$key];
            case isset($_GET[$key]):
                return $_GET[$key];
            case isset($_POST[$key]):
                return $_POST[$key];
            case isset($this->_PUT[$key]):
                return $this->_PUT[$key];
            case isset($_COOKIE[$key]):
                return $_COOKIE[$key];
            case ($key == 'REQUEST_URI'):
                return $this->getRequestUri();
            case ($key == 'PATH_INFO'):
                return $this->getPathInfo();
            case isset($_SERVER[$key]):
                return $_SERVER[$key];
            case isset($_ENV[$key]):
                return $_ENV[$key];
            default:
                return null;
        }
    }

  
} 
?>