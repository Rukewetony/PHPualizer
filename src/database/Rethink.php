<?php
namespace PHPualizer\Database;


use \r;

use PHPualizer\Config;

class Rethink
{
    private $m_Connection, $m_Table;

    public function getTable(): string
    {
        return $this->m_Table;
    }

    public function setTable(string $table)
    {
        $this->m_Table = $table;
    }

    public function __construct()
    {
        $r_config = Config::getConfigData()['database'];

        if(!isset($this->m_Connection)) {
            $this->m_Connection = r\connect($r_config);

            if(!$this->createDatabaseIfNotExists($r_config['db']))
                throw new \InvalidArgumentException;
        }
    }

    public function getDocuments(array $filter): array
    {
        return r\table($this->m_Table)->filter($filter)->run($this->m_Connection);
    }

    public function insertDocuments(array $documents): array
    {
        return r\table($this->m_Table)->update($documents)->run($this->m_Connection);
    }

    private function createDatabaseIfNotExists(string $dbName): bool
    {
        if(!r\dbList()->contains($dbName)->run($this->m_Connection)) {
            if(r\dbCreate($dbName)->run($this->m_Connection)['dbs_created'] == 1)
                return true;
            else
                return false;
        } else {
            return true;
        }
    }

    public function __destruct()
    {
        unset($this->m_Connection);
    }
}