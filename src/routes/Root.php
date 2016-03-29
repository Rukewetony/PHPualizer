<?php
namespace PHPualizer\Routes;


use Slim\Http\Request;
use Slim\Http\Response;

class Root
{
    public static function GET(Request $req, Response $res)
    {
        $db = new \PHPualizer\Database\Driver;
        $db = $db->getDriver();
        $db->setTable('users_test');

        $res->getBody()->write($db->updateDocuments(['username' => 'test', 'password' => 'tester'], ['username' => 'wargog']));

//        $res->getBody()->write(json_encode([
//            'title' => \PHPualizer\Config::getConfigData()['title'],
//            'version' => \PHPualizer\Config::getVersion()
//        ]));

        return $res;
    }
}