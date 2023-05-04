<?php
class Clothes extends Product
{

    public function setValue()
    {
        $this->setSKU($_POST['SKU']);
        $this->setName($_POST['name']);
        $this->setPrice($_POST['price']);
        $this->setType($_POST['type']);
        $this->setAdditional("Size: " . $_POST['size']);
    }
    public function validateProductType()
    {
        $size = trim($_POST['size']);
        if (empty($size)) {
            $error = ['size', ' Size cannot be empty.'];
        } else {
            if (!is_numeric($size)) {
                $error = ['size', ' Size must be a number.'];
            }
        }
        return $error;
    }
}
