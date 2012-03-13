<?php

final class SERVICE_API_LOADER {

  const DIRECTORY_SEPARATOR = "/";

  public static function getBaseDir(){
	return dirname(__FILE__) . self::DIRECTORY_SEPARATOR;
  }

  public static function autoload($classname){
	$classFile = self::getBaseDir() . str_replace('_',self::DIRECTORY_SEPARATOR, $classname) . ".php";	
	if( is_readable( $classFile ) && ! class_exists($classname) ):
	  include_once( $classFile );
	endif;
  }

}
spl_autoload_register( "SERVICE_API_LOADER::autoload" );

?>