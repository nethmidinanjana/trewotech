<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Purchased history | Trewo Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />
</head>

<body>

    <div class="container-fluid " style="background-color: F0FFF;">
        <div class="row">

            <?php

            include "header.php";
            require "connection.php";



            ?>

            <hr class="col-12 mt-2 mb-2">

            <div class="col-12 text-center pt-2 pb-2">
                <label class="form-label fw-bold fs-2 text-primary ">Purchased History</label>
            </div>

            <div class="row align-items-start">

                <div class="col-12 col-lg-2 bg-white border border-1 rounded ms-lg-4 ms-2">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item mt-3 ms-3"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active mt-3 ms-3" aria-current="page">Purchased history</li>
                        </ol>
                    </nav>
                    <nav class="nav nav-pills flex-column ">
                        <a class="nav-link active mt-2 " aria-current="page" href="#">Purchased history</a>
                        <a class="nav-link text-black-50 fw-bold" href="cart.php">My Cart</a>
                        <a class="nav-link text-black-50 fw-bold mb-2" href="myProfile.php">My Account</a>

                    </nav>
                </div>

                <?php

                if (isset($_SESSION["u"])) {
                    $umail = $_SESSION["u"]["email"];

                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $umail . "'");
                    $invoice_num = $invoice_rs->num_rows;

                    if ($invoice_num == 0) {

                ?>
                        <div class="col-12 col-lg-9 mt-5 bg-body text-center">

                            <img src="resource/money.png" style="height: 200px;">
                            <span class="fs-1 fw-bolder text-black-50 d-block mb-5" style="margin-top: 50px;">
                                You have not purchased any product yet...
                            </span>

                        </div>
                    <?php

                    } else {

                    ?>

                        <div class="col-12 col-lg-9 border border-1 rounded ms-lg-5">

                            <label class="form-label fw-bold mt-3">ORDER DETAILS :</label>

                            <?php

                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();

                            ?>

                                <div class="row">

                                    <div class="col-12 col-lg-6">
                                        <div class="col-12">

                                            <div class="card mb-3 mt-3" style="max-width: 540px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <?php
                                                        $pid = $invoice_data["product_id"];
                                                        $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pid . "' ");
                                                        $image_data = $image_rs->fetch_assoc();
                                                        ?>
                                                        <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start mt-2 mb-2 ms-lg-2">
                                                    </div>
                                                    <div class="col-md-7 ms-5">
                                                        <div class="card-body">
                                                            <?php
                                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
                                                            $product_data = $product_rs->fetch_assoc();

                                                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                                                            $seller_data = $seller_rs->fetch_assoc();
                                                            ?>
                                                            <h5 class="card-title fw-bold fs-4 mt-4"><?php echo $product_data["title"]; ?> </h5>
                                                            <span class=" fw-bold text-black-50 mt-5">Price : </span>
                                                            <span class=" fw-bold ">Rs. <?php echo $product_data["price"]; ?> .00</span><br />
                                                            <span class=" fw-bold text-black-50">Seller : </span>
                                                            <span class=" fw-bold "><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?> </span><br>
                                                            <span class="fw-bold text-black-50">Order Status :</span>
                                                            <?php
                                                            if ($invoice_data["status"] == 0) {
                                                            ?>

                                                                <span class="fw-bold"> Order not confirmed yet</span>

                                                            <?php
                                                            } else if ($invoice_data["status"] == 1) {
                                                            ?>

                                                                <span class="fw-bold"> Order confirmed and packing</span>

                                                            <?php
                                                            } else if ($invoice_data["status"] == 2) {
                                                            ?>

                                                                <span class="fw-bold"> Dispatch</span>

                                                            <?php
                                                            } else if ($invoice_data["status"] == 3) {
                                                            ?>

                                                                <span class="fw-bold"> Shipping</span>

                                                            <?php
                                                            } else if ($invoice_data["status"] == 4) {
                                                            ?>

                                                                <span class="fw-bold"> Delivered</span>

                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 pt-3">
                                        <div class="col-12 border border-1 rounded bg-warning mt-5">
                                            <div class="col-12 ms-2 ms-lg-4 text-white fw-bold  mt-3 mb-3 ">
                                                <span class="from-label">QUANTITY : <?php echo $invoice_data["qty"]; ?></span><br>
                                                <span class="form-label ">PURCHASED DATE & TIME : <?php echo $invoice_data["date"]; ?></span><br>

                                                <?php

                                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $invoice_data["user_email"] . "'");
                                                $address_data = $address_rs->fetch_assoc();

                                                $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                                $city_data = $city_rs->fetch_assoc();

                                                if ($city_data["district_id"] == 5) {
                                                    $delivery = $product_data["delivery_fee_colombo"];
                                                } else {
                                                    $delivery = $product_data["delivery_fee_other"];
                                                }
                                                ?>
                                                <span class="form-label ">DELIVERY FEE : Rs. <?php echo $delivery; ?> . 00</span><br>
                                            </div>
                                        </div>
                                        <button class=" btn btn-danger mt-3 col-lg-5 col-12 ms-lg-3"><i class="bi bi-trash3"></i>&nbsp; Remove</button>
                                        <button class="btn btn-secondary mt-3 col-lg-5 col-12 ms-lg-5" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                            <i class="bi bi-info-square"></i>&nbsp; FeedBack
                                        </button>
                                    </div>

                                    <hr class="col-12 mt-2 mb-3">

                                </div>

                                <!-- modal -->

                                <div class="modal" tabindex="-1" id="feedbackModal<?php echo $pid; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Add your Feedback</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    <div class="row mt-2 mb-2">
                                                        <div class="col-12 col-lg-4 text-center">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-half text-warning fs-5"></i>
                                                            <label class="fs-5 text-dark fw-bold">4.5 Starts </label>
                                                            <label>102 Reviews</label>

                                                        </div>

                                                        &nbsp;&nbsp;

                                                        <div class="col-12 col-lg-6">
                                                            <div class="progress mb-1">
                                                                <div class="progress-bar bg-warning" role="progressbar" aria-label="Basic example" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">5 Stars</div>
                                                            </div>
                                                            <div class="progress mb-1">
                                                                <div class="progress-bar bg-warning" role="progressbar" aria-label="Basic example" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <div class="progress mb-1">
                                                                <div class="progress-bar bg-warning" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <div class="progress mb-1">
                                                                <div class="progress-bar bg-warning" role="progressbar" aria-label="Basic example" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <div class="progress mb-1">
                                                                <div class="progress-bar bg-warning" role="progressbar" aria-label="Basic example" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <hr class="mb-4">

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label class="form-label fw-bold">Type</label>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="type1">
                                                                        <label class="form-check-label text-success fw-bold" for="type1">
                                                                            Positive
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="type2" checked>
                                                                        <label class="form-check-label text-warning fw-bold" for="type2">
                                                                            Neutral
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="type3">
                                                                        <label class="form-check-label text-danger fw-bold" for="type3">
                                                                            Negative
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label class="form-label fw-bold">User's email</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control" id="mail" value="<?php echo $umail; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label class="form-label fw-bold">Feedback</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <textarea cols="50" rows="8" class="form-control" id="feed"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="saveFeedback(<?php echo $pid; ?>);">Save Feedback</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- modal -->

                            <?php
                            }

                            ?>

                            <div class="col-12 offset-lg-9 mb-4">
                                <button class="btn btn-danger btn-lg"><i class="bi bi-trash3"></i>&nbsp;&nbsp;&nbsp;&nbsp; Delete All Records</button>
                            </div>



                        </div>

                <?php

                    }
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