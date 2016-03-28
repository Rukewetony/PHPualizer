<?php
namespace PHPualizer\Database;


class Driver
{
    private $m_Driver;

    public function __construct()
    {
        switch(\PHPualizer\Config::getConfigData()['database']['driver']) {
            case 'mysql':
                $this->m_Driver = new SQL;
                break;
            case 'rethinkdb':
                $this->m_Driver = new Rethink;
                break;
            default:
                throw new \InvalidArgumentException('Database driver type unknown');
                break;
        }
    }

    public function getDriver()
    {
        return $this->m_Driver;
    }
}