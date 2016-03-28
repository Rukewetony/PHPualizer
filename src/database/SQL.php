<?php
namespace PHPualizer\Database;


use \PDO;
use \PDOException;

use PHPualizer\Config;

class SQL
{
    private $m_PDO, $m_Table;

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
        $sql_config = Config::getConfigData()['database'];

        if(!isset($this->m_PDO)) {
            try {
                $this->m_PDO = new PDO('mysql:dbname=' . $sql_config["db"] . ';host=' . $sql_config["host"] . ';port=' . $sql_config["port"],
                    $sql_config['user'], $sql_config['password']);
            } catch(PDOException $e) {
                throw new \InvalidArgumentException($e->getMessage());
            }
        }
    }

    public function getDocuments(array $filter): array
    {
        $query = null;
        $q_length = count($filter);
        $index = 0;
        $qs = 'SELECT * FROM ' . $this->m_Table . ' WHERE ';

        foreach($filter as $key => $val) {
            if($index < $q_length && $index > 0)
                $qs .= ' AND ';

            $qs .= $key . '=:' . $key;
            
            $index++;
        }

        $query = $this->m_PDO->prepare($qs);

        foreach($filter as $key => $val) {
            $query->bindValue(":$key", $val);
        }
        
        $query->execute();

        return (array)$query->fetchObject();
    }

    public function insertDocuments(array $documents): array
    {

    }
    
    public function __destruct()
    {
        unset($this->m_PDO);
    }
}