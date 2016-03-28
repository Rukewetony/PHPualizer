<?php
namespace PHPualizer;


use Slim\Http\Request;
use Slim\Http\Response;

class Routes
{
    private $app;
    
    public function __construct()
    {
        $this->app = new \Slim\App;
    }
    
    public function startRouter()
    {
        $this->app->get('/', function(Request $req, Response $res) { Routes\Root::GET($req, $res); });
        $this->app->get('/update', function(Request $req, Response $res) { Routes\Update::GET($req, $res); });

        $this->app->run();
    }
    
    public function __destruct()
    {
        unset($this->app);
    }
}