<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.10.2015
 * Time: 16:56
 */
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/sourse/components/Autoload.php');
require_once(ROOT.'/sourse/components/Router.php');

$router=new Router();
$router->run();