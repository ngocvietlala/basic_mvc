<?php


class Model
{
    private $dbServer;
    private $dbDatabase;
    private $dbUserName;
    private $dbPassword;

    protected $conn;

    public function __construct()
    {
        $this->dbServer = constant('DB_HOST');
        $this->dbDatabase= constant('DB_DATABASE');
        $this->dbUserName = constant('DB_USERNAME');
        $this->dbPassword = constant('DB_PASSWORD');
    }

    public function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->dbServer;dbname=$this->dbDatabase", $this->dbUserName, $this->dbPassword);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            $this->conn = null;
            echo "Connection failed: " . $e->getMessage();
            die;
        }

        return $this->conn;
    }
}