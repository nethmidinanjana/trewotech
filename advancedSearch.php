<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | Trewo Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />
</head>

<body>

    <div class="container-fluid" style="background-color: #FFFAFA;">
        <div class="row">

            <?php include "header.php"; ?>

            <hr class="mt-3 mb-3">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row mt-2 ">
                        <div class="col-12 ">
                            <div class="row">
                                <div class="col-12 col-lg-1 offset-lg-2 ">
                                    <div class="ms-lg-2 logo1 " style="height: 70px;"></div>
                                </div>

                                <div class="col-12 col-lg-5 offset-lg-1 ">
                                    <label class="form-label fs-2 text-black-50 fw-bold mt-2 pt-2 ms-5">Advanced Search</label>
                                </div>

                                <div class="col-4 col-lg-1 ms-5 mt-2 ms-lg-3 mt-lg-3 cart-icon " style="height: 33px;" onclick="window.location='cart.php';"></div>
                                <a class="ol-4 col-lg-1 ms-5 mt-2 ms-lg-3 mt-lg-3 btn btn-outline-secondary" style="width: 80px; height:40px;" href="home.php"><i class="bi bi-house-door-fill"></i></a>
                            </div>

                            <hr class="mt-3 mb-3">

                            <div class="offset-lg-1 col-12 col-lg-8  rounded mb-2 ">
                                <div class="row ">
                                    <div class="offset-lg-1 col-12 col-lg-12">
                                        <div class="row border border-1 rounded ">
                                            <div class="input-group mb-3 mt-3">
                                                <input type="text" class="form-control" placeholder="Type a keyword to search..." id="t">
                                                <button class="btn btn-primary" type="button" onclick="advancedSearch(0);">Search</button>
                                            </div>
                                            <div class="col-12 col-lg-4 mt-3">
                                                <div class="dropdown">
                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="c1" onclick="advancedSearch(0);">
                                                            <option value="0">Select Category</option>

                                                            <?php

                                                            require "connection.php";
                                                            $category_rs = Database::search("SELECT * FROM `category`");
                                                            $category_num = $category_rs->num_rows;

                                                            for ($x = 0; $x < $category_num; $x++) {
                                                                $category_data = $category_rs->fetch_assoc();

                                                            ?>
                                                                <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                                            <?php

                                                            }

                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-lg-4 mt-3">
                                                <div class="dropdown">
                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="m" onclick="advancedSearch(0);">
                                                            <option value="0">Select Model</option>

                                                            <?php
                                                            $model_rs = Database::search("SELECT * FROM `model`");
                                                            $cmodel_num = $model_rs->num_rows;

                                                            for ($x = 0; $x < $category_num; $x++) {
                                                                $model_data = $model_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4 mt-3">
                                                <div class="dropdown">
                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="b" onclick="advancedSearch(0);">
                                                            <option value="0">Select Brand</option>

                                                            <?php
                                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                                            $brand_num = $brand_rs->num_rows;

                                                            for ($x = 0; $x < $brand_num; $x++) {
                                                                $brand_data = $brand_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6 mt-3">
                                                <div class="dropdown">
                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="c2" onclick="advancedSearch(0);">
                                                            <option value="0">Select Condition</option>

                                                            <?php
                                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                                            $condition_num = $condition_rs->num_rows;

                                                            for ($x = 0; $x < $condition_num; $x++) {
                                                                $condition_data = $condition_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $condition_data["id"]; ?>"><?php echo $condition_data["name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <div class="dropdown">
                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="c3" onclick="advancedSearch(0);">
                                                            <option value="0">Select Colour</option>

                                                            <?php
                                                            $colour_rs = Database::search("SELECT * FROM `colour`");
                                                            $colour_num = $colour_rs->num_rows;

                                                            for ($x = 0; $x < $colour_num; $x++) {
                                                                $colour_data = $colour_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $colour_data["id"]; ?>"><?php echo $colour_data["name"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <input type="text" class="col-12 form-control" placeholder="Price From..." id="pf" onclick="advancedSearch(0);">
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <input type="text" class="col-12 form-control" placeholder="Price To..." id="pt" onclick="advancedSearch(0);">
                                            </div>
                                            <div class="offset-lg-2 col-12 col-lg-8 rounded mb-2 mt-4">
                                                <div class="row">
                                                    <div class="offset-4 col-8 offset-lg-9 col-lg-6 mt-2 mb-2 ">
                                                        <select class="form-select border border-primary shadow-none" id="s" onclick="advancedSearch(0);">
                                                            <option value="0">SORT BY</option>
                                                            <option value="1">PRICE HIGH TO LOW</option>
                                                            <option value="2">PRICE LOW TO HIGH</option>
                                                            <option value="3">QUANTITY HIGH TO LOW</option>
                                                            <option value="4">QUANTITY LOW TO HIGH</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-3 mb-3 col-12 border border-primary">

                                            <label class="form-label fs-4 fw-bolder text-center mb-3"><i class="bi bi-search"></i>&nbsp; Search Results...</label>

                                            <div class="mb-3 col-12">
                                                <div class="row">
                                                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                                                        <div class="row" id="view_area">
                                                            <div class="offset-5 col-2 mt-5">
                                                                <span class="fw-bold text-black-50"><i class="bi bi-search" style="font-size: 100px;"></i></span>
                                                            </div>
                                                            <div class="offset-3 col-6 mt-3 mb-5">
                                                                <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>