<?php
class ProductTypeController {
    public function insertProduct(Product $type){
        $type->setValue();
        $type->insertData();
    }
}
