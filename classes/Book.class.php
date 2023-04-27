<?php
class Book extends Product
{
    public function setValue()
    {
        $this->setSKU($_POST['SKU']);
        $this->setName($_POST['name']);
        $this->setPrice($_POST['price']);
        $this->setType($_POST['type']);
        $this->setAdditional("Weight: " . $_POST['weight'] . " KG");
    }
    public function validateProductType()
    {
        $weight = trim($_POST['weight']);
        if (empty($weight)) {
            $error = ['weight', ' Weight cannot be empty.'];
        } else {
            if (!is_numeric($weight)) {
                $error = ['weight', ' Weight must be a number.'];
            }
        }
        return $error;
    }
}
