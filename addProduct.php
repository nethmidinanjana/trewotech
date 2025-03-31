<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />

    <title>Add Product | Trewo Tech</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php

            include "header.php";

            if (isset($_SESSION["u"])) {


            ?>

                <hr class="mt-2">
                <div class="col-12">
                    <div class="row">

                        <div class="col-12 text-center ">
                            <h1 class="text-primary fw-bold">Add New Product</h1>
                        </div>

                        <div class="col-12 border border-1 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-2">
                                    <div class="col-12 text-center mt-3 ms-2">
                                        <label class="form-label fw-bold text-success" style="font-size: 20px;">Add Product Images</label>
                                    </div>
                                    <div class="col-12 order-2 order-lg-1 mt-3">
                                        <ul>

                                            <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                <img src="resource/addprdctimg.png" class="img-thumbnail mt-1 mb-1" id="i0" />
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                <img src="resource/addprdctimg.png" class="img-thumbnail mt-1 mb-1" id="i1" />
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                <img src="resource/addprdctimg.png" class="img-thumbnail mt-1 mb-1" id="i2" />
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-11 offset-1 d-grid mt-3">
                                        <input type="file" class="d-none" id="imageuploader" multiple />
                                        <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10">
                                    <div class="row mt-5">
                                        <div class="col-12 col-lg-4 mt-2">
                                            <select class="form-select text-center" id="category" onchange="loadBrands();">
                                                <option value="0">Select Category</option>
                                                <?php

                                                require "connection.php";

                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num  = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();

                                                ?>
                                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                                <?php

                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4 mt-2">
                                            <select class="form-select text-center" id="brand" onchange="loadModels();">
                                                <option value="0">Select Brand</option>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($y = 0; $y < $brand_num; $y++) {

                                                    $brand_data = $brand_rs->fetch_assoc();

                                                ?>
                                                    <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-4 mt-2">
                                            <select class="form-select text-center" id="model">
                                                <option value="0">Select Model</option>

                                                <?php

                                                $model_rs = Database::search("SELECT * FROM `model`");
                                                $model_num = $model_rs->num_rows;

                                                for ($z = 0; $z < $model_num; $z++) {

                                                    $model_data = $model_rs->fetch_assoc();

                                                ?>
                                                    <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <div class="row mt-4">
                                            <div class="col-12 col-lg-3 text-center">
                                                <label class="form-label fs-5 fw-bold">Add Title to your product</label>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <input type="text" class="form-control" placeholder="Add a title..." id="title">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <div class="row mt-4">
                                            <div class="col-12 col-lg-6 border-end border-3">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fs-5 fw-bold">Add product colour</label>
                                                </div>
                                                <div class="col-12 ">
                                                    <select class="form-select" id="clr">
                                                        <option value="0">Select Colour</option>

                                                        <?php

                                                        $clr_rs = Database::search("SELECT * FROM `colour`");
                                                        $clr_num = $clr_rs->num_rows;

                                                        for ($x = 0; $x < $clr_num; $x++) {

                                                            $clr_data = $clr_rs->fetch_assoc();

                                                        ?>
                                                            <option value="<?php echo $clr_data["id"]; ?>"><?php echo $clr_data["name"]; ?></option>
                                                        <?php
                                                        }

                                                        ?>

                                                    </select>
                                                </div>
                                                <div class="input-group mb-3 mt-3">
                                                    <input type="text" class="form-control" placeholder="Add a colour..." id="clr_input"/>
                                                    <button class="btn btn-outline-secondary" type="button" id="btn_clr" onclick="addclr();"><i class="bi bi-plus-lg"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 ">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fs-5 fw-bold">Select Product Condition</label>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <select class="form-select" id="condition">
                                                        <option value="1">Brandnew</option>
                                                        <option value="2">Used</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <div class="row mt-4">
                                            <div class="col-12 col-lg-6 border-end border-3">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fs-5 fw-bold">Add Product Quantity</label>
                                                </div>
                                                <div class="input-group mb-3 mt-3">
                                                    <input type="number" class="form-control" value="0" id="qty">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 ">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fs-5 fw-bold">Add Product Price</label>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="price">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <div class="row mt-4">
                                            <div class="col-12 col-lg-6 border-end border-3">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fs-5 fw-bold">Add Delivery cost withing Colombo</label>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="dwc">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 ">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fs-5 fw-bold">Add Delivery cost out of Colombo</label>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="doc">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <div class="col-12 ms-4">
                                            <label class="form-label fs-5 fw-bold">Add Product Description</label>
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control" cols="30" rows="10" id="desc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-4">
                                    <div class="col-12 col-lg-6 mt-4 mb-3">
                                        <div class="alert alert-danger" role="alert">
                                            <span class="fs-4 fw-bold">NOTICE &nbsp; <i class="bi bi-chat-square-text fs-4 fw-bold"></i></span><br>
                                            <span>We are taking 5% of the product from price from every
                                                product as a service charge.</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="col-12 col-lg-9 d-grid offset-lg-3 mt-5">
                                            <button class="btn btn-success" onclick="addProduct();">Save Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            <?php

            } else {
                header("Location:home.php");
            }

            ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>