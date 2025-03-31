<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice | Trewo Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />
</head>

<body>

    <div class="container-fluid mt-3 mb-3">
        <div class="row mx-lg-5 border border-3 pb-3">

            <?php

            require "connection.php";

            session_start();

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];

            ?>

                <div class="col-12 mt-3">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-info me-md-2" type="button" onclick="printInvoice();">Print &nbsp;<i class="bi bi-printer-fill"></i></button>
                        <button class="btn btn-danger" type="button">Export as PDF &nbsp;<i class="bi bi-filetype-pdf"></i></button>
                    </div>
                </div>
                <hr class="mt-3 border border-4 border-dark">

                <div class="row" id="page">

                    <div class="col-12 col-lg-1 ps-5">
                        <img src="resource/logo1.png " style="width: 100px; height:100px;" class="ms-5 ">
                    </div>

                    <div class="col-12 col-lg-3 align-text-top offset-lg-8 mt-3 mt-lg-0 pe-3">
                        <div class=" text-primary col-12">
                            <span class="text-decoration-underline fs-3 float-end" style="font-family: Calibri;">Trewo Tech</span><br><br>
                            <span class="text-black-50 float-end " style="font-family: Calibri;"> No.17, Charles Drive,Colombo 03</span><br>
                            <span class="text-black-50 float-end" style="font-family: Calibri;"> +94112 574 414</span><br>
                            <span class="text-black-50 float-end" style="font-family: Calibri;"> trewotechofficial@gmail.com</span>
                        </div>
                    </div>

                    <br>
                    <hr class="mt-3 border border-1 border-dark">

                    <div class="col-12 col-lg-3">
                        <span class="fw-bold" style="font-family: Noto;">INVOICE TO :</span><br>

                        <?php

                        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                        $address_data = $address_rs->fetch_assoc();

                        ?>

                        <span class="fs-5 fw-bold text-black-50" style="font-family: Lucida Sans;"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span><br>
                        <span class="fw-bold text-black-50" style="font-family: Calibri;"><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?></span><br>
                        <span class="fw-bold text-primary text-decoration-underline"><?php echo $umail; ?></span><br>
                    </div>

                    <?php

                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                    $invoice_data = $invoice_rs->fetch_assoc();

                    ?>

                    <div class="col-12 col-lg-3 offset-lg-6 mt-5 mt-lg-0">
                        <span class="fw-bold fs-3 float-end text-primary" style="font-family: Noto;">INVOICE 0<?php echo $invoice_data["id"]; ?></span><br>
                        <span class="text-dark float-end " style="font-family: Calibri;"> Date & Time of invoice : <?php echo $invoice_data["date"]; ?></span><br>
                    </div>

                    <div class="col-12 mt-5 " style="background-color: #E9EBEE;">
                        <div class="row">
                            <div class="col-12 col-lg-1 text-center border border-1 d-grid bg-info " style="font-family: Lucida Sans;">
                                <span class="fs-5 mt-2">#</span>
                                <div class="col-12 mb-2">
                                    <span class="fs-2"><?php echo $invoice_data["id"]; ?></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 border border-1 d-grid" style="font-family: Lucida Sans;">
                                <span class="mt-2 fs-5 fw-bold">Order id & product</span>
                                <div class="col-12 mb-2">
                                    <span class="text-secondary"><?php echo $oid; ?></span><br>

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    ?>

                                    <span class="text-primary text-decoration-underline "><?php echo $product_data["title"]; ?></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 border border-1 d-grid text-end" style="font-family: Lucida Sans;">
                                <span class="mt-2 fs-5 fw-bold">Unit Price</span>
                                <div class="col-12 mb-2 ">
                                    <span class="fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span><br>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 border border-1 d-grid text-end" style="font-family: Lucida Sans;">
                                <span class="mt-2 fs-5 fw-bold">Quantity</span>
                                <div class="col-12 mb-2 ">
                                    <span class="fs-4"><?php echo $invoice_data["qty"]; ?></span><br>
                                </div>
                            </div>
                            <div class="col-12 bg-primary col-lg-3 border border-1 d-grid text-end text-white" style="font-family: Lucida Sans;">
                                <span class="mt-2 fs-5 fw-bold">Total</span>
                                <div class="col-12 mb-2 ">
                                    <span class="fs-4">Rs. <?php echo $invoice_data["total"]; ?> .00</span><br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <?php
                        $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                        $city_data = $city_rs->fetch_assoc();

                        if ($city_data["district_id"] == 5) {
                            $delivery = $product_data["delivery_fee_colombo"];
                        } else {
                            $delivery = $product_data["delivery_fee_other"];
                        }
                        $t = $invoice_data["total"];
                        $g = $t - $delivery;
                        ?>

                        <div class="col-12 mt-3 mt-lg-4" style="font-family: Lucida Sans;">
                            <div class="col-12 col-lg-5 offset-lg-7 text-end ">
                                <span class="fs-5">SUB TOTAL :</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="fw-bold">Rs. <?php echo $g; ?> .00</span>
                                <hr>
                            </div>
                            <div class="col-12 col-lg-5 offset-lg-7 text-end">
                                <span class="fs-5">DELIVERY FEE :</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="fw-bold">Rs. <?php echo $delivery; ?> .00</span>
                                <hr class="">
                            </div>
                            <div class="col-12 col-lg-5 offset-lg-7 text-end  text-success">
                                <span class="fs-5">GRAND TOTAL :</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="fw-bold">Rs. <?php echo $t; ?> .00</span>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="alert alert-info" role="alert">
                            <span class="fs-5">NOTICE &nbsp;<i class="bi bi-chat-square-text"></i></span><br>
                            You can return an item within 7 days according to our terms and conditions. &nbsp;<a href="#" class="alert-link">See terms and conditions</a> before returning.
                        </div>
                    </div>

                </div>

            <?php
            }

            ?>

        </div>
    </div>

    <?php include "footer.php";
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>