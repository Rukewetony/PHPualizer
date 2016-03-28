<?php
foreach(explode(',', $_SERVER['HTTP_ACCEPT']) as $accept)
{
    if($accept == 'text/html') {
        header('Location: ./panel');
        exit();
    }
}

require_once 'vendor/autoload.php';

date_default_timezone_set(\PHPualizer\Config::getConfigData()['timezone']);

$router = new \PHPualizer\Routes;
$router->startRouter();