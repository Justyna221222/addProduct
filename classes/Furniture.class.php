<?php
class Furniture extends Product
{
    public function setValue()
    {
        $this->setSKU($_POST['SKU']);
        $this->setName($_POST['name']);
        $this->setPrice($_POST['price']);
        $this->setType($_POST['type']);
        $this->setAdditional("Dimensions: " . $_POST['height'] . "x" . $_POST['width'] . "x" . $_POST['length']);
    }
    public function validateProductType()
    {
            $height = trim($_POST['height']);
            $width = trim($_POST['width']);
            $length = trim($_POST['length']);
            if (empty($height) || empty($width) || empty($length)) {
                $error = ['dimensions', ' Dimensions cannot be empty.' ];
            } else {
                if (!is_numeric($height) || !is_numeric($width) || !is_numeric($length) ) {
                        $error = ['dimensions', ' Dimensions must be a number.' ];
                }
            }
            return $error;
    }
}
