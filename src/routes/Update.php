<?php
namespace PHPualizer\Routes;


use Slim\Http\Request;
use Slim\Http\Response;

class Update
{
    public static function GET(Request $req, Response $res)
    {
        $current_version = \PHPualizer\Config::getVersion();
        $latest_version = file_get_contents('https://raw.githubusercontent.com/Wargog/PHPualizer/master/VERSION');
        $needs_update = version_compare($current_version, $latest_version, '<');

        $res->getBody()->write(json_encode([
            'currentVersion' => $current_version,
            'latestVersion' => $latest_version,
            'needsUpdate' => $needs_update
        ]));

        return $res;
    }
}