<?php 

require_once "vendor/autoload.php";

database();

$app = new Klein\Klein();

define('APP_PATH', 'eden/');

$klein = new \Klein\Klein();
$request = \Klein\Request::createFromGlobals();

// Grab the server-passed "REQUEST_URI"
$uri = $request->server()->get('REQUEST_URI');

// Set the request URI to a modified one (without the "subdirectory") in it
$request->server()->set('REQUEST_URI', substr($uri, strlen(APP_PATH)));

//$app->with($base, function() use($app) {
    require_once "app.php";
    require_once "routes.php";  
//});



$app->dispatch($request);