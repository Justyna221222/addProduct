<?php
ini_set('display_errors', 1);
spl_autoload_register('classAutoLoader');

function classAutoLoader($className)
{
    $path = "classes/";
    $extension = ".class.php";
    $fullPath = $path . $className . $extension;

    include_once $fullPath;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Add Product - Justyna Miczek</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
    <link rel="stylesheet" href="./css/productList.css" type="text/css" />
</head>

<body>
    <div class="container">
        <div class="product_list">
            <form method="POST" action="">
                <div class="header">
                    <h1>Product list</h1>
                    <div>
                        <input type='submit' value='MASS DELETE' name='massDelete'>
                        <input type="button" value="ADD" onclick="location.href = './add-product.php';">
                    </div>
                    </header>
                </div>
                <?php
                $productList = new ProductDB();
                $productList->getData(); // get products data from MySQL Database
                $productList->displayData(); // display data on screen

                if (isset($_POST['massDelete'])) {
                    $productsToDelete = new DeleteProduct;
                    $productsToDelete->deleteItems();
                }
                ?>
            </form>
        </div>
        <footer>
            <div class="footer_container">
                <hr />
                <p class="footer">Justyna Miczek</p>
            </div>

        </footer>
    </div>
</body>

</html>