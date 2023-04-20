<?php
require('process.php');
if (isset($_POST['submit'])) {
    $validation = new ProductValidator($_POST);
    $errors = $validation->validateForm();
    if (empty($errors)) {
        $type = $_POST['type'];
        if ($type === 'DVD') {
            $newProduct = new DVD($_POST);
            $newProduct->setSKU($_POST['SKU']);
            $newProduct->setName($_POST['name']);
            $newProduct->setPrice($_POST['price']);
            $newProduct->setType($_POST['type']);
            $newProduct->setSize($_POST['size']);
        }
        if ($type === 'Furniture') {
            $newProduct = new Furniture($_POST);
            $newProduct->setSKU($_POST['SKU']);
            $newProduct->setName($_POST['name']);
            $newProduct->setPrice($_POST['price']);
            $newProduct->setType($_POST['type']);
            $newProduct->setDimensions($_POST['height'], $_POST['width'], $_POST['length']);
        }
        if ($type === 'Book') {
            $newProduct = new Book($_POST);
            $newProduct->setSKU($_POST['SKU']);
            $newProduct->setName($_POST['name']);
            $newProduct->setPrice($_POST['price']);
            $newProduct->setType($_POST['type']);
            $newProduct->setWeight($_POST['weight']);
        }
        $newProduct->insertData();
    }
}
if (isset($_POST['cancel'])) {
    if (isset($_POST['cancel'])) {
        $_POST['SKU'] = $_POST['name'] = $_POST['price'] = $_POST['type'] = $_POST['size'] = $_POST['height'] = $_POST['width'] = $_POST['length'] = $_POST['weight'] = '';
        header('Location: /index.php');
    }
}
?>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
    <link rel="stylesheet" href="./css/addProduct.css" type="text/css" />
</head>

