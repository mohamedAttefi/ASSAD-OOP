<?php
class DbConnection
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $port;

    public function __construct($host, $db, $user, $pass, $port = 3306)
    {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;
    }

    public function connectDB()
    {

        $conn = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db};", $this->user, $this->pass);
        if ($conn) {
            echo "success";
        }
        return $conn;
    }
}