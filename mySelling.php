<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];
    $pageno;


?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>My Store | Trewo Tech</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resource/logo.png" />

    </head>

    <body>

        <div class="container-fluid " style="background-color: #E9EBEE;">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-3 border border-1 bg-dark rounded">

                            <?php

                            $profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "' ");
                            $profile_img_num = $profile_img_rs->num_rows;
                            $profile_img_data = $profile_img_rs->fetch_assoc();

                            ?>

                            <div class="col-lg-2 offset-lg-1">
                                <div class="col-12 mb-3 mt-3 ms-5 ps-5">

                                    <?php

                                    if ($profile_img_num == 1) {

                                    ?>
                                        <img src="<?php echo $profile_img_data["path"]; ?>" class="rounded-circle" style="width: 120px; height:120px;">
                                    <?php

                                    } else {

                                    ?>
                                        <img src="resource/admin.png" style="width: 120px; height:120px;">
                                    <?php

                                    }

                                    ?>

                                </div>
                            </div>
                            <hr class="border border-light">
                            <div class="col-12 ms-5 ps-lg-4">
                                <label class="form-label fs-5 fw-bold text-white">Seller : <?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></label>
                            </div>
                            <div class="col-12 border border-1 rounded border-light mt-4 mb-4" style="background-color: #E9EBEE;">
                                <div class="col-12 text-center mt-3">
                                    <span class="fs-4 fw-bold text-black-50">Sort Products</span>
                                </div>
                                <div class="col-12 border border-success rounded mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-9 mt-3 ms-2 mb-2">
                                            <input type="text" class="form-control" placeholder="Search..." id="s">
                                        </div>
                                        <div class="col-2 mt-3 d-grid mb-2">
                                            <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                                        </div>
                                    </div>
                                    <hr class="border border-dark">
                                    <div class="col-12 ms-5 mb-3">
                                        <span class="fw-bold">Sort By Active Time</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check ms-5">
                                            <input class="form-check-input" type="radio" name="r1" id="n">
                                            <label class="form-check-label" for="n">
                                                Newest to oldest
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check ms-5">
                                            <input class="form-check-input" type="radio" name="r1" id="o">
                                            <label class="form-check-label" for="o">
                                                Oldest to newest
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12 ms-5 mb-3">
                                        <span class="fw-bold">Sort By Quantity</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check ms-5">
                                            <input class="form-check-input" type="radio" name="r1" id="h">
                                            <label class="form-check-label" for="n">
                                                High to low
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check ms-5">
                                            <input class="form-check-input" type="radio" name="r1" id="l">
                                            <label class="form-check-label" for="o">
                                                Low to high
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12 ms-5 mb-3">
                                        <span class="fw-bold">Sort By Condition</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check ms-5">
                                            <input class="form-check-input" type="radio" name="r1" id="b">
                                            <label class="form-check-label" for="n">
                                                Brandnew
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check ms-5">
                                            <input class="form-check-input" type="radio" name="r1" id="u">
                                            <label class="form-check-label" for="o">
                                                Used
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row mt-5 mb-3 ps-5">
                                        <div class="col-5 d-grid">
                                            <button class="btn btn-primary" onclick="sort1(0);">Sort</button>
                                        </div>
                                        <div class="col-5 d-grid">
                                            <button class="btn btn-success" onclick="clearsort();">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-9 ">
                            <div class="row mt-4 bg-white">
                                <div class="col-12 col-lg-7 offset-lg-1 text-center mt-2 mb-2">
                                    <h1 class="offset-lg-2 fw-bold text-primary">My Products</h1>
                                </div>
                                <div class="col-12 col-lg-2 mt-3 offset-lg-2">
                                    <div class=" mx-2 mb-2 d-grid">
                                        <button class="btn btn-warning fw-bold" onclick="window.location='addProduct.php'">Add Product</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4 bg-body border rounded">
                                <div class="row" id="sort">
                                    <div class="offset-1 col-10 text-center mt-3">
                                        <div class="row justify-content-center">

                                            <?php

                                            if (isset($_GET["page"])) {
                                                $pageno = $_GET["page"];
                                            } else {
                                                $pageno = 1;
                                            }

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $email . "'");
                                            $product_num = $product_rs->num_rows;

                                            $results_per_page = 6;
                                            $number_of_pages = ceil($product_num / $results_per_page);

                                            $page_results = ($pageno - 1) * $results_per_page;

                                            $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email` ='" . $email . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                            $selected_num = $selected_rs->num_rows;

                                            for ($x = 0; $x < $selected_num; $x++) {

                                                $selected_data = $selected_rs->fetch_assoc();

                                            ?>
                                                <div class="card mb-3 col-12 col-lg-6" style="max-width: 540px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">

                                                            <?php

                                                            $product_img_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $selected_data["id"] . "' ");
                                                            $product_img_data = $product_img_rs->fetch_assoc();

                                                            ?>

                                                            <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start mt-3" alt="...">
                                                        </div>
                                                        <div class="col-md-8 pb-2">
                                                            <div class="card-body pb-2">
                                                                <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                                <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                                                <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["id"]; ?>" <?php if ($selected_data["status_id"] == 2) {
                                                                                                                                                                                ?>checked<?php
                                                                                                                                                                                        }
                                                                                                                                                                                            ?> onclick="changeStatus(<?php echo $selected_data['id']; ?>);" />
                                                                    <label class="form-check-label fw-bold text-info" for="fd<?php echo $selected_data["id"]; ?>">
                                                                        <?php if ($selected_data["status_id"] == 2) { ?>
                                                                            Make your product Active
                                                                        <?php } else { ?>
                                                                            Make your product Deactive
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </label>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row g-1 mt-2">
                                                                            <div class="col-12 col-lg-6 d-grid">
                                                                                <button class="btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['id']; ?>);">Update</button>
                                                                            </div>
                                                                            <div class="col-12 col-lg-6 d-grid">
                                                                                <button class="btn btn-danger fw-bold" onclick="deleteProductModal(<?php echo $selected_data['id']; ?>);">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Modal -->

                                                <div class="modal" tabindex="-1" id="deleteProductModal<?php echo $selected_data["id"]; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-danger">Are you sure you want to delete this product?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <img src="<?php echo $product_img_data["code"]; ?>" style="height: 100px; width: 100px;">
                                                                    </div>
                                                                    <div class="col-7">
                                                                        <span class="fw-bold fs-5 text-success"><?php echo $selected_data["title"]; ?></span><br>
                                                                        <span class="fw-bold fs-5">Rs. <?php echo $selected_data["price"];
                                                                                                        .00 ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary" onclick="deleteProduct(<?php echo $selected_data['id']; ?>)">Delete Product</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                            <?php

                                            }

                                            ?>

                                        </div>
                                    </div>

                                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagination-lg justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                    echo "#";
                                                                                } else {
                                                                                    echo "?page=" . ($pageno - 1);
                                                                                } ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <?php

                                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                                    if ($x == $pageno) {

                                                ?>
                                                        <li class="page-item active">
                                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                        </li>
                                                    <?php

                                                    } else {

                                                    ?>

                                                        <li class="page-item ">
                                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                        </li>

                                                <?php

                                                    }
                                                }

                                                ?>

                                                <li class="page-item">
                                                    <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                    echo "#";
                                                                                } else {
                                                                                    echo "?page=" . ($pageno + 1);
                                                                                } ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <hr class="mt-3 mb-3">

                <div class="col-12">
                    <div class="row bg-white">
                        <div class="col-12">
                            <div class="col-12 text-center mt-3 mb-3">
                                <span class="fs-1 text-warning">My Orders</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <?php

                                for ($j = 0; $j < $product_num; $j++) {
                                    $product_data = $product_rs->fetch_assoc();

                                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `product_id` = '" . $product_data["id"] . "' AND `status` != '5' ");
                                    $invoice_num = $invoice_rs->num_rows;

                                    for ($z = 0; $z < $invoice_num; $z++) {
                                        $invoice_data = $invoice_rs->fetch_assoc();
                                ?>

                                        <div class="col-12 col-lg-3 ms-3 mb-4">
                                            <div class="card mt-4 mb-4 ms-3" style="width: 18rem;">
                                                <?php
                                                $p_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $invoice_data["product_id"] . "' ");
                                                $p_data = $p_rs->fetch_assoc();

                                                $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id` = '" . $p_data["id"] . "' ");
                                                $image_data = $image_rs->fetch_assoc();

                                                if ($image_data != 0) {
                                                ?>

                                                    <img src="<?php echo $image_data["code"]; ?>" class="card-img-top" style="height: 200px;">

                                                <?php
                                                } else {
                                                ?>

                                                    <img src="resource/empty.svg" class="card-img-top">

                                                <?php

                                                    $total = 0;
                                                }
                                                ?>
                                                <div class="card-body text-center" >
                                                    <h5 class="card-title fs-4 fw-bold mb-2"><?php echo $p_data["title"]; ?></h5>
                                                    <label class="mt-1 text-danger fs-5">Rs . <?php echo $p_data["price"]; ?> . 00</label><br>
                                                    <label class="mt-1">Invoice date : <?php echo $invoice_data["date"]; ?></label><br>
                                                    <label class="mt-1">Quantity : <?php echo $invoice_data["qty"]; ?></label><br>

                                                    <?php
                                                    $cus_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $invoice_data["user_email"] . "' ");
                                                    $cus_data = $cus_rs->fetch_assoc();

                                                    ?>
                                                    <label class="text-success mt-1">Customer : <?php echo $cus_data["fname"] . " " . $cus_data["lname"]; ?></label><br>

                                                    <div class="col-12 d-grid">
                                                        <?php

                                                        if ($invoice_data["status"] == 0) {
                                                        ?>

                                                            <div class="col-12 d-grid" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">
                                                                <button class="btn btn-success mt-3">Confirm Order</button>
                                                            </div>

                                                        <?php
                                                        } else if ($invoice_data["status"] == 1) {
                                                        ?>

                                                            <div class="col-12 d-grid" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">
                                                                <button class="btn btn-warning mt-3">Packing</button>
                                                            </div>

                                                        <?php
                                                        } else if ($invoice_data["status"] == 2) {
                                                        ?>

                                                            <div class="col-12 d-grid" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">
                                                                <button class="btn btn-info mt-3">Dispatch</button>
                                                            </div>

                                                        <?php
                                                        } else if ($invoice_data["status"] == 3) {
                                                        ?>

                                                            <div class="col-12 d-grid" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">
                                                                <button class="btn btn-primary mt-3">Shipping</button>
                                                            </div>

                                                        <?php
                                                        } else if ($invoice_data["status"] == 4) {
                                                        ?>

                                                            <div class="col-12 d-grid" onclick="changeInvoiceStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">
                                                                <button class="btn btn-danger mt-3 disabled">Delivered</button>
                                                            </div>

                                                        <?php
                                                        }

                                                        ?>

                                                    </div>

                                                    <div class="col-12 d-grid">
                                                        <button class="btn btn-info mt-3" onclick="loadMsgModal('<?php echo $cus_data['email']; ?>');">Contact Customer &nbsp;<i class="bi bi-chat-dots-fill"></i></button>
                                                    </div>
                                                    <!-- msg modal -->
                                                    <div class="modal" tabindex="-1" id="cusMsgModal<?php echo $cus_data["email"]; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="background-color: #E9EBEE;">
                                                                <div class="modal-header bg-info">

                                                                    <?php

                                                                    $receiver_mail = $cus_data["email"];
                                                                    $sender_mail = $email;

                                                                    $imag_rs = Database::search("SELECT * FROM profile_image WHERE user_email = '" . $cus_data["email"] . "' ");
                                                                    $imag_data = $imag_rs->fetch_assoc();

                                                                    if (isset($imag_data["path"])) {
                                                                    ?>
                                                                        <img src="<?php echo $imag_data["path"]; ?>" style="height: 50px; width: 50px;" class="rounded-circle" />
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <img src="resource/newuser.jpg" ; style="height: 50px; width: 50px;" class="rounded-circle">
                                                                    <?php
                                                                    }

                                                                    ?> <h5 class="modal-title fw-bold ms-5"><?php echo $cus_data["fname"] . " " . $cus_data["lname"]; ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body overflow-scroll" style="height: 40vh;">

                                                                    <?php

                                                                    $msg_rs = Database::search("SELECT * FROM `chat` WHERE `from`='" . $sender_mail . "' OR `to`='" . $sender_mail . "'");
                                                                    $msg_num = $msg_rs->num_rows;

                                                                    for ($y = 0; $y < $msg_num; $y++) {
                                                                        $msg_data = $msg_rs->fetch_assoc();

                                                                        if ($msg_data["to"] == $sender_mail && $msg_data["from"] == $receiver_mail) {

                                                                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["from"] . "'");
                                                                            $user_data = $user_rs->fetch_assoc();

                                                                            $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $msg_data["from"] . "'");
                                                                            $img_data = $img_rs->fetch_assoc();

                                                                    ?>
                                                                            <!-- sender -->
                                                                            <div class="media mb-3 w-75">

                                                                                <div class="media-body me-4">
                                                                                    <div class="bg-light rounded py-2 px-3 mb-2">
                                                                                        <p class="mb-0 fw-bold text-black-50"> <?php echo $msg_data["content"]; ?></p>
                                                                                    </div>
                                                                                    <p class="small fw-bold text-black-50 text-end"><?php echo $msg_data["date_time"]; ?></p>
                                                                                    <p class="invisible"><?php echo $msg_data["from"]; ?></p>
                                                                                </div>
                                                                            </div>
                                                                            <!-- sender -->
                                                                        <?php

                                                                        } else if ($msg_data["from"] == $sender_mail && $msg_data["to"] == $receiver_mail) {
                                                                        ?>
                                                                            <!-- receiver -->
                                                                            <div class="offset-3 col-9 media mb-3 w-75">
                                                                                <div class="media-body">
                                                                                    <div class="bg-primary rounded py-2 px-3 mb-2">
                                                                                        <p class="mb-0 text-white"><?php echo $msg_data["content"]; ?></p>
                                                                                    </div>
                                                                                    <p class="small fw-bold text-black-50 text-end"><?php echo $msg_data["date_time"]; ?></p>
                                                                                </div>
                                                                            </div>
                                                                            <!-- receiver -->
                                                                    <?php
                                                                        }
                                                                    }

                                                                    ?>

                                                                </div>
                                                                <!-- txt -->
                                                                <div class="modal-footer mt-3">

                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-9">
                                                                                <input type="text" class="form-control" id="msgtxt" placeholder="Type something..." />
                                                                            </div>
                                                                            <div class="col-3 d-grid">
                                                                                <button type="button" class="btn btn-primary" onclick="sendCusMg('<?php echo $cus_data['email']; ?>');">Send <i class="bi bi-send"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!-- txt -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- msg modal -->
                                                    <div class="col-12 d-grid">
                                                        <button class="btn btn-danger mt-3" onclick="openModal('<?php echo $p_data['id']; ?>');">Remove Order &nbsp;</button>
                                                    </div>

                                                    <!-- Delete Modal -->
                                                    <div class="modal" tabindex="-1" id="openModal<?php echo $p_data["id"]; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"><?php echo $p_data["title"]; ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    if ($image_data != 0) {
                                                                    ?>

                                                                        <img src="<?php echo $image_data["code"]; ?>" class="card-img-top" style="height: 150px; width: 150px;">

                                                                    <?php
                                                                    } else {
                                                                    ?>

                                                                        <img src="resource/empty.svg" class="card-img-top" style="height: 150px; width: 150px;">

                                                                    <?php

                                                                    }
                                                                    ?>
                                                                    <p class="fs-4 text-danger">Are you sure you want to remove this order?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-danger" onclick="removeOrder('<?php echo $p_data['id']; ?>');">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Delete Modal -->

                                                </div>
                                            </div>
                                        </div>


                                    <?php
                                    }

                                    ?>



                                <?php
                                }

                                ?>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="col-12 bg-white mt-4">
                                <div class="col-12 text-center">
                                    <label class="text-black-50 fs-2 mt-3 mb-3">My Earnings</label>
                                </div>
                                <?php

                                $earning_rs = Database::search("SELECT * FROM product INNER JOIN invoice ON product.id = invoice.product_id 
                                WHERE product.user_email = '" . $email . "' ");
                                $earning_num = $earning_rs->num_rows;

                                $earning = Database::search("SELECT SUM(invoice.total) FROM product INNER JOIN invoice ON product.id = invoice.product_id
                                WHERE product.user_email = '" . $email . "'");
                                $earning_data = $earning->fetch_assoc();

                                ?>
                                <div class="col-12 pb-3">
                                    <div class="col-10 offset-1 bg-success border rounded">
                                        <div class="col-12 text-center">
                                            <label class="text-white fs-4 mt-3 ">Total Earnings : </label>
                                        </div>
                                        <div class="col-12 text-center">
                                            <?php

                                            if ($earning_data != 0) {
                                            ?>

                                                <label class="text-white fs-4 mt-3 mb-3">Rs. <?php echo implode($earning_data); ?> .00</label>

                                            <?php
                                            } else {
                                            ?>

                                                <label class="text-white fs-4 mt-3 mb-3">Rs. 00 .00</label>

                                            <?php
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 bg-primary border rounded mt-3  mb-5">
                                        <div class="col-12 text-center">
                                            <?php
                                            if ($earning_num != 0) {
                                            ?>

                                                <label class="text-white fs-4 mt-3 mb-3">Total Sellings : <?php echo $earning_num; ?> Items </label>

                                            <?php
                                            } else {
                                            ?>

                                                <label class="text-white fs-4 mt-3 mb-3">Total Sellings : 00 Items </label>

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
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {

    header("Location:home.php");
}

?>