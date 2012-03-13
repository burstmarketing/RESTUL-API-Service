<?php

include_once('App/Autoload.php');
include_once('lib/Autoload.php');

/*
$foo = 'spaces/${space_id}/milestones/${milestone_id}';

$foo = preg_replace('/\$\{([^\$}]+)\}/', '.*', $foo );
$foo = preg_replace('/\//', '\/', $foo );
var_dump($foo);

var_dump(preg_match( "/" .$foo."/", "spaces/dMxouCDXyr4ie4eJe5cbLr/milestones/390612"));
*/


$router = new Router();
echo $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'] );


/*
$api = new Assembla_API;
$api->loadConfig( 'Assembla/etc/config.json' );
$api->setUserName('ckotfila')->setPassword('t7Aru7uw');



$foo = $api->loadShowMilestone( "dMxouCDXyr4ie4eJe5cbLr","390612" );

$foo[] = $api->loadTicketReport( "dMxouCDXyr4ie4eJe5cbLr","0" );
$foo = $api->loadTicketReport( "dMxouCDXyr4ie4eJe5cbLr","0" );
$foo[]=  $api->loadMySpacesList();


$foo = $api->loadListOfMilestones( "dMxouCDXyr4ie4eJe5cbLr" );
var_dump($foo);
echo $foo->toJSON();

die();



var_dump($foo);
*/






?>