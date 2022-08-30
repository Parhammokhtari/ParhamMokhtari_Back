<?php

namespace CRUD_Sample\Helper;



use \MySQLi;

class DBConnector
{

    /** @var mixed $db */
    private $db;

    /** @var mixed $host */
    private $host;


    /** @var mixed $host */
    private $port;

    /** @var mixed $username */
    private $username;

    /** @var mixed $password */
    private $password;

    /** @var mixed $dbConnection */
    private $dbConnection;

    public function __construct()
    {
        $this->db = "crud";
        $this->username = "root";
        $this->password = "";
        $this->host = "localhost";
    }

    /**
     * @throws \Exception
     * @return void
     */
    public function connect(): void
    {

        $this->dbConnection = new mysqli($this->host, $this->username, $this->password, $this->db);

        if ($this->dbConnection->connect_error) {
            $this->exceptionHandler("Connection failed: " . $this->dbConnection->connect_error);
        }
    }

    /**
     * @param string $query
     */
    public function execQuery(string $query)
    {
        return $this->dbConnection->query($query);
    }

    /**
     * @param string $message
     * @throws \Exception
     * @return void
     */
    private function exceptionHandler(string $message): void
    {
        throw new \Exception($message);
    }
}
