<?php
class ProductValidator
{
    private $productData;
    private $errors = [];
    private static $fields = ['SKU', 'name', 'price'];

    public function __construct($post_productData)
    {
        $this->productData = $post_productData;
    }

    public function validateForm()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->productData)) {
                trigger_error("$field is not present in data");
                return;
            }
        }
        $this->validateSKU();
        $this->validateName();
        $this->validatePrice();
        $this->validateType();
        return $this->errors;
    }

    private function validateSKU()
    {
        $val = trim($this->productData['SKU']);
        if (empty($val)) {
            $this->addError('SKU', ' SKU cannot be empty.');
        } else {
            if (!preg_match('([^\s][A-z0-9À-ž\s]+)', $val)) {
                $this->addError('SKU', ' SKU cannot be longer than 12 chars and alphanumeric.');
            }
        }
    }

    private function validateName()
    {
        $val = trim($this->productData['name']);
        if (empty($val)) {
            $this->addError('name', ' Name cannot be empty.');
        } else {
            if (!preg_match('([^\s][A-z0-9À-ž\s]+)', $val)) {
                $this->addError('name', ' Name cannot be longer than 12 chars and alphanumeric.');
            }
        }
    }

    private function validatePrice()
    {
        $val = trim($this->productData['price']);
        if (empty($val)) {
            $this->addError('price', ' Price cannot be empty.');
        } else {
            if (!is_numeric($val)) {
                $this->addError('price', ' Price should be a floating number.');
            }
        }
    }

    private function validateType()
    {
        $val = trim($this->productData['type']);
        if (empty($val)) {
            $this->addError('type', ' Type cannot be empty.');
        } else {
        $validateType = new $val;
        $error = $validateType->validateProductType();
        if(empty(!$error)){
            $this->addError($error[0], $error[1]);
        }
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
