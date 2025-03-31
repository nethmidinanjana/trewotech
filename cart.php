<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | Trewo Tech</title>

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

            require "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;

            ?>

                <hr class="mt-2">

                <div class="col-12 justify-content-center">
                    <div class="row mb-3 ">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-1 offset-lg-2">
                                    <div class="ms-lg-2 logo1 " style="height: 70px;"></div>
                                </div>

                                <div class="col-12 col-lg-5 offset-lg-1">

                                    <div class="input-group mt-3 mt-lg-3 ms-lg-2 mb-3">
                                        <input type="text" class="form-control" placeholder="Search in cart..." id="cartSearchTxt">
                                        <button type="button" class=" btn btn-primary" onclick="cartSearch();"><i class="bi bi-search"></i></button>
                                    </div>

                                </div>

                                <div class="col-4 col-lg-1 ms-4 mt-2 ms-lg-3 mt-lg-3 cart-icon " style="height: 33px;"></div>

                            </div>

                            <hr class="mt-3">

                            <!-- content -->
                            <div class="row align-items-start">
                                <div class="col-12 col-lg-7 mb-3">
                                    <div class="row col-12 bg-white mt-4 offset-lg-1">
                                        <div class="col-12 ms-2">
                                            <div class="col-12 mt-3">
                                                <h2 class="fw-bold text-warning">Shopping Cart &nbsp;&nbsp;<i class="bi bi-cart2 fs-1 text-success fw-bold"></i></h2>
                                            </div>

                                        </div>
                                        <hr class="mt-4">

                                        <?php

                                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "' ");
                                        $cart_num = $cart_rs->num_rows;

                                        if ($cart_num == 0) {

                                        ?>
                                            <!-- Empty view -->

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 emptyCart"></div>
                                                    <div class="col-12 text-center mb-2">
                                                        <label class="form-label fs-1 fw-bold">
                                                            You have no items in your cart yet.
                                                        </label>
                                                    </div>
                                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                        <a class="btn btn-warning fs-3 fw-bold" href="home.php">Start Shopping</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Empty view -->

                                        <?php

                                        } else {

                                        ?>

                                            <div class=" mb-3 col-12 mx-0 mx-lg-2 " id="cartSearchResult">
                                                <div class="row g-0">

                                                    <?php

                                                    for ($x = 0; $x < $cart_num; $x++) {
                                                        $cart_data = $cart_rs->fetch_assoc();

                                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();

                                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                                        $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN `city` ON 
                                                        user_has_address.city_id = city.id INNER JOIN `district` ON city.district_id = district.id WHERE `user_email`='" . $email . "' ");

                                                        $address_data = $address_rs->fetch_assoc();

                                                        $ship = 0;

                                                        if ($address_data["did"] == 5) {
                                                            $ship = $product_data["delivery_fee_colombo"];
                                                            $shipping = $shipping + $ship;
                                                        } else {
                                                            $ship = $product_data["delivery_fee_other"];
                                                            $shipping = $shipping + $ship;
                                                        }


                                                    ?>

                                                        <div class="col-lg-3">
                                                            <?php

                                                            $img_rs = Database::search("SELECT `code` FROM `image` WHERE  `product_id` ='" . $cart_data["product_id"] . "' ");
                                                            $img_data = $img_rs->fetch_assoc();

                                                            ?>

                                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?> " title="Product Details">
                                                                <img src="<?php echo $img_data["code"]; ?>" class="img-fluid rounded-start" style="height: 200px; width:170px;">
                                                            </span>

                                                        </div>
                                                        <div class="col-lg-9">
                                                            <div class="card-body">

                                                                <?php

                                                                $color_rs = Database::search("SELECT `name` FROM `colour` INNER JOIN `product` ON product.colour_id = colour.id WHERE  product.id ='" . $cart_data["product_id"] . "' ");
                                                                $color_data = $color_rs->fetch_assoc();

                                                                ?>

                                                                <span class="card-title mt-2 fw-bold fs-5 text-success"><?php echo $product_data["title"]; ?></span><br>
                                                                <label class="form-label text-black-50 mt-2">Colour : </label>
                                                                <label class="form-label fw-bold"><?php echo $color_data["name"]; ?></label><br>
                                                                <label class="form-label text-black-50">Price :</label>
                                                                <label class="form-label fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</label><br>
                                                                <label class="form-label text-black-50">Delivery Fee :</label>
                                                                <label class="form-label fw-bold">Rs. <?php echo $ship; ?> .00</label><br>
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-2">
                                                                        <label class="form-label text-black-50 mt-2">Quantity :</label>
                                                                    </div>
                                                                    <div class="col-12 col-lg-5">
                                                                        <input type="number" value="<?php echo $product_data["qty"]; ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="row gap-3 ms-1">
                                                                    <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="col-12 col-lg-4 btn btn-success mt-3">Buy Now</a>
                                                                    <button class="col-12 col-lg-4 btn btn-danger mt-3" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove from cart</button>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-11 mt-4 mb-3">
                                                            <div class="row">
                                                                <div class="col-6 col-md-6">
                                                                    <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                                </div>
                                                                <div class="col-6 col-md-6 text-end">
                                                                    <span class="fw-bold fs-5 text-black-50">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="mt-3 mb-3">
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

                                <div class="col-12 col-lg-3 offset-lg-1">
                                    <div class="row mb-3 ">
                                        <div class="col-12 bg-white mt-4 ">
                                            <div class="row col-12">
                                                <h3 class="ms-3 fw-bold mt-2">Summary</h3>
                                                <div class="col-6 mt-4">
                                                    <span class=" ms-4" id="qty">Items (<?php echo $cart_num; ?>)</span>
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <span class="fs-5">Rs. <?php echo $total; ?> .00</span>
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <span class=" ms-4">Delivery fee</span>
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <span class="fs-5">Rs. <?php echo $shipping; ?> .00</span>
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <span class=" ms-4">Total</span>
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <span class="fs-5">Rs. <?php echo ($shipping + $total) ?> .00</span>
                                                </div>
                                                <div class="col-12 mt-5 ms-lg-4 mb-3">
                                                    <button type="button" class="btn btn-danger rounded-pill" style="width: 300px;" onclick="checkout();">Check Out</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 bg-white mt-4 ">
                                            <div class="row col-12 ms-4">
                                                <h5 class="mt-3 mb-1 text-black-50 ms-4">Payment Methods</h5>
                                                <div class="row row-cols-1 row-cols-md-3 g-3">
                                                    <div class="col-6 col-lg-6">
                                                        <img src="resource/visa_img.png" class="card-img-top" style="height: 90px; width:90px;">
                                                    </div>
                                                    <div class="col-6 col-lg-6">
                                                        <img src="resource/mastercard_img.png" class="card-img-top" style="height: 90px; width:90px;">
                                                    </div>
                                                    <div class="col-6 col-lg-6">
                                                        <img src="resource/paypal_img.png" class="card-img-top" style="height: 90px; width:90px;">
                                                    </div>
                                                    <div class="col-6 col-lg-6">
                                                        <img src="resource/american_express_img.png" class="card-img-top" style="height: 90px; width:90px;">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- content -->

                        </div>
                    </div>
                </div>

            <?php

            } else {
                echo ("Please Sign In or Register");
            }

            include "footer.php";

            ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

</body>

</html>