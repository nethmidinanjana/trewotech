<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.category_id,product.colour_id,product.brand_has_model_id,
    product.price,product.qty,product.description,product.title,product.user_email,product.condition_id,
    product.status_id,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    model.name AS mname,brand.name AS bname FROM `product` INNER JOIN `brand_has_model` ON 
    brand_has_model.id=product.brand_has_model_id INNER JOIN `brand` ON brand.id=brand_has_model.brand_id INNER JOIN
    `model` ON model.id=brand_has_model.model_id WHERE product.id='" . $pid . "' ");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();


?>


        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Single product View | Trewo Tech</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resource/logo.png" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php include "header.php"; ?>

                    <hr class=" mt-2">

                    <div class="col-12 justify-content-center">
                        <div class="row mb-3">

                            <div class="offset-4 ms-lg-2 col-4 col-lg-1 logo1 " style="height: 70px;"></div>

                            <span class="col-lg-3 text-center text-black ms-lg-5 mt-lg-2 mt-2 ">Trewo Tech Collection <br>
                                <i class="bi bi-award-fill text-warning fs-5"></i> Top Selling Products</span>



                            <div class="col-12 col-lg-5 offset-lg-0">

                                <div class="input-group mt-3 mt-lg-3 ms-lg-2 mb-3">
                                    <input type="text" class="form-control" placeholder="I'm searching for..." id="singleProductViewSrchTxt">
                                    <button class="btn btn-secondary" type="button">In this brand</button>
                                    <button type="button" class=" btn btn-primary" onclick="searchBrand();"><i class="bi bi-search"></i></button>
                                </div>

                            </div>

                            <div class="col-4 col-lg-1 ms-4 mt-2 ms-lg-3 mt-lg-3 cart-icon" style="height: 33px;" onclick="window.location='cart.php' "></div>

                            <button type="button" class="btn btn-danger position-relative col-lg-1 mt-lg-3 mt-2 ms-5 col-6 " style="height: 35px; width: 70px;">
                                follow
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    +
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>

                        </div>
                    </div>

                    <hr>

                    <!-- content -->

                    <div class="col-12 ">
                        <div class="row" id="serchresult">

                            <div class="col-12 col-lg-6 singleProduct">
                                <div class="row">

                                    <div class="col-12" style="padding: 10px;">
                                        <div class="row">
                                            <div class="col-12 col-lg-4 order-2 order-lg-1">
                                                <ul>

                                                    <?php

                                                    $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pid . "'");
                                                    $image_num = $image_rs->num_rows;
                                                    $img = array();

                                                    if ($image_num != 0) {

                                                        for ($x = 0; $x < $image_num; $x++) {
                                                            $image_data = $image_rs->fetch_assoc();
                                                            $img[$x] = $image_data["code"];
                                                    ?>

                                                            <li class="d-flex flex-column justify-content-center align-items-center boder border-1 border-secondary mb-1">
                                                                <img src="<?php echo $img["$x"]; ?>" style="height: 200px;" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
                                                            </li>

                                                        <?php

                                                        }
                                                    } else {
                                                        ?>
                                                        <li class="d-flex flex-column justify-content-center align-items-center boder border-1 border-secondary mb-1">
                                                            <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                        </li>
                                                        <li class="d-flex flex-column justify-content-center align-items-center boder border-1 border-secondary mb-1">
                                                            <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                        </li>
                                                        <li class="d-flex flex-column justify-content-center align-items-center boder border-1 border-secondary mb-1">
                                                            <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                        </li>
                                                    <?php

                                                    }

                                                    ?>

                                                </ul>
                                            </div>

                                            <div class="col-lg-8 order-2 order-lg-1 d-none d-lg-block">
                                                <div class="row">
                                                    <div class="col-12 align-items-center border border-black-50 rounded">
                                                        <div class="main-img" id="main_img"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-5 border border-black-50 rounded ms-lg-3">
                                <div class="row">
                                    <div class="col-12" style="padding: 10px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                                    </ol>
                                                </nav>
                                            </div>
                                            <hr>
                                            <span class="mt-2 fw-bold fs-3 text-primary mb-3"><?php echo $product_data["title"]; ?></span>
                                            <hr>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <h4 class="text-success">Brand</h4>
                                                    <span class="fw-bold mb-2 fs-5"><?php echo $product_data["bname"]; ?></span>
                                                </div>
                                                <div class="col-6">
                                                    <h4 class="text-success">Model</h4>
                                                    <span class="fw-bold mb-2 fs-5"><?php echo $product_data["mname"]; ?></span>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-12 col-lg-6">
                                                    <h4 class="text-success">Price</h4>
                                                    <span class="fw-bold mb-2 fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <h4 class="text-success mt-2 mt-lg-0">Delivery Fee</h4>
                                                    <span class="fw-bold mb-2 fs-5">Rs. <?php echo $product_data["delivery_fee_colombo"]; ?> .00</span>
                                                </div>
                                            </div>
                                            <h4 class="mt-3 text-success">Description</h4>
                                            <span class="fw-bold mb-2 fs-5">Rs. <?php echo $product_data["description"]; ?> .00</span>
                                            <span class="badge rounded-pill text-bg-danger mt-3 mb-3">Get 10 % OFF By using The coupon</span>

                                            <div class=" mb-3">
                                                <span class="text-primary">12 Months waranty</span><br>
                                                <span class="text-primary">7 Days Easy Return Policy</span><br>
                                                <span class="text-primary">10 Items Available in Stock</span>
                                            </div>

                                            <hr>
                                            <h4 class="mb-3">Product Colour</h4>
                                            <div class="col-12">
                                                <?php

                                                $clr_rs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $product_data["colour_id"] . "' ");
                                                $clr_data = $clr_rs->fetch_assoc();

                                                ?>
                                                <input type="text" class="form-control" value="<?php echo $clr_data["name"]; ?>" readonly>
                                                <h4 class="mt-3 mb-3">Choose Quantity</h4>
                                                <div class="row">
                                                    <div class="col-12 ">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2 ">
                                                                    <div class="border border-black-50 rounded overflow-hidden float-left mt-1 position-relative product-qty">
                                                                        <div class="col-12 ">
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" onkeyup='checkValue(<?php echo $product_data["qty"]; ?>);' />

                                                                            <div class="position-absolute qty-buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-black-50 qty-inc">
                                                                                    <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-black-50 qty-dec">
                                                                                    <i class="bi bi-caret-down-fill text-primary fs-5" onclick="qty_dec();"></i>
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
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 col-lg-6 d-grid mt-3">
                                                        <button class="btn btn-success fw-bold" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                    </div>
                                                    <div class="col-12 col-lg-6 d-grid mt-3">
                                                        <button class="btn btn-danger fw-bold" onclick="addToCart(<?php echo $pid; ?>);">Add to cart</button>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-12 col-lg-6 d-grid mt-3">

                                                        <?php

                                                        if (isset($_SESSION["u"])) {

                                                            $wishlist_rs = Database::search("SELECT * FROM `wishlist` WHERE `product_id`='" . $pid . "' AND `user_email`= '" . $_SESSION["u"]["email"] . "' ");
                                                            $wishlist_num = $wishlist_rs->num_rows;

                                                            if ($wishlist_num == 1) {
                                                        ?>

                                                                <button class="col-12 btn btn-outline-light border border-black-50" onclick='addToWatchlist(<?php echo $pid; ?>);'>
                                                                    <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $pid; ?>'></i>
                                                                </button>

                                                            <?php
                                                            } else {

                                                            ?>
                                                                <button class="col-12 btn btn-outline-light border border-black-50" onclick='addToWatchlist(<?php echo $pid; ?>);'>
                                                                    <i class="bi bi-heart-fill text-warning fs-5" id='heart<?php echo $pid; ?>'></i>
                                                                </button>

                                                            <?php

                                                            }
                                                        } else {
                                                            ?>

                                                            <button class="col-12 btn btn-outline-light border border-black-50" onclick="msg();">
                                                                <i class="bi bi-heart-fill text-warning fs-5"></i>
                                                            </button>

                                                        <?php
                                                        }

                                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`= '" . $product_data["user_email"] . "' ");
                                                        $seller_data = $seller_rs->fetch_assoc();

                                                        ?>
                                                    </div>
                                                    <?php

                                                    if (isset($_SESSION["u"])) {
                                                    ?>

                                                        <div class="col-12 col-lg-6 d-grid mt-3">
                                                            <a class="btn btn-warning fw-bold" onclick="contactSeller('<?php echo $seller_data['email'] ?>');">Contact seller &nbsp;<i class="bi bi-chat-dots-fill"></i></a>
                                                        </div>

                                                    <?php
                                                    } else {
                                                    ?>

                                                        <div class="col-12 col-lg-6 d-grid mt-3" onclick="msg();">
                                                            <a class="btn btn-warning fw-bold">Contact seller &nbsp;<i class="bi bi-chat-dots-fill"></i></a>
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
                        </div>
                    </div>

                    <!-- Modal -->

                    <div class="modal" tabindex="-1" id="contactSeller<?php echo $seller_data["email"]; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <?php

                                    $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`= '" . $seller_data["email"] . "' ");
                                    $img_data = $img_rs->fetch_assoc();

                                    ?>
                                    <img src="<?php echo $img_data["path"]; ?>" class="rounded-circle" style="height: 60px; width: 60px;">
                                    <h5 class="modal-title text-success ms-5 fw-bold fs-4"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body overflow-scroll" style="height: 40vh;">

                                    <?php

                                    $msg_rs = Database::search("SELECT * FROM `chat` WHERE `from` = '" . $_SESSION["u"]["email"] . "' 
                                AND `to` = '" . $seller_data["email"] . "' ORDER BY `date_time` ASC ");
                                    $msg_num = $msg_rs->num_rows;

                                    for ($y = 0; $y < $msg_num; $y++) {
                                        $msg_data = $msg_rs->fetch_assoc();

                                    ?>

                                        <!-- sent -->
                                        <div class="col-12 mt-2">
                                            <?php

                                            ?>
                                            <div class="row">
                                                <div class="offset-5 col-7 rounded bg-body border border-primary">
                                                    <div class="row">
                                                        <div class="col-12 pt-2">
                                                            <span class="text-black fw-bold fs-5"><?php echo $msg_data["content"]; ?></span>
                                                        </div>
                                                        <div class="col-12 text-end pb-2">
                                                            <span class="text-black fs-6"><?php echo $msg_data["date_time"]; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- sent -->

                                    <?php
                                    }

                                    ?>

                                    <?php

                                    $msg_rs2 = Database::search("SELECT * FROM `chat` WHERE `to` = '" . $_SESSION["u"]["email"] . "' 
                                AND `from` = '" . $seller_data["email"] . "' ORDER BY `date_time` ASC ");
                                    $msg_num2 = $msg_rs2->num_rows;

                                    for ($z = 0; $z < $msg_num2; $z++) {
                                        $msg_data2 = $msg_rs2->fetch_assoc();

                                    ?>

                                        <!-- received -->
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                <div class="col-7 rounded bg-body border border-success">
                                                    <div class="row">
                                                        <div class="col-12 pt-2">
                                                            <span class="text-black fw-bold fs-5"><?php echo $msg_data2["content"]; ?></span>
                                                        </div>
                                                        <div class="col-12 text-end pb-2">
                                                            <span class="text-black fs-6"><?php echo $msg_data2["date_time"]; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- received -->

                                    <?php
                                    }

                                    ?>

                                </div>
                                <div class="modal-footer mt-3">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="msgtxt" placeholder="Type something..." />
                                            </div>
                                            <div class="col-3 d-grid">
                                                <button type="button" class="btn btn-primary">Send <i class="bi bi-send"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->



                    <!-- content -->

                    <hr class="mt-3">

                    <div class="col-12 col-lg-6 mb-2">
                        <div class="col-12 bg-white mb-2">
                            <div class="row mt-3 mb-lg-3 ">
                                <div class="col-12">
                                    <span class="fs-3 fw-bold ms-lg-3">Related Items</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 bg-white ms-lg-3">
                            <div class="row mb-3 col-12 ">
                                <div class="row justify-content-center gap-4">

                                    <?php

                                    $related_rs = Database::search("SELECT * FROM `product` WHERE `brand_has_model_id`='" . $product_data["brand_has_model_id"] . "' LIMIT 4");
                                    $related_num = $related_rs->num_rows;

                                    for ($z = 0; $z < $related_num; $z++) {
                                        $related_data = $related_rs->fetch_assoc();
                                    ?>
                                        <div class="card" style="width: 18rem;">

                                            <?php

                                            $img_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $related_data["id"] . "'");
                                            $img_data = $img_rs->fetch_assoc();

                                            ?>
                                            <img src="<?php echo $img_data["code"]; ?>" class="card-img-top" style="height: 180px;">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold"><?php echo $related_data["title"]; ?></h5>
                                                <p class="card-text"><?php echo $related_data["description"]; ?></p>
                                                <div class="col-12 d-grid">
                                                    <a href="#" class="btn btn-primary">See More</a>
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
                    <div class="col-12 col-lg-6 mb-2">

                        <div class="col-12 bg-white">
                            <div class="row me-0 mt-4 mb-3">
                                <div class="col-12">
                                    <span class="fs-3 fw-bold">Feedback</span>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-12 my-2">
                                <span class="badge">
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                            <i class="bi bi-star-half text-warning fs-5"></i>
                                        </div>

                                        &nbsp;&nbsp;

                                        <div class="col-12 col-lg-6">
                                            <label class="fs-5 text-dark fw-bold">4.5 Starts | 102 Reviews & Ratings</label>
                                        </div>
                                    </div>

                                </span>
                            </div>
                        </div>

                        <hr>

                        <div class="col-12 ">
                            <div class="row border border-1 border-dark rounded me-0 overflow-scroll" style="height: 400px;">
                                <?php

                                $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                $feedback_num = $feedback_rs->num_rows;

                                for ($x = 0; $x < $feedback_num; $x++) {
                                    $feedback_data = $feedback_rs->fetch_assoc();
                                ?>
                                    <div class="col-12 mt-2 mb-1 mx-2">
                                        <div class="row border border-1 border-dark rounded me-0">
                                            <?php

                                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                            $user_data = $user_rs->fetch_assoc();

                                            ?>
                                            <div class="col-10 mt-1 mb-1 ms-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></div>
                                            <div class="col-2 mt-1 mb-1 me-0">
                                                <?php
                                                if ($feedback_data["type"] == 1) {
                                                ?>
                                                    <span class="badge bg-success">Positive</span>
                                            </div>
                                        <?php
                                                } else if ($feedback_data["type"] == 2) {
                                        ?>
                                            <span class="badge bg-warning">Neutral</span>
                                        </div>
                                    <?php
                                                } else if ($feedback_data["type"] == 3) {
                                    ?>
                                        <span class="badge bg-danger">Negative</span>
                                    </div>
                                <?php
                                                }
                                ?>

                                <div class="col-12">
                                    <b>
                                        <?php echo $feedback_data["feedback"]; ?>
                                    </b>
                                </div>
                                <div class="offset-6 col-6 text-end">
                                    <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
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

            <?php include "footer.php"; ?>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

        </body>

        </html>

<?php
    } else {
        echo ("Sorry for the Inconvenience");
    }
} else {
    echo ("Something went wrong");
}
?>