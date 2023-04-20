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
            if ($val === 'DVD') {
                $size = trim($this->productData['size']);
                if (empty($size)) {
                    $this->addError('size', ' Size cannot be empty.');
                } else {
                    if (!is_numeric($size)) {
                        $this->addError('size', ' Size must be a number.');
                    }
                }
            }
            if ($val === 'Furniture') {
                $height = trim($this->productData['height']);
                $width = trim($this->productData['width']);
                $length = trim($this->productData['length']);
                if (empty($height) || empty($width) || empty($length)) {
                    $this->addError('dimensions', ' Dimensions cannot be empty.');
                } else {
                    if (!is_numeric($height) || !is_numeric($width) || !is_numeric($length)) {
                        $this->addError('dimensions', ' Dimenstions must be a number.');
                    }
                }
            }
            if ($val === 'Book') {
                $weight = trim($this->productData['weight']);
                if (empty($weight)) {
                    $this->addError('weight', ' Weight cannot be empty.');
                } else {
                    if (!is_numeric($weight)) {
                        $this->addError('weight', ' Weight must be a number.');
                    }
                }
            }
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
?>

<?php
class DVD extends Product
{
    private $size;

    public function setSize($size)
    {
        $this->size = $size;
        $this->setAdditional("Size: " . $size);
    }

    public function getSize()
    {
        return $this->size;
    }
}

class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    public function setHeight($height)
    {
        $this->height = $height;
        $this->setAdditional($height);
    }
    public function setDimensions($height, $width, $length)
    {
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
        $this->setAdditional("Dimensions: " . $height . "x" . $width . "x" . $length);
    }
}

class Book extends Product
{
    private $weight;

    public function setWeight($weight)
    {
        $this->weight = $weight;
        $this->setAdditional("Weight: " . $weight);
    }
}

abstract class Product
{
    private $SKU;
    private $name;
    private $price;
    private $type;
    private $additional;

    public function setSKU($SKU)
    {
        $this->SKU = $SKU;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setAdditional($additional)
    {
        $this->additional = $additional;
    }

    public function getSKU()
    {
        return $this->SKU;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getprice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getAdditional()
    {
        return $this->additional;
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

?>