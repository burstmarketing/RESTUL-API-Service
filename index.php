<?php



if( file_exists('constaints.php') ){
  include_once('constaints.php');
 }
include_once('App/Autoload.php');
include_once('lib/Autoload.php');


$request = new Zend_Controller_Request_Http();
$response = new Zend_Controller_Response_Http();
                
$router = new Router();

$response->setBody( $router->dispatch( $request ) );
$response->sendResponse();


?>