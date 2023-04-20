<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Scandiweb test assignment - Justyna Miczek</title>
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
                        <input type='submit' value='Mass delete' name='massDelete'>
                        <input type="button" value="Add" onclick="location.href = './add-product.php';">
                    </div>
                    </header>
                </div>
                <?php
                require('getOrDeleteProducts.php');
                $productList = new ProductDB();
                $productList->getData();
                $productList->displayData();

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
                <p class="footer">Scandiweb test assignment - Justyna Miczek</p>
            </div>

        </footer>
    </div>
</body>

</html>