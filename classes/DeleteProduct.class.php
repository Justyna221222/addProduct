<?php
class DeleteProduct extends DB
{

    public function deleteItems()
    {
        if (isset($_POST['delete'])) {
            $itemsToDelete = $_POST['delete'];
            foreach ($itemsToDelete as $deleteid) {
                $deleteProduct = "DELETE FROM `AddProductDB` WHERE `AddProductDB`.`SKU` = '$deleteid'";
                mysqli_query($this->connect(), $deleteProduct);
            }
            header("Refresh:0");
            $itemsToDelete = [];
        }
    }
}