<body>
    <div id="app">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="product_form">
            <div class="container">
                <div class="header">
                    <h1>Product Add</h1>
                    <div>
                        <input type="submit" name="submit" value="Submit">
                        <input type="submit" name="cancel" value="Cancel">
                    </div>
                </div>
                <hr />
                <div>
                    <label to="sku">SKU:</label><input type="text" name="SKU" id="sku" v-model="product.SKU" @blur="validateSKU" value="<?php echo htmlspecialchars($_POST['SKU']) ?? '' ?>">
                    <div class="error">{{ errors.SKU }}</div>
                </div><br>
                <div>
                    <label to="name">Name: </label><input type="text" name="name" id="name" v-model="product.name" @blur="validateName" value="<?php echo htmlspecialchars($_POST['name']) ?? '' ?>">
                    <span class="error">{{ errors.name }}</span>
                </div><br>
                <div>
                    <label to="price">Price($): </label><input type="number" step="0.01" name="price" id="price" v-model="product.price" @blur="validatePrice" value="<?php echo htmlspecialchars($_POST['price']) ?? '' ?>">
                    <span class="error"> {{ errors.price }} </span>
                </div><br>
                <div>Type Switcher:
                    <select id="productType" name="type" v-model="product.type" @click="validateType" value="<?php echo htmlspecialchars($_POST['type']) ?? '' ?>">
                        <option v-for="option in options">{{option}}</option>
                    </select>
                    <span class="error">{{ errors.type }}</span>
                </div>
                <div>
                    <div v-if="product.type === 'DVD'" class="additional_info_container">
                        <div><label to="size">Size(MB)</label>
                            <input type="number" id="size" name="size" v-model="product.size" @blur="validateSize" value="<?php echo htmlspecialchars($_POST['size']) ?? '' ?>" />
                            <div class="error additional">{{ errors.size }}</div>
                        </div><br />
                        <div>Please, provide size in MB.</div>
                    </div>
                    <div v-if="product.type === 'Furniture'" class="additional_info_container">
                        <div><label to="height">Height(CM)</label><input type="number" id="height" name="height" v-model="product.height" @blur="validateDimensions" value="<?php echo htmlspecialchars($_POST['height']) ?? '' ?>" /></div><br />
                        <div><label to="width">Width(CM)</label><input type="number" id="width" name="width" v-model="product.width" @blur="validateDimensions" value="<?php echo htmlspecialchars($_POST['width']) ?? '' ?>" /></div><br />
                        <div><label to="length">Length(CM)</label><input type="number" id="length" name="length" v-model="product.length" @blur="validateDimensions" value="<?php echo htmlspecialchars($_POST['length']) ?? '' ?>" /></div><br />
                        <span class="error additional"><?php echo $dimensionsError; ?>{{ errors.dimensions }}</span><br />
                        <div>Please, provide dimenstions in cm.</div>
                    </div>
                    <div v-if="product.type === 'Book'" class="additional_info_container">
                        <div><label to="weight">Weight(KG)</label><input type="number" name="weight" id="weight" v-model="product.weight" @blur="validateWeight" value="<?php echo htmlspecialchars($_POST['weight']) ?? '' ?>" /><span class="error additional"> {{ errors.weight }}</span></div><br />
                        <div>Please, provide weight in kg.</div>
                    </div>
                </div>

            </div>
        </form>
        <footer>
            <div class="footer_container">
                <hr />
                <p class="footer">Scandiweb test assignment - Justyna Miczek</p>
            </div>
        </footer>
    </div>
    <script>
        new Vue({
            el: "#app",
            data: {
                product: {
                    SKU: '<?php echo htmlspecialchars($_POST['SKU']) ?? '' ?>',
                    name: '<?php echo htmlspecialchars($_POST['name']) ?? '' ?>',
                    price: '<?php echo htmlspecialchars($_POST['price']) ?? '' ?>',
                    type: '<?php echo htmlspecialchars($_POST['type']) ?? '' ?>',
                    size: '<?php echo htmlspecialchars($_POST['size']) ?? '' ?>',
                    height: '<?php echo htmlspecialchars($_POST['height']) ?? '' ?>',
                    width: '<?php echo htmlspecialchars($_POST['width']) ?? '' ?>',
                    length: '<?php echo htmlspecialchars($_POST['length']) ?? '' ?>',
                    weight: '<?php echo htmlspecialchars($_POST['weight']) ?? '' ?>'
                },
                errors: {
                    SKU: '<?php echo htmlspecialchars($errors['SKU']) ?? '' ?>',
                    name: '<?php echo htmlspecialchars($errors['name']) ?? '' ?>',
                    price: '<?php echo htmlspecialchars($errors['price']) ?? '' ?>',
                    type: '<?php echo htmlspecialchars($errors['type']) ?? '' ?>',
                    size: '<?php echo htmlspecialchars($errors['size']) ?? '' ?>',
                    height: '<?php echo htmlspecialchars($errors['height']) ?? '' ?>',
                    dimensions: '<?php echo htmlspecialchars($errors['dimensions']) ?? '' ?>',
                    weight: '<?php echo htmlspecialchars($errors['weight']) ?? '' ?>'
                },
                options: [
                    'DVD',
                    'Furniture',
                    'Book'
                ],
            },
            methods: {
                validateSKU() {
                    if (this.product.SKU === '') {
                        this.errors.SKU = 'SKU cannot be empty.';
                    } else {
                        this.errors.SKU = '';
                    }
                },
                validateName() {
                    if (this.product.name === '') {
                        this.errors.name = ' Name cannot be empty.';
                    } else {
                        this.errors.name = '';
                    }
                },
                validatePrice() {
                    if (this.product.price === '') {
                        this.errors.price = ' Price cannot be empty.';
                    } else if (isNaN(this.product.price)) {
                        this.errors.price = ' Price should be a number.';
                    } else {
                        this.errors.price = '';
                    }
                },
                validateType() {
                    if (this.product.type === '') {
                        this.errors.type = ' Type cannot be empty';
                    } else {
                        this.errors.type = '';
                    }
                },
                validateSize() {
                    if (this.product.size === '') {
                        this.errors.size = ' Size cannot be empty.';
                    } else if (isNaN(this.product.size)) {
                        this.errors.size = ' Size should be a number.';
                    } else {
                        this.errors.size = '';
                    }
                },
                validateDimensions() {
                    let height = this.product.height;
                    let width = this.product.width;
                    let length = this.product.length;
                    if (height === '' || width === '' || length === '') {
                        this.errors.dimensions = ' Dimensions cannot be empty.';
                    } else if (isNaN(height) || isNaN(width) || isNaN(length)) {
                        this.errors.dimensions = ' Dimensions should be a number.';
                    } else {
                        this.errors.dimensions = ''
                    }
                },
                validateWeight() {
                    if (this.product.weight === '') {
                        this.errors.weight = ' Weight cannot be empty.';
                    } else if (isNaN(this.product.weight)) {
                        this.errors.weight = ' Weight should be a number';
                    } else {
                        this.errors.weight = '';
                    }
                }
            }
        });
    </script>
</body>

</html>