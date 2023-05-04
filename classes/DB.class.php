<?php
class DB
{
    private $servername = "sql204.epizy.com";
    private $username = "epiz_34136278";
    private $password = "2hwMlgcYfU41M";
    private $dbname = "epiz_34136278_addProductDB";

    protected function connect()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
