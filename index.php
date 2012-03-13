<?php


if (!isset($_SERVER['PHP_AUTH_USER'])) {
  header('WWW-Authenticate: Basic realm="My Realm"');
  header('HTTP/1.0 401 Unauthorized');
  exit;
} 




if( file_exists('constaints.php') ){
  include_once('constaints.php');
 }
include_once('App/Autoload.php');
include_once('lib/Autoload.php');

$router = new Router();
echo $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'] );

?>