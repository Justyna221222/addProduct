<?php
include_once 'db.php';
class ProductDB extends DB
{
    private $products = array();

    function getData()
    {

        $sql = "SELECT SKU, name, price, additional FROM MyProducts ORDER BY SKU";
        $result = $this->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $this->products[] = $row;
        }
    }
    function displayData()
    {
        echo "<hr/>";
        echo "<div class='product_container'>";
        foreach ($this->products as $product) {
            echo "<div class='product_box'>";
            echo "<input type='checkbox' name='delete[]' value='" . $product['SKU'] . "'>";
            echo "<div class='item'><p>" . $product['SKU'] . "</p><p>" . $product['name'] . "</p><p>" . $product['price'] . " $ </p><p>" . $product['additional'] . "</p></div>";
            echo "</div>";
        }
        echo "</div>";
    }
}

class DeleteProduct extends DB
{

    public function deleteItems()
    {
        if (isset($_POST['delete'])) {
            $itemsToDelete = $_POST['delete'];
            foreach ($itemsToDelete as $deleteid) {
                $deleteProduct = "DELETE FROM `MyProducts` WHERE `MyProducts`.`SKU` = '$deleteid'";
                mysqli_query($this->connect(), $deleteProduct);
            }
            header("Refresh:0");
            $itemsToDelete = [];
        }
    }
}
