<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | Trewo Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />
</head>

<body>

    <div class="container-fluid " style="background-color: #FFFAFA;">
        <div class="row">
            <?php include "header.php"; ?>

            <hr class="mb-2 mt-2">

            <div class="col-12 justify-content-center">
                <div class="row mb-3 mt-2">

                    <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo1" style="height: 90px;"></div>

                    <div class="col-12 col-lg-6 ">

                        <div class="input-group mt-3 mt-lg-5 ms-lg-2 mb-3">
                            <input type="text" class="form-control" placeholder="Search ..." id="basic_search_txt">
                            <button type="button" class=" btn btn-primary" onclick="basicSearch(0);"><i class="bi bi-search"></i></button>
                        </div>

                    </div>

                    <div class="col-6 col-lg-2 mt-3 mt-lg-5 ms-lg-3">
                        <a href="advancedSearch.php" class="btn btn-primary">Advanced &nbsp;<i class="bi bi-search"></i></a>
                    </div>

                    <div class="col-4 col-lg-1 ms-4 mt-3 ms-lg-4 mt-lg-5 cart-icon" style="height: 33px;" onclick="window.location='cart.php'"></div>

                </div>
            </div>

            <hr>

            <div class="row" id="basicSearchResult">
                <div class="col-12 d-none">
                    <div class="row">

                        <!-- carousel -->

                        <!-- <div class="col-12 d-none d-lg-block mb-3">
                            <div class="row">

                                <div id="carouselExampleIndicators" class="carousel slide offset-2 col-8 carousel-fade" data-bs-ride="true">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="resource/carouselImag3.jpg" class="d-block w-100" style="height: 500px;">
                                            <div class="carousel-caption d-none d-md-block" style="margin-bottom: 200px; margin-right: 500px;">
                                                <h2 class="fw-bolder">Welcom To TrewoTech</h2>
                                                <p class="fw-bold">Enjoy the lowest prices and a better shopping experience with us</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="resource/carousel (1).png" class="d-block w-100" style="height: 500px;">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="resource/carousel (2).png" class="d-block w-100" style="height: 500px;">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div> -->

                        <!-- carousel -->

                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <!-- category -->

                        <div class="col-11 col-lg-2 mx-3 my-3 border border-primary rounded" style="height: 550px;">
                            <div class="row">
                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3"><i class="bi bi-list-ul"></i> Categories</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="list-group mb-3">
                                                <a href="mobilePhones.php" class="list-group-item list-group-item-action"><i class="bi bi-phone"></i>&nbsp; Mobile Phones</a>
                                                <a href="laptop&computers.php" class="list-group-item list-group-item-action"><i class="bi bi-laptop"></i>&nbsp; Laptops and computers</a>
                                                <a href="microphones.php" class="list-group-item list-group-item-action"><i class="bi bi-mic"></i>&nbsp; Microphones</a>
                                                <a href="gamingAccessories.php" class="list-group-item list-group-item-action"><i class="bi bi-controller"></i>&nbsp; Gaming Accessories</a>
                                                <a href="batteries.php" class="list-group-item list-group-item-action"><i class="bi bi-battery"></i>&nbsp; Batteries</a>
                                                <a href="heater.php" class="list-group-item list-group-item-action"><i class="bi bi-box2"></i>&nbsp; Heaters</a>
                                                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-thunderbolt"></i>&nbsp; Coolers</a>
                                                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-speaker"></i>&nbsp; Speakers</a>
                                                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-hdd"></i>&nbsp; Video projectors</a>
                                                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-calculator"></i>&nbsp; Calculators</a>
                                                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-headphones"></i>&nbsp; Headphones</a>
                                                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-lamp"></i>&nbsp; Lamps & Bulbs</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- category -->

                        <!-- product -->

                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-white">
                            <div class="row ">
                                <div class="offset-0 col-12 text-center">
                                    <h3 class="col-12 text-warning mt-3">Best Selling products for you</h3>

                                    <div class="row justify-content-center mt-4 px-4">

                                        <?php

                                        require "connection.php";

                                        $invoice_rs = Database::search("SELECT * FROM `invoice` ORDER BY `date` DESC LIMIT 4 OFFSET 0 ");
                                        $invoice_num = $invoice_rs->num_rows;

                                        for ($v = 0; $v < $invoice_num; $v++) {

                                            $invoice_data = $invoice_rs->fetch_assoc();

                                        ?>


                                            <div class="col-12 col-lg-3">
                                                <div class="card mb-2" style="width: 15rem; ">
                                                    <?php
                                                    $p_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $invoice_data["product_id"] . "' ");
                                                    $p_data = $p_rs->fetch_assoc();

                                                    $i_rs = Database::search("SELECT * FROM `image` WHERE `product_id` = '" . $p_data["id"] . "' ");
                                                    $i_data = $i_rs->fetch_assoc();

                                                    if ($i_data != 0) {
                                                    ?>

                                                        <img src="<?php echo $i_data["code"]; ?>" class="card-img-top" alt="..." style="height: 180px;">

                                                    <?php
                                                    } else {
                                                    ?>

                                                        <img src="resource/empty.svg" class="card-img-top" alt="..." style="height: 180px;">

                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="card-body">
                                                        <h5 class="card-title fw-bold"><?php echo $p_data["title"]; ?></h5>
                                                        <span class="card-text fw-bold text-primary">Rs. <?php echo $p_data["price"]; ?> .00</span><br />
                                                        <?php

                                                        if ($p_data["qty"] > 0) {

                                                        ?>
                                                            <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                                            <span class="card-text fw-bold text-success"><?php echo $p_data["qty"]; ?> Items Left</span> <br>
                                                            <a href='<?php echo "singleProductView.php?id=" . $p_data["id"]; ?>' class="col-12 text-decoration-none text-black">See More Details →</a>
                                                            <a href='<?php echo "singleProductView.php?id=" . $p_data["id"]; ?>' class="col-12 btn btn-success mt-2">Buy Now</a>
                                                            <button class="col-12 btn btn-danger mt-2" onclick="addToCart(<?php echo $p_data['id'];  ?>);">Add to Cart</button>

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <span class="card-text text-warning fw-bold">Out of Stock</span> <br />
                                                            <span class="card-text fw-bold text-success">00 Items Left</span> <br>
                                                            <button class="col-12 btn btn-success mt-2 disabled">Buy Now</button>
                                                            <button class="col-12 btn btn-danger mt-2 disabled">Add to Cart</button>

                                                            <?php

                                                        }

                                                        if (isset($_SESSION["u"])) {
                                                            $w_rs = Database::search("SELECT * FROM `wishlist` WHERE `product_id`='" . $p_data["id"] . "' AND `user_email`= '" . $_SESSION["u"]["email"] . "' ");
                                                            $w_num = $w_rs->num_rows;

                                                            if ($w_num == 1) {
                                                            ?>

                                                                <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick='addToWatchlist(<?php echo $p_data["id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $p_data["id"]; ?>'></i>
                                                                </button>

                                                            <?php
                                                            } else {

                                                            ?>
                                                                <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick='addToWatchlist(<?php echo $p_data["id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill text-warning fs-5" id='heart<?php echo $p_data["id"]; ?>'></i>
                                                                </button>

                                                            <?php

                                                            }
                                                        } else {

                                                            ?>

                                                            <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick="msg();">
                                                                <i class="bi bi-heart-fill text-warning fs-5"></i>
                                                            </button>

                                                        <?php

                                                        }

                                                        ?>


                                                    </div>

                                                </div>
                                            </div>


                                        <?php
                                        }
                                        ?>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <?php


                $category_rs = Database::search("SELECT * FROM `category`");
                $category_num  = $category_rs->num_rows;

                for ($y = 0; $y < $category_num; $y++) {

                    $category_data = $category_rs->fetch_assoc();

                ?>

                    <!-- category name -->
                    <div class="col-12 text-center mt-3 mb-2">
                        <a class="text-decoration-none link-dark fs-3 fw-bold"><?php echo $category_data["name"]; ?></a> &nbsp;&nbsp;
                    </div>
                    <!-- category name -->
                    <!-- product -->

                    <div class="col-12 mb-3">
                        <div class="row border border-black-50">

                            <div class="col-12 ">
                                <div class="row justify-content-center gap-4 mx-3">

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $category_data["id"] . "' AND
                            `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 5 OFFSET 0 ");

                                    $product_num = $product_rs->num_rows;

                                    for ($z = 0; $z < $product_num; $z++) {
                                        $product_data = $product_rs->fetch_assoc();

                                    ?>
                                        <div class="card mb-2 mt-2 text-center" style="width: 18rem; ">

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $product_data["id"] . "' ");
                                            $image_data = $image_rs->fetch_assoc();

                                            ?>

                                            <img src="<?php echo $image_data["code"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;">
                                            <div class="card-body">

                                                <h5 class="card-title fw-bold"><?php echo $product_data["title"]; ?>
                                                    <?php

                                                    $tdy = new DateTime();
                                                    $tz = new DateTimeZone("Asia/Colombo");
                                                    $tdy->setTimezone($tz);
                                                    $date = $tdy->format("Y-m-d");

                                                    $added_date = date_create($product_data["datetime_added"]);

                                                    $one_month_in_future = date_add($added_date, date_interval_create_from_date_string("1 month"));

                                                    $d = date_format($one_month_in_future, "Y-m-d");

                                                    if ($d >= $date) {
                                                    ?>
                                                        <span class="badge bg-info"> New</span>
                                                    <?php
                                                    }
                                                    ?>
                                                </h5>
                                                <span class="card-text fw-bold text-primary">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                                                <?php

                                                if ($product_data["qty"] > 0) {

                                                ?>
                                                    <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                                    <span class="card-text fw-bold text-success"><?php echo $product_data["qty"]; ?> Items Left</span> <br>
                                                    <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="col-12 text-decoration-none text-black">See More Details →</a>
                                                    <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="col-12 btn btn-success mt-2">Buy Now</a>
                                                    <button class="col-12 btn btn-danger mt-2" onclick="addToCart(<?php echo $product_data['id'];  ?>);">Add to Cart</button>

                                                <?php

                                                } else {

                                                ?>

                                                    <span class="card-text text-warning fw-bold">Out of Stock</span> <br />
                                                    <span class="card-text fw-bold text-success">00 Items Left</span> <br>
                                                    <button class="col-12 btn btn-success mt-2 disabled">Buy Now</button>
                                                    <button class="col-12 btn btn-danger mt-2 disabled">Add to Cart</button>

                                                    <?php

                                                }

                                                if (isset($_SESSION["u"])) {

                                                    $wishlist_rs = Database::search("SELECT * FROM `wishlist` WHERE `product_id`='" . $product_data["id"] . "' AND `user_email`= '" . $_SESSION["u"]["email"] . "' ");
                                                    $wishlist_num = $wishlist_rs->num_rows;

                                                    if ($wishlist_num == 1) {
                                                    ?>

                                                        <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                            <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $product_data["id"]; ?>'></i>
                                                        </button>

                                                    <?php
                                                    } else {

                                                    ?>
                                                        <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                            <i class="bi bi-heart-fill text-warning fs-5" id='heart<?php echo $product_data["id"]; ?>'></i>
                                                        </button>

                                                    <?php

                                                    }
                                                } else {

                                                    ?>

                                                    <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick="msg();">
                                                        <i class="bi bi-heart-fill text-warning fs-5"></i>
                                                    </button>

                                                <?php

                                                }


                                                ?>

                                            </div>

                                        </div>
                                    <?php
                                    }

                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product -->




                <?php
                }

                ?>

            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>