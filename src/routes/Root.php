<?php
namespace PHPualizer\Routes;


use Slim\Http\Request;
use Slim\Http\Response;

class Root
{
    public static function GET(Request $req, Response $res)
    {
        $res->getBody()->write(json_encode([
            'title' => \PHPualizer\Config::getConfigData()['title'],
            'version' => \PHPualizer\Config::getVersion()
        ]));

        return $res;
    }
}