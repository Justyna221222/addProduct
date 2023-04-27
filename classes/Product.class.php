<?php
abstract class Product
{
    private $SKU;
    private $name;
    private $price;
    private $type;
    private $additional;

    protected function setSKU($SKU)
    {
        $this->SKU = $SKU;
    }

    protected function setName($name)
    {
        $this->name = $name;
    }

    protected function setPrice($price)
    {
        $this->price = $price;
    }

    protected function setType($type)
    {
        $this->type = $type;
    }

    protected function setAdditional($additional)
    {
        $this->additional = $additional;
    }

    protected function getSKU()
    {
        return $this->SKU;
    }

    protected function getName()
    {
        return $this->name;
    }

    protected function getPrice()
    {
        return $this->price;
    }

    protected function getType()
    {
        return $this->type;
    }

    protected function getAdditional()
    {
        return $this->additional;
    }

    public function setValue() {
        
    }

    public function insertData()
    {
        $servername = "sql210.epizy.com";
        $username = "epiz_33906668";
        $password = "K0rStDEZVqx";
        $dbname = "epiz_33906668_products";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO MyProducts (SKU, name, price, type, additional)
        VALUES ('" . $this->getSKU() . "','" . $this->getName() . "','" . $this->getPrice() . "','" . $this->getType() . "','" . $this->getAdditional() . "')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('Location: /index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
