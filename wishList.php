<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Wish List | Trewo Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />
</head>

<body>

    <div class="container-fluid" style="background-color: #FFFAFA;">
        <div class="row">

            <?php

            include "header.php";
            if (isset($_SESSION["u"])) {

            ?>

                <hr class="mt-2">

                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-2">
                        <div class="ms-lg-2 logo1 " style="height: 70px;"></div>
                    </div>

                    <div class="col-12 col-lg-5 offset-lg-1">

                        <div class="input-group mt-3 mt-lg-3 ms-lg-2 mb-3">
                            <input type="text" class="form-control" placeholder="Search in wish list..." id="txt">
                            <button type="button" class=" btn btn-primary"><i class="bi bi-search" onclick="searchWishlist();"></i></button>
                        </div>

                    </div>

                </div>

                <hr class="mt-3">

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="row ms-lg-2">

                                <div class="col-12 col-lg-2 bg-white border border-1 rounded">
                                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item mt-3 ms-3"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active mt-3 ms-3" aria-current="page">Wish list</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column ">
                                        <a class="nav-link active mt-2 " aria-current="page">Wish List</a>
                                        <a class="nav-link text-black-50 fw-bold" href="cart.php">My Cart</a>
                                        <a class="nav-link text-black-50 fw-bold" href="myProfile.php">My Account</a>
                                        <a class="nav-link text-black-50 fw-bold" href="#">Returns and orders</a>
                                        <a class="nav-link text-warning fw-bold" href="purchasedHistory.php">Purchased History</a>

                                    </nav>
                                </div>
                                <div class="col-12 col-lg-9 bg-white border border-1 rounded ms-lg-2">
                                    <label class="form-label fs-3 fw-bold text-danger text-center ms-2 mt-3">Wish List &hearts;</label>
                                    <div class=" mb-3 mx-0 mx-lg-2 col-12">
                                        <div class="row g-0">

                                            <?php

                                            require "connection.php";

                                            $user = $_SESSION["u"]["email"];

                                            $wishlist_rs = Database::search("SELECT * FROM `wishlist` WHERE `user_email`='" . $user . "'");
                                            $wishlist_num = $wishlist_rs->num_rows;

                                            if ($wishlist_num == 0) {

                                            ?>

                                                <!-- empty view-->
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 emptyView"></div>
                                                        <div class="col-12 text-center mt-3">
                                                            <label class="form-label fs-1 fw-bold">You have no items in your Wish list yet.</label>
                                                        </div>
                                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                            <a href="home.php" class="btn btn-info fs-3 fw-bold">Start Shopping</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- empty view-->

                                            <?php
                                            } else {
                                            ?>

                                                <div class="col-12" id="searchResults">
                                                    <div class="row">

                                                        <?php

                                                        for ($x = 0; $x < $wishlist_num; $x++) {
                                                            $wishlist_data = $wishlist_rs->fetch_assoc();


                                                        ?>

                                                            <div class="col-md-3">

                                                                <?php

                                                                $img = array();

                                                                $images_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $wishlist_data["product_id"] . "'");
                                                                $images_data = $images_rs->fetch_assoc();

                                                                ?>

                                                                <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-start" style="height: 250px; width:200px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">

                                                                    <?php

                                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $wishlist_data["product_id"] . "'");
                                                                    $product_data = $product_rs->fetch_assoc();

                                                                    ?>

                                                                    <h5 class="card-title text-success fs-5 fw-bold"><?php echo $product_data["title"]; ?></h5>
                                                                    <p class="card-text mt-2"><?php echo $product_data["description"]; ?></p>
                                                                    <label class="form-label text-black-50">Colour : </label>
                                                                    <?php

                                                                    $clr_rs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $product_data["colour_id"] . "'");
                                                                    $clr_data = $clr_rs->fetch_assoc();

                                                                    ?>
                                                                    <label class="form-label fw-bold"><?php echo $clr_data["name"]; ?></label><br>
                                                                    <label class="form-label text-black-50">Price :</label>
                                                                    <label class="form-label fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</label><br>
                                                                    <label class="form-label text-black-50">Quantity :</label>
                                                                    <label class="form-label fw-bold"><?php echo $product_data["qty"]; ?></label><br>
                                                                    <label class="form-label text-black-50">Condition :</label>
                                                                    <?php

                                                                    $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "'");
                                                                    $condition_data = $condition_rs->fetch_assoc();

                                                                    ?>
                                                                    <label class="form-label fw-bold"><?php echo $condition_data["name"]; ?></label><br>

                                                                    <div class="row gap-2">
                                                                        <a class="col-12 col-lg-3 btn btn-success mt-3 mx-1" href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>'>Buy Now</a>
                                                                        <button class="col-12 col-lg-3 btn btn-warning mt-3 mx-1" onclick="addToCart(<?php echo $product_data['id'];  ?>);">Add to cart</button>
                                                                        <button class="col-12 col-lg-3 btn btn-danger mt-3 mx-1" onclick='removeFromWatchlist(<?php echo $wishlist_data["id"]; ?>);'>Remove</button>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="col-12 mt-3 mb-3 mx-1">
                                                                <hr>
                                                            </div>

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

                                <hr class="mt-3 mb-3">

                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {
            ?>
                <hr>
                <div class="col-12 div1 bg-body">
                    <div class="d-flex flex-column align-items-center">
                        <img class="mt-2 mb-4" src="resource/emptywishlist.jpg" style="height: 290px; width: 330px;">
                        <span class="fw-bold text-warning fs-4">Please Sign In to see the watchlist</span>
                        <a href="index.php" class="btn btn-secondary mt-3 btn-lg">Sign In or Register</a>
                    </div>
                </div>

            <?php
            }

            include "footer.php";

            ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>