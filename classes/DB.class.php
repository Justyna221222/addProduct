<?php
class DB
{
    private $servername = "sql210.epizy.com";
    private $username = "epiz_33906668";
    private $password = "K0rStDEZVqx";
    private $dbname = "epiz_33906668_products";

    protected function connect()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
