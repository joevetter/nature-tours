<?php

require_once(__DIR__ . "/../bootstrap/start.php");
#Dotenv::load(__DIR__ . "/../bootstrap/");
$dotenv = new Dotenv\Dotenv(__DIR__ . "/../bootstrap/");
$dotenv->load();
require_once(__DIR__ . "/../bootstrap/db.php");
require_once(__DIR__ . "/../bootstrap/routes.php");

$match = $router->match();

# routes calling methods
list($controller, $method) = explode("@", $match['target']);

if(is_callable(array($controller, $method)))
{
  $object = new $controller();
  call_user_func_array(array($object, $method), array($match['params']));
} else {
  echo "Cannot find $controller -> $method";
  exit();
}
