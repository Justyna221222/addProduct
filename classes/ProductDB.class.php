<?php
class ProductDB extends DB
{
    private $products = array();

    function getData()
    {

        $sql = "SELECT SKU, name, price, additional FROM AddProductDB ORDER BY SKU";
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
            echo "<input type='checkbox' class='delete-checkbox' name='delete[]' value='" . $product['SKU'] . "'>";
            echo "<div class='item'><p>" . $product['SKU'] . "</p><p>" . $product['name'] . "</p><p>" . $product['price'] . " $ </p><p>" . $product['additional'] . "</p></div>";
            echo "</div>";
        }
        echo "</div>";
    }
}
